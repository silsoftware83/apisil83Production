<?php

namespace Src\Configuration\Security\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

final class SecurityControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_security(): void
    {
        $response = $this->getJson('/api/configuration/security');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data', 'message']);
    }

    public function test_can_create_security(): void
    {
        $data = [
            // TODO: Add test data
        ];

        $response = $this->postJson('/api/configuration/security', $data);

        $response->assertStatus(201)
                 ->assertJsonStructure(['data', 'message']);
    }

    public function test_can_update_security(): void
    {
        // TODO: Create a Security first
        // $security = ...;

        $data = [
            // TODO: Add update data
        ];

        $response = $this->putJson('/api/configuration/security/1', $data);

        $response->assertStatus(200);
    }

    public function test_can_delete_security(): void
    {
        // TODO: Create a Security first
        // $security = ...;

        $response = $this->deleteJson('/api/configuration/security/1');

        $response->assertStatus(204);
    }

    // TODO: Add more feature tests
}
