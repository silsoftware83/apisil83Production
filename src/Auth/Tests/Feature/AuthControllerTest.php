<?php

namespace Src\Auth\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $testUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a test user
        $this->testUser = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);
    }

    public function test_can_login_with_valid_credentials(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'user' => ['id', 'name', 'email', 'created_at', 'updated_at'],
                    'token',
                    'token_type'
                ],
                'message'
            ])
            ->assertJson([
                'success' => true,
                'data' => [
                    'user' => [
                        'email' => 'test@example.com',
                        'name' => 'Test User'
                    ],
                    'token_type' => 'Bearer'
                ]
            ]);
    }

    public function test_cannot_login_with_invalid_email(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'wrong@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'success' => false,
                'error' => 'Invalid credentials'
            ]);
    }

    public function test_cannot_login_with_invalid_password(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'success' => false,
                'error' => 'Invalid credentials'
            ]);
    }

    public function test_login_validation_fails_with_missing_fields(): void
    {
        $response = $this->postJson('/api/auth/login', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password']);
    }

    public function test_can_get_authenticated_user(): void
    {
        // Login first to get token
        $loginResponse = $this->postJson('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $token = $loginResponse->json('data.token');

        // Get authenticated user
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/auth/me');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => ['id', 'name', 'email', 'created_at', 'updated_at'],
                'message'
            ])
            ->assertJson([
                'success' => true,
                'data' => [
                    'email' => 'test@example.com',
                    'name' => 'Test User'
                ]
            ]);
    }

    public function test_cannot_get_user_without_authentication(): void
    {
        $response = $this->getJson('/api/auth/me');

        $response->assertStatus(401);
    }

    public function test_can_logout(): void
    {
        // Login first to get token
        $loginResponse = $this->postJson('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $token = $loginResponse->json('data.token');

        // Logout
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/auth/logout');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Logout successful'
            ]);

        // Try to access protected route with revoked token
        $meResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/auth/me');

        $meResponse->assertStatus(401);
    }

    public function test_cannot_logout_without_authentication(): void
    {
        $response = $this->postJson('/api/auth/logout');

        $response->assertStatus(401);
    }
}
