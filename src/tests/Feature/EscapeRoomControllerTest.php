<?php

namespace Tests\Feature;

use App\Models\EscapeRoom;
use App\Models\TimeSlot;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EscapeRoomControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_all_escape_rooms()
    {
        EscapeRoom::factory()->count(5)->create();

        $response = $this->get('/api/escape-rooms');

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
    }

    public function test_can_show_escape_room_by_id()
    {
        $escapeRoom = EscapeRoom::factory()->create();

        $response = $this->get("/api/escape-rooms/{$escapeRoom->id}");

        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $escapeRoom->id);
    }

    public function test_should_return_error_if_escape_room_not_found()
    {
        $response = $this->get("/api/escape-rooms/999");

        $response->assertStatus(404);
    }

    public function test_can_list_time_slots_for_escape_room()
    {
        $escapeRoom = EscapeRoom::factory()->create();
        TimeSlot::factory()->count(3)->for($escapeRoom)->create();

        $response = $this->get("/api/escape-rooms/{$escapeRoom->id}/time-slots");

        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
    }
}
