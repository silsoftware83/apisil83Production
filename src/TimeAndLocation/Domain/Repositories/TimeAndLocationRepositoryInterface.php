<?php

namespace Src\TimeAndLocation\Domain\Repositories;

use Src\TimeAndLocation\Domain\Entities\TimeAndLocation;

interface TimeAndLocationRepositoryInterface
{
    public function save(TimeAndLocation $entity): TimeAndLocation;
    public function find(int $id): TimeAndLocation;
    public function delete(TimeAndLocation $entity): void;
    public function all(): array;
    public function recordsByUserToday(int $userId): array;
    public function exists(int $id): bool;
}
