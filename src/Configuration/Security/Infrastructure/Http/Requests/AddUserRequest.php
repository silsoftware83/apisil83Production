<?php

namespace Src\Configuration\Security\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Configuration\Security\Application\DTOs\AddUserDTO;

final class AddUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => 'required',
        ];
    }

    public function toDTO(): AddUserDTO
    {
        return new AddUserDTO(
            employee_id: (int) $this->input('employee_id')
        );
    }
}
