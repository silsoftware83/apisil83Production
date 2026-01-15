<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs;

final class UpdatePositionDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $nombre = null,
        public readonly ?string $descripcion = null,
        public readonly ?string $level = null
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'level' => $this->level,
        ];
    }
}
