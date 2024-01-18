<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Feedback;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::limit(6)->get();
    
        foreach ($users as $user) {
            Feedback::updateOrCreate([
                'title' => 'Feedback Title for ' . $user->name,
                'description' => 'Sample description for the feedback.',
                'category' => 'Bug report',
                'status' => 1,
                'user_id' => $user->id,
            ]);
        }
    }
}
