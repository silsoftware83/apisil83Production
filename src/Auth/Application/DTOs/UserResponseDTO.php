<?php

namespace Src\Auth\Application\DTOs;

use Src\Employee\PersonalData\Domain\Entities\PersonalData;

final class UserResponseDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly ?PersonalData $persona = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {}

    public static function fromEntity(\Src\Auth\Domain\Entities\User $entity): self
    {
        return new self(
            id: $entity->getId(),
            name: $entity->getName(),
            email: $entity->getEmail(),
            persona: $entity->getPersona(),
            createdAt: $entity->getCreatedAt()?->format('Y-m-d H:i:s'),
            updatedAt: $entity->getUpdatedAt()?->format('Y-m-d H:i:s'),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'persona' => $this->persona,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }
}
