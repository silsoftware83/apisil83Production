<?php

namespace Src\Configuration\Security\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Configuration\Security\Application\DTOs\CreateSecurityDTO;

final class CreateSecurityRequest extends FormRequest
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

    public function toDTO(): CreateSecurityDTO
    {
        return new CreateSecurityDTO(
            // TODO: Map validated request data to DTO
        );
    }
}
