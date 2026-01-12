<?php

namespace Src\Employee\PersonalData\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Employee\PersonalData\Domain\Entities\PersonalData;

final class PersonalDataTest extends TestCase
{
    public function test_can_create_entity(): void
    {
        $entity = new PersonalData();
        
        $this->assertInstanceOf(PersonalData::class, $entity);
        $this->assertNull($entity->getId());
    }

    public function test_can_convert_to_array(): void
    {
        $entity = new PersonalData();
        $array = $entity->toArray();
        
        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
    }

    // TODO: Add more unit tests
}
