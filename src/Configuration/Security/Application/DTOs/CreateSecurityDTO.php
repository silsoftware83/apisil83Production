<?php

namespace Src\Configuration\Security\Application\DTOs;

final class CreateSecurityDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly array $permissions
    ) {}
}
