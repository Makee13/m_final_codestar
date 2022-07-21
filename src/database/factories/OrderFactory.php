<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount_product' => $this->faker->numberBetween(10, 100),
            'total_price' => $this->faker->randomFloat(null, 500.00, 2000.00),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
            'status' => $this->faker->randomElement(['delivered']),
        ];
    }
}
