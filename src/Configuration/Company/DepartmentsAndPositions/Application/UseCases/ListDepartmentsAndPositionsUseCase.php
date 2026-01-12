<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Application\UseCases;

use Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs\ListDepartmentsAndPositionsDTO;
use Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs\DepartmentsAndPositionsResponseDTO;
use Src\Configuration\Company\DepartmentsAndPositions\Domain\Repositories\DepartmentsAndPositionsRepositoryInterface;

final class ListDepartmentsAndPositionsUseCase
{
    public function __construct(
        private DepartmentsAndPositionsRepositoryInterface $repository
    ) {}

    public function execute(ListDepartmentsAndPositionsDTO $dto): array
    {
        $entities = $this->repository->all();

        return array_map(
            fn($entity) => DepartmentsAndPositionsResponseDTO::fromEntity($entity),
            $entities
        );
    }
}
