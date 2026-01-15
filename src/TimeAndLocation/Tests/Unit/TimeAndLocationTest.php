<?php

namespace Src\TimeAndLocation\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\TimeAndLocation\Domain\Entities\TimeAndLocation;

final class TimeAndLocationTest extends TestCase
{
    public function test_can_create_entity(): void
    {
        $entity = new TimeAndLocation();
        
        $this->assertInstanceOf(TimeAndLocation::class, $entity);
        $this->assertNull($entity->getId());
    }

    public function test_can_convert_to_array(): void
    {
        $entity = new TimeAndLocation();
        $array = $entity->toArray();
        
        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
    }

    // TODO: Add more unit tests
}
