<?php

namespace Src\Configuration\Security\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Configuration\Security\Application\DTOs\GetPermisionsDTO;

final class GetPermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required'
        ];
    }

    public function toDTO(): GetPermisionsDTO
    {
        return new GetPermisionsDTO(
            id: (int) $this->get('id')
        );
    }
}
