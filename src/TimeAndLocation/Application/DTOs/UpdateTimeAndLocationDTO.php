<?php

namespace Src\TimeAndLocation\Application\DTOs;

use Src\TimeAndLocation\Domain\Exceptions\TimeAndLocationValidationException;

final class UpdateTimeAndLocationDTO
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
            throw new TimeAndLocationValidationException('Invalid ID');
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
