<?php

namespace Src\Employee\PersonalData\Domain\Repositories;

use Src\Employee\PersonalData\Domain\Entities\PersonalData;

interface PersonalDataRepositoryInterface
{
    public function save(PersonalData $entity): PersonalData;
    public function find(int $id): PersonalData;
    public function delete(PersonalData $entity): void;
    public function all(): array;
    public function exists(int $id): bool;
}
