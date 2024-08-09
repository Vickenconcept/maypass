<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Space;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'space'])->get();
        return view('admin.bookings.index', compact('bookings'));
    }


    // public function create(Space $space)
    // {
    //     return view('bookings.create', compact('space'));
    // }
    public function book(Space $space)
    {
        return view('bookings.create', compact('space'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the incoming request
            $validated = $request->validate([
                'space_id' => 'required|exists:spaces,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            // Assign the authenticated user's ID to the booking
            $validated['user_id'] = auth()->id();

            // Find the space by its ID
            $space = Space::find($validated['space_id']);

            // Check if the space is available for booking
            if ($space->is_available) {
                // Create the booking
                Booking::create($validated);

                // Mark the space as unavailable
                $space->is_available = false;
                $space->update();

                // Redirect to the bookings index with success message
                return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
            } else {
                // If the space is not available, redirect back with an error message
                return back()->with('error', 'Space is not available.');
            }
        } catch (\Exception $e) {
            // Catch any exceptions and handle them accordingly

            // return back()->with('error', 'An error occurred while creating the booking. Please try again.');
            return back()->with('error', $e->getMessage());
        }
    }


    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
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
