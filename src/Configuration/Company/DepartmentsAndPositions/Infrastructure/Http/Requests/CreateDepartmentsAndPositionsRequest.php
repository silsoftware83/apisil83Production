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
            // TODO: Add validation rules
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:table_name',
        ];
    }

    public function messages(): array
    {
        return [
            // TODO: Add custom error messages
        ];
    }

    public function toDTO(): CreateDepartmentsAndPositionsDTO
    {
        return new CreateDepartmentsAndPositionsDTO(
            // TODO: Map validated request data to DTO
        );
    }
}
