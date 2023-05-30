<?php

namespace Database\Factories;

use App\Models\EscapeRoom;
use App\Models\TimeSlot;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimeSlotFactory extends Factory
{
    protected $model = TimeSlot::class;

    public function definition(): array
    {
        return [
            'start_time' => $this->faker->time('Y-m-d'),
            'end_time' => $this->faker->time('Y-m-d'),
            'escape_room_id' => EscapeRoom::inRandomOrder()->first() ?? EscapeRoom::factory(),
        ];
    }
}
