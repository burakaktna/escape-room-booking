<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\EscapeRoom;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first() ?? User::factory(),
            'escape_room_id' => EscapeRoom::inRandomOrder()->first() ?? EscapeRoom::factory(),
            'time_slot_id' => TimeSlot::inRandomOrder()->first() ?? TimeSlot::factory(),
            'participant_count' => $this->faker->numberBetween(1,10)
        ];
    }
}
