<?php

namespace Src\Auth\Application\DTOs;

use Illuminate\Support\Collection;

final class AuthResponseDTO
{
    public function __construct(
        public readonly UserResponseDTO $user,
        public readonly string $access_token,
        public readonly string $token_type = 'Bearer',
        public readonly Collection $modules,
    ) {}

    public function toArray(): array
    {
        return [
            'user' => $this->user->toArray(),
            'access_token' => $this->access_token,
            'token_type' => $this->token_type,
            'modules' => $this->modules->toArray(),
        ];
    }
}
