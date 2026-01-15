<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Domain\Entities;

final class DepartmentsAndPositions
{
    public function __construct(
        private ?int $id = null,
        private ?string $nombre = null,
        private ?string $descripcion = null,
        private ?int $idJefeArea = null,
        private array $puestos = [],
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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function getIdJefeArea(): ?int
    {
        return $this->idJefeArea;
    }

    public function getPuestos(): array
    {
        return $this->puestos;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'id_jefe_area' => $this->idJefeArea,
            'puestos' => $this->puestos,
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt?->format('Y-m-d H:i:s'),
        ];
    }
    public function setNombre(?string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setDescripcion(?string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function setIdJefeArea(?int $idJefeArea): void
    {
        $this->idJefeArea = $idJefeArea;
    }
}
