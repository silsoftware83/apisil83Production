<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs;

final class CreatePositionsDTO
{
    public function __construct(
        public readonly int $id,
        public readonly array $positions
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'positions' => $this->positions,
        ];
    }
}
