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
            [
                'name'        => 'Data Science',
                'slug'        => 'data-science',
                'description' => 'Analytics, machine learning, data visualization, and BI tools',
                'icon'        => 'fas fa-database'
            ],
            [
                'name'        => 'Productivity',
                'slug'        => 'productivity',
                'description' => 'Time management, workflow optimization, and efficiency tools',
                'icon'        => 'fas fa-tasks'
            ],
            [
                'name'        => 'Career',
                'slug'        => 'career',
                'description' => 'Professional development, job search, and skill building',
                'icon'        => 'fas fa-user-graduate'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}