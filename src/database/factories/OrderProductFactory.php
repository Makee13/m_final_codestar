<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomDay = Carbon::today()->subDays(rand(0, 365));

        return [
            'order_id' => $this->faker->randomElement(Order::pluck('id')),
            'product_id' => $this->faker->randomElement(Product::where('active', 1)->pluck('id')),
            'amount_product' => $this->faker->numberBetween(10, 100),
            'created_at' => $randomDay,
            'updated_at' => $randomDay,
        ];
    }
}
