<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence();
        $content = $this->faker->paragraphs(10, true);

        return [
            'user_id' => User::factory(),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->paragraph(),
            'content' => $content,
            'featured_image' => $this->faker->imageUrl(800, 400, 'nature'),
            'published_at' => $this->faker->optional(0.7)->dateTimeBetween('-1 year', '+1 month'),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            'reading_time' => max(1, round(str_word_count($content) / 200)),
            'views' => $this->faker->numberBetween(0, 10000),
        ];
    }

    public function published(): static
    {
        return $this->state([
            'status' => 'published',
            'published_at' => now()->subDays(rand(1, 365)),
        ]);
    }

    public function draft(): static
    {
        return $this->state([
            'status' => 'draft',
            'published_at' => null,
        ]);
    }

    public function withCategory($categoryId): static
    {
        return $this->state([
            'category_id' => $categoryId,
        ]);
    }

    public function withUser($userId): static
    {
        return $this->state([
            'user_id' => $userId,
        ]);
    }
}
