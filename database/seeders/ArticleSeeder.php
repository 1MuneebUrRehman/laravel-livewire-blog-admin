<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['Writer', 'Editor', 'Admin']);
        })->get();

        $tags = Tag::all();

        // Create articles with existing users
        Article::factory(50)
            ->create([
                'user_id' => fn() => $users->random()->id,
            ])
            ->each(function ($article) use ($tags) {
                // Assign random tags (2-5 per article)
                $article->tags()->attach(
                    $tags->random(rand(2, 5))->pluck('id')->toArray()
                );
            });
    }
}