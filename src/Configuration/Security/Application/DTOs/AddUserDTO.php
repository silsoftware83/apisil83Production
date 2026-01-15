<?php

namespace Src\Configuration\Security\Application\DTOs;

final class AddUserDTO
{
    public function __construct(
        public readonly int $employee_id,
    ) {}
}
