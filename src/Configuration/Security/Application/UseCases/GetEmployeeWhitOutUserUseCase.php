<?php

namespace Src\Configuration\Security\Application\UseCases;

use Src\Configuration\Security\Application\DTOs\GetEmployeeWhitOutUserDTO;
use Src\Configuration\Security\Domain\Repositories\SecurityRepositoryInterface;

final class GetEmployeeWhitOutUserUseCase
{
    public function __construct(
        private SecurityRepositoryInterface $repository
    ) {}

    public function execute(GetEmployeeWhitOutUserDTO $dto): array
    {
        return $this->repository->getEmployeeWhitOutUser();
    }
}
