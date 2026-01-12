<?php

namespace Src\Auth\Application\DTOs;

use Src\Auth\Domain\Exceptions\AuthenticationException;

final class LoginDTO
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if (empty($this->email)) {
            throw new AuthenticationException('Email is required');
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new AuthenticationException('Invalid email format');
        }

        if (empty($this->password)) {
            throw new AuthenticationException('Password is required');
        }

        if (strlen($this->password) < 6) {
            throw new AuthenticationException('Password must be at least 6 characters');
        }
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
