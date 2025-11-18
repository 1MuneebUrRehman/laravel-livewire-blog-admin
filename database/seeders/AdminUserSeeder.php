<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'Admin')->first();
        $writerRole = Role::where('name', 'Writer')->first();
        $editorRole = Role::where('name', 'Editor')->first();

        // Create admin user
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@blog.com',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);
        $admin->roles()->attach($adminRole);

        // Create writer user
        $writer = User::create([
            'name' => 'Content Writer',
            'email' => 'writer@blog.com',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);
        $writer->roles()->attach($writerRole);

        // Create editor user
        $editor = User::create([
            'name' => 'Content Editor',
            'email' => 'editor@blog.com',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);
        $editor->roles()->attach($editorRole);

        // Create additional test users
        User::factory(10)->create()->each(function ($user) use ($writerRole) {
            $user->roles()->attach($writerRole);
        });
    }
}
