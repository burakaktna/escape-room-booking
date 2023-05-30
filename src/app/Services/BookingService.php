<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\User;
use App\Services\BookingSteps\CheckAvailability;
use App\Services\BookingSteps\CheckBirthday;
use Illuminate\Pipeline\Pipeline;

class BookingService
{
    public function createBooking(User $user, array $data): Booking
    {
        $booking = new Booking($data);
        $booking->escapeRoom()->associate($data['escape_room_id']);
        $booking->user_id = $user->id;

        $booking = app(Pipeline::class)
            ->send($booking)
            ->through([
                CheckAvailability::class,
                CheckBirthday::class,
            ])
            ->thenReturn();

        $booking->save();

        return $booking;
    }
}
