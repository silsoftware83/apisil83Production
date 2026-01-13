<?php

namespace Src\Employee\PersonalData\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Employee\PersonalData\Application\DTOs\ListPersonalDataDTO;

final class ListPersonalDataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'per_page' => 'required|integer',
            'active' => 'required|integer',

        ];
    }

    public function messages(): array
    {
        return [
            // TODO: Add custom error messages
        ];
    }

    public function toDTO(): ListPersonalDataDTO
    {
        return new ListPersonalDataDTO(
            // TODO: Map validated request data to DTO
        );
    }
}
