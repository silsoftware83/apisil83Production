<?php

namespace Src\Configuration\Security\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Configuration\Security\Domain\Entities\Security;

final class SecurityTest extends TestCase
{
    public function test_can_create_entity(): void
    {
        $entity = new Security();
        
        $this->assertInstanceOf(Security::class, $entity);
        $this->assertNull($entity->getId());
    }

    public function test_can_convert_to_array(): void
    {
        $entity = new Security();
        $array = $entity->toArray();
        
        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
    }

    // TODO: Add more unit tests
}
