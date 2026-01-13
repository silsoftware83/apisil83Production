<?php

namespace Src\Employee\Directory\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Employee\Directory\Application\DTOs\CreateDirectoryDTO;

final class CreateDirectoryRequest extends FormRequest
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

    public function toDTO(): CreateDirectoryDTO
    {
        return new CreateDirectoryDTO(
            // TODO: Map validated request data to DTO
        );
    }
}
