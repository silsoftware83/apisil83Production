<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs\CreatePositionsDTO;

use Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Persistence\Eloquent\DepartmentsAndPositionsModel;

final class CreatePositionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'positions' => 'required|array',
            'positions.*.nombre' => 'required|string|max:255',
            'positions.*.descripcion' => 'nullable|string',
            'positions.*.level' => 'nullable|string|in:junior,mid,senior',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'El ID del departamento es requerido',
            'id.exists' => 'El departamento no existe',
            'positions.required' => 'La lista de puestos es requerida',
            'positions.array' => 'El formato de puestos es inválido',
            'positions.*.nombre.required' => 'El nombre del puesto es requerido',
            'positions.*.level.in' => 'El nivel del puesto debe ser junior, mid o senior',
        ];
    }

    public function toDTO(): CreatePositionsDTO
    {
        return new CreatePositionsDTO(
            id: $this->validated('id'),
            positions: $this->validated('positions')
        );
    }
}
