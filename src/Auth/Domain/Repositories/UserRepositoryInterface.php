<?php

namespace Src\Auth\Domain\Repositories;

use Src\Auth\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;
    public function findByEmailWithPersona(string $email): ?User;
    public function findById(int $id): ?User;
    public function save(User $user): User;
    public function exists(string $email): bool;
}
