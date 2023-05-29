<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'time_slot_id' => TimeSlot::factory(),
            'participant_count' => $this->faker->numberBetween(1,10)
        ];
    }
}
