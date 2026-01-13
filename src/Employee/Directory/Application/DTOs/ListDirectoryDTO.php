<?php

namespace Src\Employee\Directory\Application\DTOs;

final class ListDirectoryDTO
{
    public function __construct(
        public readonly ?int $active = 1,
        public readonly ?string $sortBy = 'id',
        public readonly ?string $sortOrder = 'asc',
        // TODO: Add filter parameters
    ) {}
}
