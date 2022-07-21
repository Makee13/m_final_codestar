<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    const IMAGE_LIST = [
        '/storage/uploads/1/2022-05-14/SLIDER2.jpg',
        '/storage/uploads/1/2022-05-14/empowering-scent.jpg',
        '/storage/uploads/1/2022-05-14/Y0063401_E03_ZHC.webp'
    ];
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->catchPhrase,
            'thumb' => $this->faker->randomElement(self::IMAGE_LIST),
            'sort_by' => $this->faker->numberBetween(5, 100),
            'active' => $this->faker->randomElement(['0', '1']),
        ];
    }
}
