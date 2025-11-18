<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Admin',
                'description' => 'Administrator with full access to all features',
            ],
            [
                'name' => 'Writer',
                'description' => 'Can create and manage own articles',
            ],
            [
                'name' => 'Editor',
                'description' => 'Can edit, publish and manage all articles',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
