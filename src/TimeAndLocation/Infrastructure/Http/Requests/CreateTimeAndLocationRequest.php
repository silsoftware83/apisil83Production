<?php

namespace Src\TimeAndLocation\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\TimeAndLocation\Application\DTOs\CreateTimeAndLocationDTO;

final class CreateTimeAndLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'latitud' => 'required',
            'longitud' => 'required',
            'id_user' => 'required',
            'time' => 'required',
            'ip' => 'required',
            'cancheckoutnotary' => 'required',
            'isweb' => 'required',
            'type' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'latitud.required' => 'La latitud es obligatoria',
            'longitud.required' => 'La longitud es obligatoria',
            'id_user.required' => 'El id_user es obligatorio',
            'time.required' => 'El time es obligatorio',
            'ip.required' => 'La ip es obligatoria',
            'cancheckoutnotary.required' => 'El cancheckoutnotary es obligatorio',
            'isweb.required' => 'El isweb es obligatorio',
            'type.required' => 'El type es obligatorio',
        ];
    }

    public function toDTO(): CreateTimeAndLocationDTO
    {
        return new CreateTimeAndLocationDTO(
            latitud: $this->validated('latitud'),
            longitud: $this->validated('longitud'),
            id_user: $this->validated('id_user'),
            time: $this->validated('time'),
            ip: $this->validated('ip'),
            cancheckoutnotary: $this->validated('cancheckoutnotary'),
            isweb: $this->validated('isweb'),
            comments: $this->validated('comments') ?? '',
            type: $this->validated('type') ?? '1',
        );
    }
}
