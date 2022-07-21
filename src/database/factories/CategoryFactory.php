<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    const IS_ACTIVE = 1;
    const IS_NOT_ACTIVE = 0;
    const IMAGE_LIST = [
        '/storage/uploads/1/2022-06-09/perfume-bottle-gold-ribbons-black-background-confetti-glowing-sparkles-scent-glass-tube-package-design-women-fragrance-195188095.jpg',
        '/storage/uploads/1/2022-06-09/photo-1588514912908-8f5891714f8d.jpg',
        '/storage/uploads/1/2022-06-09/photo-1615634260167-c8cdede054de.jpg',
        '/storage/uploads/1/2022-06-09/photo-1615108395437-df128ad79e80.jpg',
        '/storage/uploads/1/2022-06-09/photo-1618994492420-b4f4d6b4890c.jpg',
        '/storage/uploads/1/2022-06-09/photo-1595456578656-5b0378a9a954.jpg',
        '/storage/uploads/1/2022-06-09/photo-1533414765079-4bb015a31395.jpg',
        '/storage/uploads/1/2022-06-09/photo-1533414765079-4bb015a31395.jpg',
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word(15);
        $slug = Str::slug($name);

        return [
            'name' => Str::ucfirst($name),
            'description' => $this->faker->word(20),
            'content' => $this->faker->paragraph(2),
            'slug' => $slug,
            'active' => $this->faker->randomElement([self::IS_NOT_ACTIVE, self::IS_ACTIVE]),
            'parent_id' => 0,
            'image' => $this->faker->randomElement(self::IMAGE_LIST)
        ];
    }
}
