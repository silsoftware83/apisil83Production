<?php

namespace Src\Configuration\Security\Domain\Repositories;

use Src\Configuration\Security\Domain\Entities\Security;

interface SecurityRepositoryInterface
{
    public function save(Security $entity): Security;
    public function find(int $id): Security;
    public function delete(Security $entity): void;
    public function all(): array;
    public function exists(int $id): bool;
}
