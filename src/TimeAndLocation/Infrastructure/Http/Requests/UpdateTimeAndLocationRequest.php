<?php

namespace Src\TimeAndLocation\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\TimeAndLocation\Application\DTOs\UpdateTimeAndLocationDTO;

final class UpdateTimeAndLocationRequest extends FormRequest
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

    public function toDTO(): UpdateTimeAndLocationDTO
    {
        return new UpdateTimeAndLocationDTO(
            $this->route('id'),
            // TODO: Map validated request data to DTO
        );
    }
}
