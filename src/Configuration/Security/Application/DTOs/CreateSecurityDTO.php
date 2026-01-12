<?php

namespace Src\Configuration\Security\Application\DTOs;

use Src\Configuration\Security\Domain\Exceptions\SecurityValidationException;

final class CreateSecurityDTO
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
        //     throw new SecurityValidationException('Name is required');
        // }
    }

    public function toArray(): array
    {
        return [
            // TODO: Map properties
        ];
    }
}
