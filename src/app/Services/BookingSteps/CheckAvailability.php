<?php

namespace App\Services\BookingSteps;

use App\Models\Booking;
use App\Services\BookingSteps\AvailabilitySteps\CheckBookingOverlap;
use App\Services\BookingSteps\AvailabilitySteps\CheckMaximumParticipants;
use App\Services\BookingSteps\AvailabilitySteps\CheckTimeSlot;
use Closure;
use Exception;
use Illuminate\Pipeline\Pipeline;

class CheckAvailability
{
    /**
     * @throws Exception
     */
    public function handle(Booking $booking, Closure $next)
    {
        $pipes = [
            CheckTimeSlot::class,
            CheckBookingOverlap::class,
            CheckMaximumParticipants::class,
        ];

        app(Pipeline::class)
            ->send($booking)
            ->through($pipes)
            ->then(function ($booking) {
                return $booking;
            });

        return $next($booking);
    }
}
