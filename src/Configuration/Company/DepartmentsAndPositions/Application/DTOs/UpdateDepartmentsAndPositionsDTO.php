<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs;

use Src\Configuration\Company\DepartmentsAndPositions\Domain\Exceptions\DepartmentsAndPositionsValidationException;

final class UpdateDepartmentsAndPositionsDTO
{
    public function __construct(
        public readonly int $id,
        // TODO: Add properties to update
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if ($this->id <= 0) {
            throw new DepartmentsAndPositionsValidationException('Invalid ID');
        }
        // TODO: Add more validation logic
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            // TODO: Map properties
        ];
    }
}
