<?php

namespace Tests\Unit\Booking\Services\BookingSteps;

use App\Models\Booking;
use App\Models\Discount;
use App\Models\EscapeRoom;
use App\Models\TimeSlot;
use App\Models\User;
use App\Services\BookingSteps\CheckBirthday;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;
use Closure;

class CheckBirthdayTest extends TestCase
{
    use RefreshDatabase;

    public function test_birthday_discount_applies()
    {
        $user = User::factory()->create(['date_of_birth' => Carbon::today()->subYears(20)]);
        $escapeRoom = EscapeRoom::factory()->create();
        $timeSlot = TimeSlot::factory()->create(['start_time' => Carbon::today()]);

        $booking = Booking::factory()->create([
            'user_id' => $user->id,
            'escape_room_id' => $escapeRoom->id,
            'time_slot_id' => $timeSlot->id,
        ]);

        $checkBirthday = new CheckBirthday();

        $next = function ($bookingToCheck) {
            return $bookingToCheck;
        };

        $result = $checkBirthday->handle($booking, $next);

        $this->assertInstanceOf(Booking::class, $result);
        $this->assertDatabaseHas('discounts', [
            'booking_id' => $booking->id,
            'amount' => 10
        ]);
    }

    public function test_birthday_discount_does_not_apply()
    {
        $user = User::factory()->create(['date_of_birth' => Carbon::today()->subYears(20)]);
        $escapeRoom = EscapeRoom::factory()->create();
        $timeSlot = TimeSlot::factory()->create(['start_time' => Carbon::tomorrow()]);

        $booking = Booking::factory()->create([
            'user_id' => $user->id,
            'escape_room_id' => $escapeRoom->id,
            'time_slot_id' => $timeSlot->id,
        ]);

        $checkBirthday = new CheckBirthday();

        $next = function ($bookingToCheck) {
            return $bookingToCheck;
        };

        $result = $checkBirthday->handle($booking, $next);

        $this->assertInstanceOf(Booking::class, $result);
        $this->assertDatabaseMissing('discounts', [
            'booking_id' => $booking->id,
        ]);
    }
}
