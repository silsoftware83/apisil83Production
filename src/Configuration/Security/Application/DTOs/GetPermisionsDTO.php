<?php

namespace Src\Configuration\Security\Application\DTOs;

final class GetPermisionsDTO
{
    public function __construct(
        public readonly int $id
    ) {}
}
