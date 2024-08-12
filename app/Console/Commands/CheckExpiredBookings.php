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
        $now = Carbon::now();
        $expiredBookings = Booking::where('date_to_activate', '<', $now)
            ->where('status', 'confirmed')  
            ->get();
        

        foreach ($expiredBookings as $booking) {
            $space = Space::find($booking->space_id);
            $space->is_available = true;
            $space->save();

            $booking->status = 'ended';
            $booking->save();

            $space->users()->detach();
        }
        

        $this->info('Expired bookings checked and spaces updated.');
    }
}
