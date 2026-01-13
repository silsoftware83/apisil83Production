<?php

namespace Src\Employee\Directory\Application\UseCases;

use Src\Employee\Directory\Application\DTOs\ListDirectoryDTO;
use Src\Employee\Directory\Application\DTOs\DirectoryResponseDTO;
use Src\Employee\Directory\Domain\Repositories\DirectoryRepositoryInterface;

final class ListDirectoryUseCase
{
    public function __construct(
        private DirectoryRepositoryInterface $repository
    ) {}

    public function execute(ListDirectoryDTO $dto): array
    {
        $entities = $this->repository->all();

        return array_map(
            fn($entity) => DirectoryResponseDTO::fromEntity($entity),
            $entities
        );
    }
}
