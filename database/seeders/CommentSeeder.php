<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $articles = Article::published()->get();
        $users = User::all();

        foreach ($articles as $article) {
            $commentCount = rand(0, 15);

            Comment::factory($commentCount)->create([
                'article_id' => $article->id,
                'user_id' => $users->random()->id,
            ]);
        }
    }
}
