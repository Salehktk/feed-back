<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User; 
use Database\Factories\UserFactory; 

class AuthenticationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function a_user_can_logout()
    {
        $user = User::factory()->create(); 

        $response = $this->actingAs($user)->post('/logout');

        $response->assertStatus(302);
        $this->assertGuest(); 
    }
}
