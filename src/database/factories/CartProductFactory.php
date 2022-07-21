<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cart_id' => $this->faker->randomElement(Cart::pluck('id')),
            'product_id' => $this->faker->randomElement(Product::where('active', 1)->pluck('id')),
            'amount_product' => $this->faker->numberBetWeen(1, 10)
        ];
    }
}
