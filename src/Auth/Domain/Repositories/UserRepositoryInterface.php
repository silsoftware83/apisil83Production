<?php

namespace Src\Auth\Domain\Repositories;

use Src\Auth\Domain\Entities\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;
    public function findByEmailWithPersona(string $email): ?User;
    public function findById(int $id): ?User;
    public function save(User $user): User;
    public function exists(string $email): bool;
    public function getModulesListByUser(int $userId): Collection;
}
