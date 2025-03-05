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
            'username' => 'user_123',
            'password' => Hash::make('dexter123'),
            'email' => 'user_123@example.com',
            'number' => '091234567524',
            'first_name' => 'User',
            'middle_name' => 'T.',
            'last_name' => 'Testing',
            'suffix' => 'II',
            'user_type' => 'User',
        ]);
    }
}


