<?php

namespace Src\Employee\Directory\Application\DTOs;

use Src\Employee\Directory\Domain\Exceptions\DirectoryValidationException;

final class CreateDirectoryDTO
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
        //     throw new DirectoryValidationException('Name is required');
        // }
    }

    public function toArray(): array
    {
        return [
            // TODO: Map properties
        ];
    }
}
