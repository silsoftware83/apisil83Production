<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Configuration\Company\DepartmentsAndPositions\Domain\Entities\DepartmentsAndPositions;

final class DepartmentsAndPositionsTest extends TestCase
{
    public function test_can_create_entity(): void
    {
        $entity = new DepartmentsAndPositions();
        
        $this->assertInstanceOf(DepartmentsAndPositions::class, $entity);
        $this->assertNull($entity->getId());
    }

    public function test_can_convert_to_array(): void
    {
        $entity = new DepartmentsAndPositions();
        $array = $entity->toArray();
        
        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
    }

    // TODO: Add more unit tests
}
