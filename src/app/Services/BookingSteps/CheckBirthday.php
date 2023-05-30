<?php

namespace App\Services\BookingSteps;

use App\Models\Booking;
use App\Models\Discount;
use Carbon\Carbon;
use Closure;

class CheckBirthday
{
    public function handle(Booking $booking, Closure $next)
    {
        if (Carbon::parse($booking->timeSlot->start_time)->isBirthday($booking->user->date_of_birth)) {
            Discount::create([
                'booking_id' => $booking->id,
                'amount' => 10 // TODO booking price * 0.1
            ]);
        }

        return $next($booking);
    }
}
