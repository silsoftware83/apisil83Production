<?php

namespace Src\Configuration\Security\Domain\Repositories;

use Src\Configuration\Security\Domain\Entities\Security;

interface SecurityRepositoryInterface
{
    public function save(Security $entity): Security;
    public function find(int $id): Security;
    public function delete(int $id): void;
    public function all(): array;
    public function exists(int $id): bool;
    public function Personal(): array;
    public function getInformationEmployee(int $id): ?object;
    public function createUser(array $data): object;
    public function getAllModulesWithFullTreeByUser(int $userId): array;
    public function deletePrevius(int $userId): void;
    public function createAccess(array $data): void;
    public function showPassword(int $id): ?object;
    public function getEmployeeWhitOutUser(): array;
}
