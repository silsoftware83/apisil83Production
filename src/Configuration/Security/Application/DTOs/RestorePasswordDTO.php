<?php

namespace Src\Configuration\Security\Application\DTOs;

final class RestorePasswordDTO
{
    public function __construct(
        public readonly int $id,
        public readonly int $updatedBy,
    ) {}
}
