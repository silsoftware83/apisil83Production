<?php

namespace Src\Configuration\Security\Application\UseCases;

use Src\Configuration\Security\Application\DTOs\ShowPasswordDTO;
use Src\Configuration\Security\Domain\Repositories\SecurityRepositoryInterface;

final class ShowPasswordUseCase
{
    public function __construct(
        private SecurityRepositoryInterface $repository
    ) {}

    public function execute(ShowPasswordDTO $dto): ?object
    {
        return $this->repository->showPassword($dto->id);
    }
}
