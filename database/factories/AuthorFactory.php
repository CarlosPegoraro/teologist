<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'site' => $this->faker->optional()->url,
            'instagram' => $this->faker->optional()->userName,
            'phone' => $this->faker->optional()->phoneNumber,
            'about' => $this->faker->optional()->sentence,
            'title' => $this->faker->optional()->jobTitle,
        ];
    }
}
