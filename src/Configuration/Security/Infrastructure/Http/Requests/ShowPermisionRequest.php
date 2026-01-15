<?php

namespace Src\Configuration\Security\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Configuration\Security\Application\DTOs\ShowPasswordDTO;

final class ShowPermisionRequest extends FormRequest
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

    public function toDTO(): ShowPasswordDTO
    {
        return new ShowPasswordDTO(
            id: (int) $this->get('id')
        );
    }
}
