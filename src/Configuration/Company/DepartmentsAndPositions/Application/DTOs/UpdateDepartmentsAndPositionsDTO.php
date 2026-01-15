<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs;

use Src\Configuration\Company\DepartmentsAndPositions\Domain\Exceptions\DepartmentsAndPositionsValidationException;

final class UpdateDepartmentsAndPositionsDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $nombre = null,
        public readonly ?string $descripcion = null,
        public readonly ?int $id_jefe_area = null,
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if ($this->id <= 0) {
            throw new DepartmentsAndPositionsValidationException('Invalid ID');
        }
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'id_jefe_area' => $this->id_jefe_area,
        ];
    }
}
