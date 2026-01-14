<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs;

use Src\Configuration\Company\DepartmentsAndPositions\Domain\Exceptions\DepartmentsAndPositionsValidationException;

final class CreateDepartmentsAndPositionsDTO
{
    public function __construct(
        public readonly string $nombre,
        public readonly ?string $descripcion,
        public readonly ?int $id_jefe_area,
        public readonly array $puestos = []
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if (empty($this->nombre)) {
            throw new DepartmentsAndPositionsValidationException('El nombre del departamento es requerido');
        }
    }

    public function toArray(): array
    {
        return [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'id_jefe_area' => $this->id_jefe_area,
            'puestos' => $this->puestos,
        ];
    }
}
