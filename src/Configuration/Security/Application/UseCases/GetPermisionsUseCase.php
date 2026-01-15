<?php

namespace Src\Configuration\Security\Application\UseCases;

use Src\Configuration\Security\Application\DTOs\GetPermisionsDTO;
use Src\Configuration\Security\Domain\Repositories\SecurityRepositoryInterface;

final class GetPermisionsUseCase
{
    public function __construct(
        private SecurityRepositoryInterface $repository
    ) {}

    public function execute(GetPermisionsDTO $dto): array
    {
        return $this->repository->getAllModulesWithFullTreeByUser($dto->id);
    }
}
