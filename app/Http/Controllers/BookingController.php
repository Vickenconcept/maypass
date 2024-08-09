<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Space;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
 

    public function index()
    {
        $bookings = Booking::with(['user', 'space'])->get();
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
            ]);

            $validated['user_id'] = auth()->id();

            $currentDate = Carbon::now();

            $futureDate = $currentDate->addDays(intval($validated['days_count']));
            

            $space = Space::find($validated['space_id']);
            
          
            if ($space->is_available) {
                Booking::create($validated);
                
                $space->is_available = false;
                $space->date_to_activate = $futureDate->format('Y-m-d');
                $space->update();

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
