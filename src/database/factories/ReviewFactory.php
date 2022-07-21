<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->paragraph(1),
            'amount_of_stars' => $this->faker->numberBetween(0, 5),
            'product_id' => $this->faker->randomElement(Product::where('active', '1')->pluck('id')),
            'user_id' => $this->faker->randomElement(User::where('email_verified_at', '!=', null)->pluck('id'))
        ];
    }
}
