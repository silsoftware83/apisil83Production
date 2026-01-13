<?php

namespace Src\Employee\Directory\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Employee\Directory\Application\DTOs\UpdateDirectoryDTO;

final class UpdateDirectoryRequest extends FormRequest
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

    public function toDTO(): UpdateDirectoryDTO
    {
        return new UpdateDirectoryDTO(
            $this->route('id'),
            // TODO: Map validated request data to DTO
        );
    }
}
