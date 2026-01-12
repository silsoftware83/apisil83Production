<?php

namespace Src\Configuration\Security\Application\DTOs;

use Src\Configuration\Security\Domain\Exceptions\SecurityValidationException;

final class UpdateSecurityDTO
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
            throw new SecurityValidationException('Invalid ID');
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
