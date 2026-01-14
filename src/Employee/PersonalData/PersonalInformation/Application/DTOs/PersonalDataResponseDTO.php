<?php

namespace Src\Employee\PersonalData\PersonalInformation\Application\DTOs;

final class PersonalDataResponseDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $name = null,
        public readonly ?string $lastName = null,
        public readonly ?string $email = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {}

    public static function fromEntity(\Src\Employee\PersonalData\PersonalInformation\Domain\Entities\PersonalData $entity): self
    {
        return new self(
            id: $entity->getId(),
            name: $entity->getName(),
            lastName: $entity->getLastName(),
            email: $entity->getEmail(),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastName' => $this->lastName,
            'email' => $this->email,

        ];
    }
}
