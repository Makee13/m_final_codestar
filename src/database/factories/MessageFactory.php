<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement(User::where('roles', 'user')
                                                            ->whereRaw('and email_verified_at', '!=', null)
                                                            ->pluck('id')),
            'message_text' => $this->faker->sentence(10, true)                                                         
        ];
    }
}
