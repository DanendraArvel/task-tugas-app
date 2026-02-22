<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;db:
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'password_confirmation' => Hash::make('password123'),
            'token' => 'admin',
            ]
        );

        User::create(
            [
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'password_confirmation' => Hash::make('password123'),
            'token' => 'user',
            ]
    );

        User::create(
            [
            'name' => 'Guru 1',
            'email' => 'guru1@example.com',
            'password' => Hash::make('password123'),
            'password_confirmation' => Hash::make('password123'),
            'token' => 'admin',
            ]
    );

        User::create(
            [
            'name' => 'Guru 2',
            'email' => 'guru2@example.com',
            'password' => Hash::make('password123'),
            'password_confirmation' => Hash::make('password123'),
            'token' => 'admin',
            ]
    );

        User::create(
            [
            'name' => 'Guru 3',
            'email' => 'guru3@example.com',
            'password' => Hash::make('password123'),
            'password_confirmation' => Hash::make('password123'),
            'token' => 'admin',
            ]
    );

    }
}
