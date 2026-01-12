<?php

namespace Src\Auth\Application\DTOs;

use Illuminate\Support\Collection;

final class AuthResponseDTO
{
    public function __construct(
        public readonly UserResponseDTO $user,
        public readonly string $token,
        public readonly string $tokenType = 'Bearer',
        public readonly Collection $modules,
    ) {}

    public function toArray(): array
    {
        return [
            'user' => $this->user->toArray(),
            'token' => $this->token,
            'token_type' => $this->tokenType,
            'modules' => $this->modules->toArray(),
        ];
    }
}
