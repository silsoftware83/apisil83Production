<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs;

use Src\Configuration\Company\DepartmentsAndPositions\Domain\Exceptions\DepartmentsAndPositionsValidationException;

final class CreateDepartmentsAndPositionsDTO
{
    public function __construct(
        // TODO: Add required properties
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        // TODO: Add validation logic
        // Example:
        // if (empty($this->name)) {
        //     throw new DepartmentsAndPositionsValidationException('Name is required');
        // }
    }

    public function toArray(): array
    {
        return [
            // TODO: Map properties
        ];
    }
}
