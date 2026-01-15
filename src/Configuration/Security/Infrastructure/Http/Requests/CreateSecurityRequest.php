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
            'id' => 'required|integer',
            'permissions' => 'required|array',
        ];
    }

    public function toDTO(): CreateSecurityDTO
    {
        return new CreateSecurityDTO(
            userId: (int) $this->query('id'),
            permissions: $this->input('permissions')
        );
    }
}
