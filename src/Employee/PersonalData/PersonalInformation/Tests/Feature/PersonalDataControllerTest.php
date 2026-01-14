<?php

namespace Src\Employee\PersonalData\PersonalInformation\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

final class PersonalDataControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_personaldata(): void
    {
        $response = $this->getJson('/api/employee/personaldata');

        $response->assertStatus(200)
            ->assertJsonStructure(['data', 'message']);
    }

    public function test_can_create_personaldata(): void
    {
        $data = [
            // TODO: Add test data
        ];

        $response = $this->postJson('/api/employee/personaldata', $data);

        $response->assertStatus(201)
            ->assertJsonStructure(['data', 'message']);
    }

    public function test_can_update_personaldata(): void
    {
        // TODO: Create a PersonalData first
        // $personaldata = ...;

        $data = [
            // TODO: Add update data
        ];

        $response = $this->putJson('/api/employee/personaldata/1', $data);

        $response->assertStatus(200);
    }

    public function test_can_delete_personaldata(): void
    {
        // TODO: Create a PersonalData first
        // $personaldata = ...;

        $response = $this->deleteJson('/api/employee/personaldata/1');

        $response->assertStatus(204);
    }

    // TODO: Add more feature tests
}
