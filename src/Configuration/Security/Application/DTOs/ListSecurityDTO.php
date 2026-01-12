<?php

namespace Src\Configuration\Security\Application\DTOs;

final class ListSecurityDTO
{
    public function __construct(
        public readonly ?int $page = 1,
        public readonly ?int $perPage = 15,
        public readonly ?string $sortBy = 'id',
        public readonly ?string $sortOrder = 'asc',
        // TODO: Add filter parameters
    ) {}
}
