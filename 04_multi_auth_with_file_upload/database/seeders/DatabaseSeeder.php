<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Test User',
            'email' => 'test@user.com',
            'password' => Hash::make('123456')
        ]);
        User::create([
            'name' => 'Test Admin',
            'email' => 'test@admin.com',
            'password' => Hash::make('123456'),
            'role' => 'admin'
        ]);
    }
}