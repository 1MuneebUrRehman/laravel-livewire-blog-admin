<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'avatar' => $this->faker->imageUrl(100, 100, 'people'),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'remember_token' => Str::random(10),
        ];
    }

    public function admin(): static
    {
        return $this->state([
            'name' => 'Admin User',
            'email' => 'admin@blog.com',
            'status' => 'active',
        ]);
    }

    public function writer(): static
    {
        return $this->state([
            'name' => 'Writer User',
            'email' => 'writer@blog.com',
            'status' => 'active',
        ]);
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
