<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    /** @test
     * @throws Exception
     */
    public function it_registers_a_new_user(): void
    {
        $userData = User::factory()->make()->toArray();
        $userData['password'] = 'password';

        $user = $this->userService->register($userData);

        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'email' => $userData['email'],
            'date_of_birth' => $userData['date_of_birth'],
        ]);

        $this->assertEquals($userData['name'], $user->name);
        $this->assertEquals($userData['email'], $user->email);
    }

    /** @test
     * @throws Exception
     */
    public function it_logs_in_a_user(): void
    {
        $userData = User::factory()->make()->toArray();
        $userData['password'] = 'password';

        $this->userService->register($userData);

        $token = $this->userService->login($userData['email'], 'password');

        $this->assertNotEmpty($token);
    }
}

