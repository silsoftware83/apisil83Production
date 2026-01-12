<?php

namespace Src\Employee\PersonalData\Application\DTOs;

use Src\Employee\PersonalData\Domain\Exceptions\PersonalDataValidationException;

final class UpdatePersonalDataDTO
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
            throw new PersonalDataValidationException('Invalid ID');
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
