<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs;

final class DepartmentsAndPositionsResponseDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $nombre = null,
        public readonly ?string $descripcion = null,
        public readonly ?int $id_jefe_area = null,
        public readonly array $puestos = [],
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {}

    public static function fromEntity(\Src\Configuration\Company\DepartmentsAndPositions\Domain\Entities\DepartmentsAndPositions $entity): self
    {
        return new self(
            id: $entity->getId(),
            nombre: $entity->getNombre(),
            descripcion: $entity->getDescripcion(),
            id_jefe_area: $entity->getIdJefeArea(),
            puestos: $entity->getPuestos(),
            createdAt: $entity->getCreatedAt()?->format('Y-m-d H:i:s'),
            updatedAt: $entity->getUpdatedAt()?->format('Y-m-d H:i:s'),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'id_jefe_area' => $this->id_jefe_area,
            'puestos' => $this->puestos,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }
}
