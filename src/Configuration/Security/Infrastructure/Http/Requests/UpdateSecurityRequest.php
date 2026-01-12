<?php

namespace Src\Configuration\Security\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Configuration\Security\Application\DTOs\UpdateSecurityDTO;

final class UpdateSecurityRequest extends FormRequest
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

    public function toDTO(): UpdateSecurityDTO
    {
        return new UpdateSecurityDTO(
            $this->route('id'),
            // TODO: Map validated request data to DTO
        );
    }
}
