<?php

namespace Src\Configuration\Security\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Configuration\Security\Application\DTOs\RestorePasswordDTO;

final class RestorePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required',
            'updatedBy' => 'required'
        ];
    }

    public function toDTO(): RestorePasswordDTO
    {
        return new RestorePasswordDTO(
            id: (int) $this->get('id'),
            updatedBy: (int) $this->get('updatedBy')
        );
    }
}
