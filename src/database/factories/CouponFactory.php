<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CouponFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => Str::upper($this->faker->text(20)),
            'description' => $this->faker->paragraph(1),
            'decreased_price' =>$this->faker->numberBetween(10.0, 100.0),
            'expired_date' => $this->faker->dateTimeBetween('+1 days', '+1 weeks'),
        ];
    }
}
