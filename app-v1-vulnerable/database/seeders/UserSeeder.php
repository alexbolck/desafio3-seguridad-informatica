<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('Admin123!'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Alice Example',
            'email' => 'alice@test.com',
            'password' => Hash::make('User123!'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Bob Example',
            'email' => 'bob@test.com',
            'password' => Hash::make('User123!'),
            'role' => 'user',
        ]);
    }
}
