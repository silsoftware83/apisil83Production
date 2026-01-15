<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs\UpdatePositionDTO;

final class UpdatePositionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'nullable|string',
            'level' => 'sometimes|required|string|in:junior,mid,senior',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del puesto es requerido',
            'level.in' => 'El nivel del puesto debe ser junior, mid o senior',
        ];
    }

    public function toDTO(): UpdatePositionDTO
    {
        return new UpdatePositionDTO(
            id: (int) $this->route('id'),
            nombre: $this->validated('nombre'),
            descripcion: $this->validated('descripcion'),
            level: $this->validated('level')
        );
    }
}
