<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            "phone" => $this->faker->phoneNumber(),
            "email" => $this->faker->unique()->safeEmail(),
            "fcm_token_key" => $this->faker->randomKey(),
            "password" => Hash::make('password'),
            "is_banned" => '0'
        ];
    }
}
