<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs;

final class ListDepartmentsAndPositionsDTO
{
    public function __construct(
        public readonly ?int $page = 1,
        public readonly ?int $perPage = 15,
        public readonly ?string $sortBy = 'id',
        public readonly ?string $sortOrder = 'asc',
        // TODO: Add filter parameters
    ) {}
}
