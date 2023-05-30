<?php

namespace Tests\Unit\Booking;

use App\Models\Booking;
use App\Models\EscapeRoom;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_booking()
    {
        $user = User::factory()->create();
        $escapeRoom = EscapeRoom::factory()->create();
        $timeSlot = TimeSlot::factory()->create();

        $booking = Booking::create([
            'user_id' => $user->id,
            'escape_room_id' => $escapeRoom->id,
            'time_slot_id' => $timeSlot->id,
            'participant_count' => 1
        ]);

        $this->assertDatabaseHas('bookings', $booking->toArray());
    }

    public function test_update_booking()
    {
        $booking = Booking::factory()->create();

        $booking->update([
            'participant_count' => 10
        ]);

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'participant_count' => 10
        ]);
    }

    public function test_delete_booking()
    {
        $booking = Booking::factory()->create();

        $booking->delete();

        $this->assertDatabaseMissing('bookings', $booking->toArray());
    }
}
