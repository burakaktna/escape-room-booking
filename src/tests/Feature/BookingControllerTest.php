<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\EscapeRoom;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_booking()
    {
        $user = User::factory()->create();
        $escapeRoom = EscapeRoom::factory()->create();
        $timeSlot = TimeSlot::factory()->create();

        $response = $this->actingAs($user)->post('/api/bookings', [
            'user_id' => $user->id,
            'escape_room_id' => $escapeRoom->id,
            'time_slot_id' => $timeSlot->id,
            'participant_count' => 1
        ]);

        $response->assertStatus(201);
    }

    public function test_can_list_all_bookings_for_authenticated_user()
    {
        $user = User::factory()->create();
        Booking::factory()->count(3)->for($user)->create();

        $response = $this->actingAs($user)->get('/api/bookings');

        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
    }

    public function test_can_delete_a_booking()
    {
        $user = User::factory()->create();
        $booking = Booking::factory()->for($user)->create();

        $response = $this->actingAs($user)->delete("/api/bookings/{$booking->id}");

        $response->assertStatus(204);
    }

    public function test_should_return_error_if_booking_not_found()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->delete("/api/bookings/999");

        $response->assertStatus(404);
    }
}
