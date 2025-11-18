<?php
// database/seeders/LikeSeeder.php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    public function run(): void
    {
        $articles = Article::published()->get();
        $users = User::all();

        $likes = [];

        foreach ($articles as $article) {
            // Determine how many likes this article should have (0 to 50% of users)
            $likeCount = rand(0, (int)($users->count() * 0.5));

            // Get random users to like this article
            $randomUsers = $users->random($likeCount);

            foreach ($randomUsers as $user) {
                $likes[] = [
                    'article_id' => $article->id,
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert all likes in batches for better performance
        foreach (array_chunk($likes, 1000) as $chunk) {
            Like::insert($chunk);
        }

        $this->command->info('Likes seeded successfully! Total likes: ' . count($likes));
    }
}