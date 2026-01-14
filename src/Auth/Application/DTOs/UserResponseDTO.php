<?php

namespace Src\Auth\Application\DTOs;

use Src\Employee\PersonalData\PersonalInformation\Domain\Entities\PersonalData;

final class UserResponseDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $passwordLetter = null,
        public readonly ?PersonalData $persona = null,
    ) {}

    public static function fromEntity(\Src\Auth\Domain\Entities\User $entity): self
    {
        return new self(
            id: $entity->getId(),
            name: $entity->getName(),
            email: $entity->getEmail(),
            passwordLetter: $entity->getPasswordLetter(),
            persona: $entity->getPersona(),

        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'passwordLetter' => $this->passwordLetter,
            'persona' => $this->persona->toArrayLogin(),
        ];
    }
}
