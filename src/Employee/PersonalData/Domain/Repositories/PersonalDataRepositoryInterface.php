<?php

namespace Src\Employee\PersonalData\Domain\Repositories;

use Src\Employee\PersonalData\Domain\Entities\PersonalData;

interface PersonalDataRepositoryInterface
{
    public function save(PersonalData $entity): PersonalData;
    public function find(int $id): PersonalData;
    public function delete(PersonalData $entity): void;
    /**
     * @return array{data: PersonalData[], current_page: int, last_page: int, per_page: int, total: int, ...}
     */
    public function all(int $perPage, int $active, int $page = 1): array;
    public function exists(int $id): bool;
}
