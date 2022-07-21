<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserNotificationFactory extends Factory
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
            'notification_id' => $this->faker->randomElement(Notification::pluck('id'))
        ];
    }
}
