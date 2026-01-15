<?php

namespace Src\Configuration\Security\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Configuration\Security\Application\DTOs\GetEmployeeWhitOutUserDTO;

final class GetEmployeeWhitOutUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }

    public function toDTO(): GetEmployeeWhitOutUserDTO
    {
        return new GetEmployeeWhitOutUserDTO();
    }
}
