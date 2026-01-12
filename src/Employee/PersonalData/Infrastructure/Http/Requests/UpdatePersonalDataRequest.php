<?php

namespace Src\Employee\PersonalData\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Employee\PersonalData\Application\DTOs\UpdatePersonalDataDTO;

final class UpdatePersonalDataRequest extends FormRequest
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

    public function toDTO(): UpdatePersonalDataDTO
    {
        return new UpdatePersonalDataDTO(
            $this->route('id'),
            // TODO: Map validated request data to DTO
        );
    }
}
