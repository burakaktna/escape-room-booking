<?php

namespace Database\Factories;

use App\Models\EscapeRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

class EscapeRoomFactory extends Factory
{
    protected $model = EscapeRoom::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'theme' => $this->faker->sentence(),
            'maximum_participants' => $this->faker->numberBetween(2,10)
        ];
    }
}
