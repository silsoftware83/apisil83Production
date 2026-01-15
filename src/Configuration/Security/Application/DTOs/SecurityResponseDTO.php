<?php

namespace Src\Configuration\Security\Application\DTOs;

final class SecurityResponseDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $name = null,
        public readonly ?string $email = null,
        public readonly ?string $password = null,
        public readonly ?string $last_seen = null,
        public readonly ?int $id_personal = null,
        public readonly ?bool $active = null,
        public readonly ?string $passwordLetter = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {}

    public static function fromEntity(\Src\Configuration\Security\Domain\Entities\Security $entity): self
    {
        return new self(
            id: $entity->getId(),
            name: $entity->getName(),
            email: $entity->getEmail(),
            password: $entity->getPassword(),
            last_seen: $entity->getLastSeen(),
            id_personal: $entity->getIdPersonal(),
            active: $entity->getActive(),
            passwordLetter: $entity->getPasswordLetter(),
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
            'password' => $this->password,
            'last_seen' => $this->last_seen,
            'id_personal' => $this->id_personal,
            'active' => $this->active,
            'passwordLetter' => $this->passwordLetter,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            // TODO: Add other properties
        ];
    }
}
