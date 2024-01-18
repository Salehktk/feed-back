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
            'name' => 'Qaiser Shehbaz',
            'email' => 'Qaiser@gmail.com',
            'password' => Hash::make('test1234'),
        ]);

        User::create([
            'name' => 'Wajid Ali',
            'email' => 'Wajid@gmail.com',
            'password' => Hash::make('test1234'),
        ]);

        User::create([
            'name' => 'Yousaf Zaman',
            'email' => 'Yousaf@gmail.com',   
            'password' => Hash::make('test1234'),
        ]);
        User::create([
            'name' => 'Fawad',
            'email' => 'Fawad@gmail.com',   
            'password' => Hash::make('test1234'),
        ]);
        User::create([
            'name' => 'Aslam',
            'email' => 'Aslam@gmail.com',   
            'password' => Hash::make('test1234'),
        ]);
        User::create([
            'name' => 'Hafeez',
            'email' => 'Hafeez@gmail.com',   
            'password' => Hash::make('test1234'),
        ]);
    }
}
