<?php

namespace App\Services\BookingSteps;

use App\Models\Booking;
use Carbon\Carbon;
use Closure;

class CheckBirthday
{
    public function handle(Booking $booking, Closure $next)
    {
        if (Carbon::parse($booking->timeSlot->start_time)->isBirthday($booking->user->date_of_birth)) {
            $booking->discount = 10;  // 10% discount
        }

        return $next($booking);
    }
}
