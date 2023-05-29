<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Discount;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountFactory extends Factory
{
    protected $model = Discount::class;

    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'amount' => $this->faker->randomFloat(0, 0, 100),
            'type' => $this->faker->randomElement(['birthday', 'promo_code', 'seasonal']),
        ];
    }
}
