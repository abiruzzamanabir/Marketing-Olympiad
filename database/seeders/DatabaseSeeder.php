<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\Admin;
use App\Models\Permission;
use App\Models\Theme;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Admin::create([
            'first_name' => 'Provider',
            'last_name' => '',
            'email' => 'Provider@gmail.com',
            'cell' => '01763872277',
            'username' => 'provider',
            'password' => Hash::make('12345678'),
            'role_id' => 1,
        ]);

        Permission::create([
            'name' => 'Admin user',
            'slug' => 'admin-user',
        ]);
        Permission::create([
            'name' => 'Role',
            'slug' => 'role',
        ]);
        Permission::create([
            'name' => 'Permission',
            'slug' => 'permission',
        ]);
        Permission::create([
            'name' => 'Theme option',
            'slug' => 'theme-option',
        ]);



        Role::create([
            'name' => 'Super Admin',
            'slug' => 'super-admin',
            'permission' => '["admin-user","role","permission","theme-option"]',
        ]);
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'permission' => '[]',
        ]);
        Role::create([
            'name' => 'Student',
            'slug' => 'student',
            'permission' => '[]',
        ]);
        Role::create([
            'name' => 'Editor',
            'slug' => 'editor',
            'permission' => '[]',
        ]);
        Theme::create([
            'logo' => 'logo.png',
            'favicon' => 'favicon.png',
            'social' => '{"facebook":"","twitter":"","linkedin":"","instagram":"","dribbble":""}',
            'title' => 'Demo title',
            'tagline' => 'Demo Tagline',
            'copyright' => '2023 Copyright',
        ]);
    }
}
