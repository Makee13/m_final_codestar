<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\WishsList;
use Illuminate\Database\Eloquent\Factories\Factory;

class WishsListProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'wishs_list_id' => $this->faker->randomElement(WishsList::pluck('id')),
            'product_id' => $this->faker->randomElement(Product::where('active', 1)->pluck('id'))
        ];
    }
}
