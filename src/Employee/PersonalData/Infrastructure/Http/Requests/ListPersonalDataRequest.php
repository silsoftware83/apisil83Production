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
            'page' => 'sometimes|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'per_page.required' => 'Items per page is required',
            'active.required' => 'Active status filter is required',
        ];
    }

    public function toDTO(): ListPersonalDataDTO
    {
        return new ListPersonalDataDTO(
            perPage: (int) $this->input('per_page'),
            active: (int) $this->input('active'),
            page: (int) $this->input('page', 1)
        );
    }
}
