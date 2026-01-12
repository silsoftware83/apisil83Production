<?php

namespace Src\Employee\PersonalData\Application\DTOs;

use Src\Employee\PersonalData\Domain\Exceptions\PersonalDataValidationException;

final class CreatePersonalDataDTO
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
        //     throw new PersonalDataValidationException('Name is required');
        // }
    }

    public function toArray(): array
    {
        return [
            // TODO: Map properties
        ];
    }
}
