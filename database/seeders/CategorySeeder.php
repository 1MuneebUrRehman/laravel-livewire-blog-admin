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
                'description' => 'Articles about technology and innovation',
                'icon'        => 'fas fa-laptop-code'
            ],
            [
                'name'        => 'Marketing',
                'slug'        => 'marketing',
                'description' => 'Marketing strategies and trends',
                'icon'        => 'fas fa-chart-line'
            ],
            [
                'name'        => 'Finance',
                'slug'        => 'finance',
                'description' => 'Financial insights and analysis',
                'icon'        => 'fas fa-chart-pie'
            ],
            [
                'name'        => 'Leadership',
                'slug'        => 'leadership',
                'description' => 'Leadership development and team management',
                'icon'        => 'fas fa-users'
            ],
            [
                'name'        => 'Innovation',
                'slug'        => 'innovation',
                'description' => 'Innovative ideas and creative thinking',
                'icon'        => 'fas fa-lightbulb'
            ],
            [
                'name'        => 'Business',
                'slug'        => 'business',
                'description' => 'Business strategies and entrepreneurship',
                'icon'        => 'fas fa-briefcase'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}