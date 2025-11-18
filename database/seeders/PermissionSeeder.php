<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'Manage Users', 'key' => 'manage_users'],
            ['name' => 'Manage Roles', 'key' => 'manage_roles'],
            ['name' => 'Manage Permissions', 'key' => 'manage_permissions'],
            ['name' => 'Manage Categories', 'key' => 'manage_categories'],
            ['name' => 'Manage Tags', 'key' => 'manage_tags'],
            ['name' => 'Manage Articles', 'key' => 'manage_articles'],
            ['name' => 'Manage Comments', 'key' => 'manage_comments'],
            ['name' => 'Manage Settings', 'key' => 'manage_settings'],
            ['name' => 'Create Articles', 'key' => 'create_articles'],
            ['name' => 'Edit Articles', 'key' => 'edit_articles'],
            ['name' => 'Delete Articles', 'key' => 'delete_articles'],
            ['name' => 'Publish Articles', 'key' => 'publish_articles'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Assign permissions to roles
        $adminRole = Role::where('name', 'Admin')->first();
        $editorRole = Role::where('name', 'Editor')->first();
        $writerRole = Role::where('name', 'Writer')->first();

        $adminRole->permissions()->attach(Permission::all());

        $editorPermissions = Permission::whereIn('key', [
            'manage_articles', 'manage_comments', 'create_articles',
            'edit_articles', 'delete_articles', 'publish_articles'
        ])->get();
        $editorRole->permissions()->attach($editorPermissions);

        $writerPermissions = Permission::whereIn('key', [
            'create_articles', 'edit_articles', 'delete_articles'
        ])->get();
        $writerRole->permissions()->attach($writerPermissions);
    }
}
