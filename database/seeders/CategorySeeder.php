<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Technology',
                'slug'        => 'technology',
                'description' => 'Articles about technology and innovation'
            ],
            [
                'name'        => 'Programming',
                'slug'        => 'programming',
                'description' => 'Programming tutorials and best practices'
            ],
            [
                'name'        => 'Web Development',
                'slug'        => 'web-development',
                'description' => 'Frontend and backend web development'
            ],
            [
                'name'        => 'Mobile Development',
                'slug'        => 'mobile-development',
                'description' => 'iOS and Android app development'
            ],
            [
                'name'        => 'DevOps',
                'slug'        => 'devops',
                'description' => 'DevOps practices and tools'
            ],
            [
                'name'        => 'Data Science',
                'slug'        => 'data-science',
                'description' => 'Data analysis and machine learning'
            ],
            [
                'name'        => 'Design',
                'slug'        => 'design',
                'description' => 'UI/UX design and principles'
            ],
            [
                'name'        => 'Business',
                'slug'        => 'business',
                'description' => 'Business and entrepreneurship'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
