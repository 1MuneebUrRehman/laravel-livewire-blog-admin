<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->words(2, true);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
            'icon' => $this->faker->randomElement([
                'fas fa-laptop-code',
                'fas fa-chart-line',
                'fas fa-chart-pie',
                'fas fa-users',
                'fas fa-lightbulb',
                'fas fa-briefcase'
            ]), // Add this line
        ];
    }
}
