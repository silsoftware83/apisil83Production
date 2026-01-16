<?php

namespace Src\TimeAndLocation\Application\DTOs;

final class ListTimeAndLocationDTO
{
    public function __construct(
        public readonly ?int $id = null,
        // TODO: Add filter parameters
    ) {}
}
