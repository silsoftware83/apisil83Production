<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs\UpdateDepartmentsAndPositionsDTO;

final class UpdateDepartmentsAndPositionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // TODO: Add validation rules
            // 'name' => 'sometimes|required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            // TODO: Add custom error messages
        ];
    }

    public function toDTO(): UpdateDepartmentsAndPositionsDTO
    {
        return new UpdateDepartmentsAndPositionsDTO(
            $this->route('id'),
            // TODO: Map validated request data to DTO
        );
    }
}
