<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs\CreateDepartmentsAndPositionsDTO;

final class CreateDepartmentsAndPositionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'manager' => 'nullable|integer',
            'puestos' => 'nullable|array',
            'puestos.*.nombre' => 'required|string|max:255',
            'puestos.*.descripcion' => 'nullable|string',
            'puestos.*.level' => 'nullable|string|in:easy,mid,senior',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del departamento es requerido',
            'puestos.*.nombre.required' => 'El nombre del puesto es requerido',
        ];
    }

    public function toDTO(): CreateDepartmentsAndPositionsDTO
    {
        return new CreateDepartmentsAndPositionsDTO(
            nombre: $this->validated('nombre'),
            descripcion: $this->validated('descripcion'),
            id_jefe_area: $this->validated('manager'),
            puestos: $this->validated('puestos') ?? []
        );
    }
}
