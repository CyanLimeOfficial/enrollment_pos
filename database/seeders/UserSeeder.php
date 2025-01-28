<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'user_12',
            'password' => Hash::make('user_12'),
            'email' => 'user_12@example.com',
            'number' => '09123456754',
            'first_name' => 'User',
            'middle_name' => 'T.',
            'last_name' => 'Testing',
            'suffix' => 'II',
            'user_type' => 'User',
        ]);
    }
}


