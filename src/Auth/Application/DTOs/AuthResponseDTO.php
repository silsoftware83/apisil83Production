<?php

namespace Src\Auth\Application\DTOs;

final class AuthResponseDTO
{
    public function __construct(
        public readonly UserResponseDTO $user,
        public readonly string $token,
        public readonly string $tokenType = 'Bearer',
    ) {}

    public function toArray(): array
    {
        return [
            'user' => $this->user->toArray(),
            'token' => $this->token,
            'token_type' => $this->tokenType,
        ];
    }
}
