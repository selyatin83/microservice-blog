<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Hash;

/**
 * @extends Factory
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'login' => fake()->unique()->word(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('12345678'), // password
        ];
    }
}
