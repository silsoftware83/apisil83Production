<?php

namespace Src\TimeAndLocation\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

final class TimeAndLocationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_timeandlocation(): void
    {
        $response = $this->getJson('/api/timeandlocation');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data', 'message']);
    }

    public function test_can_create_timeandlocation(): void
    {
        $data = [
            // TODO: Add test data
        ];

        $response = $this->postJson('/api/timeandlocation', $data);

        $response->assertStatus(201)
                 ->assertJsonStructure(['data', 'message']);
    }

    public function test_can_update_timeandlocation(): void
    {
        // TODO: Create a TimeAndLocation first
        // $timeandlocation = ...;

        $data = [
            // TODO: Add update data
        ];

        $response = $this->putJson('/api/timeandlocation/1', $data);

        $response->assertStatus(200);
    }

    public function test_can_delete_timeandlocation(): void
    {
        // TODO: Create a TimeAndLocation first
        // $timeandlocation = ...;

        $response = $this->deleteJson('/api/timeandlocation/1');

        $response->assertStatus(204);
    }

    // TODO: Add more feature tests
}
