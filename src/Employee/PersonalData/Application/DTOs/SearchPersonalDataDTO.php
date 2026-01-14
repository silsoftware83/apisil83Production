<?php

namespace Src\Employee\PersonalData\Application\DTOs;

use Src\Employee\PersonalData\Infrastructure\Http\Requests\SearchPersonalDataRequest;

class SearchPersonalDataDTO
{
    public function __construct(
        public string $search,
    ) {}

    public static function fromRequest(SearchPersonalDataRequest $request): self
    {
        return new self(
            search: $request->input('search'),
        );
    }
}
