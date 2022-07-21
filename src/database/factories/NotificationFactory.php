<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(20),
            'content' => $this->faker->paragraph(1),
            'notice_types' => $this->faker->randomElement(['ads', 'confirmed', 'warn']),
            'sender_id' => $this->faker->randomElement(User::where('roles', 'admin')->pluck('id')),
        ];
    }
}
