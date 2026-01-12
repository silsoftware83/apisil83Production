<?php

namespace Src\Auth\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Auth\Domain\Entities\User;

final class UserTest extends TestCase
{
    public function test_can_create_user_entity(): void
    {
        $user = new User(
            id: 1,
            name: 'Test User',
            email: 'test@example.com'
        );

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());
        $this->assertEquals('Test User', $user->getName());
        $this->assertEquals('test@example.com', $user->getEmail());
    }

    public function test_can_convert_user_to_array(): void
    {
        $user = new User(
            id: 1,
            name: 'Test User',
            email: 'test@example.com'
        );

        $array = $user->toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('email', $array);
        $this->assertEquals(1, $array['id']);
        $this->assertEquals('Test User', $array['name']);
        $this->assertEquals('test@example.com', $array['email']);
    }

    public function test_can_set_user_properties(): void
    {
        $user = new User();

        $user->setId(1);
        $user->setName('Updated Name');
        $user->setEmail('updated@example.com');

        $this->assertEquals(1, $user->getId());
        $this->assertEquals('Updated Name', $user->getName());
        $this->assertEquals('updated@example.com', $user->getEmail());
    }
}
