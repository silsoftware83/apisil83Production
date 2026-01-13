<?php

namespace Src\Employee\Directory\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

final class DirectoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_directory(): void
    {
        $response = $this->getJson('/api/employee/directory');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data', 'message']);
    }

    public function test_can_create_directory(): void
    {
        $data = [
            // TODO: Add test data
        ];

        $response = $this->postJson('/api/employee/directory', $data);

        $response->assertStatus(201)
                 ->assertJsonStructure(['data', 'message']);
    }

    public function test_can_update_directory(): void
    {
        // TODO: Create a Directory first
        // $directory = ...;

        $data = [
            // TODO: Add update data
        ];

        $response = $this->putJson('/api/employee/directory/1', $data);

        $response->assertStatus(200);
    }

    public function test_can_delete_directory(): void
    {
        // TODO: Create a Directory first
        // $directory = ...;

        $response = $this->deleteJson('/api/employee/directory/1');

        $response->assertStatus(204);
    }

    // TODO: Add more feature tests
}
