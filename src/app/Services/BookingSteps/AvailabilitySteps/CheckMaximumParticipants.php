<?php

namespace App\Services\BookingSteps\AvailabilitySteps;

use App\Models\Booking;
use Closure;
use Exception;

class CheckMaximumParticipants
{
    /**
     * @throws Exception
     */
    public function handle(Booking $booking, Closure $next)
    {
        $totalParticipants = Booking::where('time_slot_id', $booking->time_slot_id)
            ->where('escape_room_id', $booking->escape_room_id)
            ->sum('participant_count');

        if (($totalParticipants + $booking->participant_count) > $booking->escapeRoom->maximum_participants) {
            throw new Exception("Maximum participants exceeded for this time slot.");
        }

        return $next($booking);
    }
}
