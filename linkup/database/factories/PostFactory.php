<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 *
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
            //
            'headline' => fake()->sentence(6),
            'content' => fake()->paragraph(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
