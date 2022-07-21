<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    const IMAGE_LIST = [
        '/storage/uploads/1/2022-05-14/photo-1594035910387-fea47794261f.avif',
        '/storage/uploads/1/2022-05-14/Y0996460_C099600755_E01_GHC.webp',
        '/storage/uploads/1/2022-05-14/Y0996347_C099600794_E01_ZHC.webp',
        '/storage/uploads/1/2022-05-14/Y0996027_C099600151_E01_GHC.webp',
        '/storage/uploads/1/2022-05-14/Y0083424_F008342409_E01_ZHC.webp',
        '/storage/uploads/1/2022-05-14/Y0866230_F086623009_E01_GHC.webp',
        '/storage/uploads/1/2022-05-14/Y0997013_C099700065_E01_GHC.webp',
        '/storage/uploads/1/2022-05-14/Y0997013_C099700065_E01_GHC.webp',
        '/storage/uploads/1/2022-05-14/Y0997013_C099700065_E01_GHC.webp',
        '/storage/uploads/1/2022-05-14/Y0997013_C099700065_E01_GHC.webp',
        '/storage/uploads/1/2022-05-14/photo-1594035910387-fea47794261f.avif',
        '/storage/uploads/1/2022-05-14/Y0996460_C099600755_E01_GHC.webp',
        '/storage/uploads/1/2022-05-14/Y0996027_C099600151_E01_GHC.webp',
    ];
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description'  => $this->faker->sentence(10),
            'content' => $this->faker->paragraph(2),
            'thumb' => $this->faker->randomElement(self::IMAGE_LIST),
            'category_id' => $this->faker->randomElement(Category::where('active', 1)->pluck('id')),
            'price' => $this->faker->numberBetween(10, 1000),
            'price_sale' => $this->faker->numberBetween(10, 100),
            'active' => 1,
        ];
    }
}
