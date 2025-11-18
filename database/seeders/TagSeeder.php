<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'laravel', 'php', 'javascript', 'vue', 'react', 'angular',
            'nodejs', 'python', 'docker', 'kubernetes', 'aws', 'azure',
            'mysql', 'postgresql', 'mongodb', 'redis', 'git', 'github',
            'ci-cd', 'testing', 'api', 'rest', 'graphql', 'microservices',
            'agile', 'scrum', 'ux', 'ui', 'css', 'html5', 'sass', 'less'
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => ucfirst($tag),
                'slug' => $tag,
            ]);
        }
    }
}
