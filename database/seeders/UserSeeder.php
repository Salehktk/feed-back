<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          User::create([
            'name' => 'User1',
            'email' => 'user1@example.com',
            'password' => Hash::make('user1234'),
        ]);

        User::create([
            'name' => 'User2',
            'email' => 'user2@example.com',
            'password' => Hash::make('user1234'),
        ]);

        User::create([
            'name' => 'User3',
            'email' => 'user3@example.com',
            'password' => Hash::make('user1234'),
        ]);
    }
}
