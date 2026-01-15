<?php

namespace Src\Configuration\Security\Domain\Events;

final class UserCreated
{
    public function __construct(
        public readonly string $email,
        public readonly string $temporaryPassword
    ) {}
}
