<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\Space;
use Carbon\Carbon;

class CheckExpiredBookings extends Command
{
    protected $signature = 'bookings:check-expired';

    protected $description = 'Check for expired bookings and update space availability';

    public function handle()
    {
        // Get current date and time
        $now = Carbon::now();
        $expiredBookings = Booking::where('date_to_activate', '<', $now)
            ->where('status', 'confirmed')  // Only consider confirmed bookings
            ->get();
        

        foreach ($expiredBookings as $booking) {
            $space = Space::find($booking->space_id);
            $space->is_available = true;
            $space->save();

            // Optionally, update the booking status to 'expired'
            $booking->status = 'ended';
            $booking->save();
        }
        

        $this->info('Expired bookings checked and spaces updated.');
    }
}
