<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'article_id' => Article::factory(),
            'user_id' => User::factory(),
            'parent_id' => null, // Default to top-level comment
            'content' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }

    public function approved(): static
    {
        return $this->state([
            'status' => 'approved',
        ]);
    }

    public function pending(): static
    {
        return $this->state([
            'status' => 'pending',
        ]);
    }

    public function reply(): static
    {
        return $this->state([
            'parent_id' => Comment::factory(),
        ]);
    }
}