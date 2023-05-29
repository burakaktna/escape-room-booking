<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testRegister()
    {
        $userData = User::factory()->make()->toArray();
        $userData['password'] = 'password';
        $userData['password_confirmation'] = 'password';

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(201)
            ->assertJsonStructure(['data' => ['name', 'email', 'date_of_birth']]);
    }

    public function testLogin()
    {
        // Register a user
        $userData = User::factory()->make()->toArray();
        $userData['password'] = 'password';
        $userData['password_confirmation'] = 'password';

        $this->postJson('/api/register', $userData);

        // Log in with the same user
        $loginData = [
            'email' => $userData['email'],
            'password' => 'password',
        ];

        $response = $this->postJson('/api/login', $loginData);

        $response->assertStatus(200)->assertJsonStructure(['token']);
    }
}

