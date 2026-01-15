<?php

namespace Src\Configuration\Security\Application\UseCases;

use Src\Configuration\Security\Application\DTOs\ListSecurityDTO;
use Src\Configuration\Security\Application\DTOs\SecurityResponseDTO;
use Src\Configuration\Security\Domain\Repositories\SecurityRepositoryInterface;

final class ListSecurityUseCase
{
    public function __construct(
        private SecurityRepositoryInterface $repository
    ) {}

    public function execute(ListSecurityDTO $dto): array
    {
        $entities = $this->repository->Personal();

        return array_map(
            fn($entity) => SecurityResponseDTO::fromEntity($entity),
            $entities
        );
    }
}
