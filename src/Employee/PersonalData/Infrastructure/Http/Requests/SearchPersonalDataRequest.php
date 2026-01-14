<?php

namespace Src\Employee\PersonalData\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Employee\PersonalData\Application\DTOs\SearchPersonalDataDTO;

class SearchPersonalDataRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'search' => 'required|string',
        ];
    }

    public function toDTO()
    {
        return SearchPersonalDataDTO::fromRequest($this);
    }
}
