<?php

namespace Tests\Unit\Booking\Services\BookingSteps;

use App\Models\Booking;
use App\Models\EscapeRoom;
use App\Models\TimeSlot;
use App\Models\User;
use App\Services\BookingSteps\CheckAvailability;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Exception;

class CheckAvailabilityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws Exception
     */
    public function test_availability_check_passes()
    {
        $user = User::factory()->create();
        $escapeRoom = EscapeRoom::factory()->create();
        $timeSlot = TimeSlot::factory()->create();

        $booking = Booking::make([
            'user_id' => $user->id,
            'escape_room_id' => $escapeRoom->id,
            'time_slot_id' => $timeSlot->id,
            'participant_count' => 1
        ]);

        $checkAvailability = new CheckAvailability();

        $next = function ($bookingToCheck) {
            $this->assertEquals(1, $bookingToCheck->participant_count);
            return $bookingToCheck;
        };

        $result = $checkAvailability->handle($booking, $next);

        $this->assertInstanceOf(Booking::class, $result);
    }

    public function test_availability_check_fails()
    {
        $user = User::factory()->create();
        $escapeRoom = EscapeRoom::factory()->create();
        $timeSlot = TimeSlot::factory()->create();

        $existingBooking = Booking::factory()->create([
            'user_id' => $user->id,
            'escape_room_id' => $escapeRoom->id,
            'time_slot_id' => $timeSlot->id,
            'participant_count' => 1
        ]);

        $newBooking = Booking::make($existingBooking->toArray());

        $checkAvailability = new CheckAvailability();

        $next = function ($bookingToCheck) {
            return $bookingToCheck;
        };

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("This time slot is already booked for this escape room.");

        $checkAvailability->handle($newBooking, $next);
    }
}
