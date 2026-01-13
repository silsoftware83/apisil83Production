<?php

namespace Src\Employee\Directory\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Employee\Directory\Domain\Entities\Directory;

final class DirectoryTest extends TestCase
{
    public function test_can_create_entity(): void
    {
        $entity = new Directory();
        
        $this->assertInstanceOf(Directory::class, $entity);
        $this->assertNull($entity->getId());
    }

    public function test_can_convert_to_array(): void
    {
        $entity = new Directory();
        $array = $entity->toArray();
        
        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
    }

    // TODO: Add more unit tests
}
