<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User; // Import the User model
use Database\Factories\UserFactory; // Import the UserFactory

class FeedbackTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function a_user_can_submit_feedback()
    {
        $user = User::factory()->create(); // Use the User factory

        $response = $this->actingAs($user)->post('/submit-feedback', [
            'title' => 'Test Feedback',
            'description' => 'This is a test feedback.',
            'category' => 'feature_request',
        ]);

        $response->assertStatus(302); 
        $this->assertDatabaseHas('feedback', [
            'title' => 'Test Feedback',
            'user_id' => $user->id,
        ]);
    }
}
