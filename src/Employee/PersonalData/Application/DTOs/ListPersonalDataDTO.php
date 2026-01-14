<?php

namespace Src\Employee\PersonalData\Application\DTOs;

final class ListPersonalDataDTO
{
    public function __construct(
        public readonly ?int $perPage = 15,
        public readonly ?int $active = 1,
        public readonly ?int $page = 1,
        public readonly ?string $sortBy = 'id',
        public readonly ?string $sortOrder = 'asc',
        // TODO: Add filter parameters
    ) {}
}
