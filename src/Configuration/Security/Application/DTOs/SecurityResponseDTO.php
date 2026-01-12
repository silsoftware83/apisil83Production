<?php

namespace Src\Configuration\Security\Application\DTOs;

final class SecurityResponseDTO
{
    public function __construct(
        public readonly int $id,
        // TODO: Add response properties
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {}

    public static function fromEntity(\Src\Configuration\Security\Domain\Entities\Security $entity): self
    {
        return new self(
            id: $entity->getId(),
            // TODO: Map entity properties
            createdAt: $entity->getCreatedAt()?->format('Y-m-d H:i:s'),
            updatedAt: $entity->getUpdatedAt()?->format('Y-m-d H:i:s'),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            // TODO: Add other properties
        ];
    }
}
