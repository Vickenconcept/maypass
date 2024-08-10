<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Space;
use App\Models\User;
use App\Notifications\SpacePurchasedNotification;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{


    public function index(Request $request)
    {

        $query = Booking::with(['user', 'space']);

        // Filter by search term (reference, space name, or user name)
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('reference', 'like', '%' . $search . '%')
                    ->orWhereHas('space', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('user', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        // Filter by status
        if ($request->has('status') && $request->input('status') !== 'all') {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        $bookings = $query->paginate(10);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function book(Space $space)
    {
        return view('bookings.create', compact('space'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'space_id' => 'required|exists:spaces,id',
                'days_count' => 'required',
                'total_amount' => 'required',
                'reference' => 'required',
                'date_to_activate' => 'sometimes',
            ]);

            $validated['user_id'] = auth()->id();

            $currentDate = Carbon::now();

            $futureDate = $currentDate->addDays(intval($validated['days_count']));
            $validated['date_to_activate'] = $futureDate->format('Y-m-d');

            $space = Space::find($validated['space_id']);


            if ($space->is_available) {
                $booking = Booking::create($validated);

                $space->is_available = false;
                $space->update();


                Payment::create([
                    'booking_id' => $booking->id,
                    'amount' => $validated['total_amount'],
                    'payment_method' => 'paystack',

                ]);

                $user = auth()->user();

                $name = $user->name;

                if ($user->hasRole('super-admin')) {
                    $name = 'You';
                }

                $data = [
                    'name' => $name,
                    'space_name' => $space->name,
                    'payment_method' => 'paystack',
                    'price_per_day' => $validated['total_amount'] /  $validated['days_count'],
                    'total_amount' => $validated['total_amount'],
                    'days_count' => $validated['days_count'],
                    'expiring_date' => $futureDate,
                    'reference' => $validated['reference'],
                ];

                Mail::to($user->email)->send(new \App\Mail\SpacePuchasedMail($data));

                $user->notify(new SpacePurchasedNotification($data));

                $super_admins = User::role('super-admin')->get();


                if (!$user->hasRole('super-admin')) {
                    $name = 'You';
                    foreach ($super_admins as $super_admin) {
                        $super_admin->notify(new SpacePurchasedNotification($data));
                    }
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Payment successfully processed.',
                ]);
            } else {
                // return back()->with('error', 'Space is not available.');
                return response()->json([
                    'success' => false,
                    'message' => 'Space is not available.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        return view('admin.bookings.edit', compact('booking'));
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $status = $request->input('status');
        $booking->status = $status;
        $booking->save();

        return response()->json([
            'status' => $status,
            'html' => $this->getStatusLabel($status)
        ]);
    }

    private function getStatusLabel($status)
    {
        if ($status == 'confirmed') {
            return '<span class="border border-green-600 bg-green-100 text-green-600 px-4 py-1 rounded-full font-semibold text-xs">Completed</span>';
        } elseif ($status == 'canceled') {
            return '<span class="border border-red-600 bg-red-100 text-red-600 px-4 py-1 rounded-full font-semibold text-xs">Failed</span>';
        } else {
            return '<span class="border border-yellow-600 bg-yellow-100 text-yellow-600 px-4 py-1 rounded-full font-semibold text-xs">Pending</span>';
        }
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $booking->update($validated);
        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
