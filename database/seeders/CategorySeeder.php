<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology', 'description' => 'Articles about technology and innovation'],
            ['name' => 'Programming', 'description' => 'Programming tutorials and best practices'],
            ['name' => 'Web Development', 'description' => 'Frontend and backend web development'],
            ['name' => 'Mobile Development', 'description' => 'iOS and Android app development'],
            ['name' => 'DevOps', 'description' => 'DevOps practices and tools'],
            ['name' => 'Data Science', 'description' => 'Data analysis and machine learning'],
            ['name' => 'Design', 'description' => 'UI/UX design and principles'],
            ['name' => 'Business', 'description' => 'Business and entrepreneurship'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
