<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\User;
use App\Services\BookingSteps\CheckAvailability;
use App\Services\BookingSteps\CheckBirthday;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use Exception;

class BookingService
{
    /**
     * @throws Exception
     */
    public function createBooking(User $user, array $data): Booking
    {
        $booking = new Booking($data);
        $booking->escapeRoom()->associate($data['escape_room_id']);
        $booking->user_id = $user->id;

        DB::beginTransaction();

        try {
            app(Pipeline::class)
                ->send($booking)
                ->through([
                    CheckAvailability::class,
                    CheckBirthday::class,
                ]);

            $booking->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Booking could not be created: " . $e->getMessage());
        }

        return $booking;
    }
}
