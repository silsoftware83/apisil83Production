<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Domain\Repositories;

use Src\Configuration\Company\DepartmentsAndPositions\Domain\Entities\DepartmentsAndPositions;

interface DepartmentsAndPositionsRepositoryInterface
{
    public function save(DepartmentsAndPositions $entity): DepartmentsAndPositions;
    public function find(int $id): DepartmentsAndPositions;
    public function delete(DepartmentsAndPositions $entity): void;
    public function all(): array;
    public function exists(int $id): bool;
}
