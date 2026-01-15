<?php

namespace Src\Configuration\Security\Application\DTOs;

final class ShowPasswordDTO
{
    public function __construct(
        public readonly int $id,
    ) {}
}
