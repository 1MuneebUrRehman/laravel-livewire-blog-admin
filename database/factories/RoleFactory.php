<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Role>
 */
class RoleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
        ];
    }

    public function admin(): static
    {
        return $this->state([
            'name' => 'Admin',
            'description' => 'Administrator with full access',
        ]);
    }

    public function writer(): static
    {
        return $this->state([
            'name' => 'Writer',
            'description' => 'Can write and manage own articles',
        ]);
    }

    public function editor(): static
    {
        return $this->state([
            'name' => 'Editor',
            'description' => 'Can edit and publish articles',
        ]);
    }
}
