<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'title' => fake()->words(3, true),
            'description' => fake()->realText(100),
            'user_id' => fake()->randomElement(User::all()),
            'image' => resource_path('img/example.png'),
            'publish_date' => fake()->date()
        ];
    }
}
