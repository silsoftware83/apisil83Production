<?php

namespace Src\Employee\PersonalData\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Employee\PersonalData\Application\DTOs\CreatePersonalDataDTO;

final class CreatePersonalDataRequest extends FormRequest
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

    public function toDTO(): CreatePersonalDataDTO
    {
        return new CreatePersonalDataDTO(
            // TODO: Map validated request data to DTO
        );
    }
}
