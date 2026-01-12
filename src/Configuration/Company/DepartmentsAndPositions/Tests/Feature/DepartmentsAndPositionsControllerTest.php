<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

final class DepartmentsAndPositionsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_departmentsandpositions(): void
    {
        $response = $this->getJson('/api/configuration/company/departmentsandpositions');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data', 'message']);
    }

    public function test_can_create_departmentsandpositions(): void
    {
        $data = [
            // TODO: Add test data
        ];

        $response = $this->postJson('/api/configuration/company/departmentsandpositions', $data);

        $response->assertStatus(201)
                 ->assertJsonStructure(['data', 'message']);
    }

    public function test_can_update_departmentsandpositions(): void
    {
        // TODO: Create a DepartmentsAndPositions first
        // $departmentsandpositions = ...;

        $data = [
            // TODO: Add update data
        ];

        $response = $this->putJson('/api/configuration/company/departmentsandpositions/1', $data);

        $response->assertStatus(200);
    }

    public function test_can_delete_departmentsandpositions(): void
    {
        // TODO: Create a DepartmentsAndPositions first
        // $departmentsandpositions = ...;

        $response = $this->deleteJson('/api/configuration/company/departmentsandpositions/1');

        $response->assertStatus(204);
    }

    // TODO: Add more feature tests
}
