<?php

namespace App\Services\BookingSteps\AvailabilitySteps;

use App\Models\Booking;
use Closure;
use Exception;

class CheckBookingOverlap
{
    /**
     * @throws Exception
     */
    public function handle(Booking $booking, Closure $next)
    {
        $overlap = Booking::where('time_slot_id', $booking->time_slot_id)
            ->where('escape_room_id', $booking->escape_room_id)
            ->where('id', '!=', $booking->id)
            ->exists();

        if ($overlap) {
            throw new Exception("This time slot is already booked for this escape room.");
        }

        return $next($booking);
    }
}
