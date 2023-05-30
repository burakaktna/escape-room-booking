<?php

namespace App\Services\BookingSteps\AvailabilitySteps;

use App\Models\Booking;
use Carbon\Carbon;
use Closure;
use Exception;

class CheckTimeSlot
{
    /**
     * @throws Exception
     */
    public function handle(Booking $booking, Closure $next)
    {
        $currentDateTime = Carbon::now();
        $startDateTime = Carbon::parse($booking->timeSlot->start_time);
        $endDateTime = Carbon::parse($booking->timeSlot->end_time);

        if (!$currentDateTime->between($startDateTime, $endDateTime)) {
            throw new Exception("This booking does not fall into the selected time slot.");
        }

        return $next($booking);
    }
}
