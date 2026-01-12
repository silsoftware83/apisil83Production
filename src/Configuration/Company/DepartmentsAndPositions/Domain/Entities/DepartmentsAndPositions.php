<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Domain\Entities;

final class DepartmentsAndPositions
{
    public function __construct(
        private ?int $id = null,
        // TODO: Add domain properties
        private ?\DateTimeImmutable $createdAt = null,
        private ?\DateTimeImmutable $updatedAt = null,
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    // TODO: Add getters and setters for domain properties

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt?->format('Y-m-d H:i:s'),
            // TODO: Add other properties
        ];
    }
}
