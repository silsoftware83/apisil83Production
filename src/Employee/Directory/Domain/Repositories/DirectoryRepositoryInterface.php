<?php

namespace Src\Employee\Directory\Domain\Repositories;

use Src\Employee\Directory\Domain\Entities\Directory;

interface DirectoryRepositoryInterface
{
    public function save(Directory $entity): Directory;
    public function find(int $id): Directory;
    public function delete(Directory $entity): void;
    public function all(): array;
    public function exists(int $id): bool;
}
