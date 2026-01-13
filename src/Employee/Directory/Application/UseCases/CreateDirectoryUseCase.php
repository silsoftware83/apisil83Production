<?php

namespace Src\Employee\Directory\Application\UseCases;

use Src\Employee\Directory\Application\DTOs\CreateDirectoryDTO;
use Src\Employee\Directory\Application\DTOs\DirectoryResponseDTO;
use Src\Employee\Directory\Domain\Entities\Directory;
use Src\Employee\Directory\Domain\Repositories\DirectoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class CreateDirectoryUseCase
{
    public function __construct(
        private DirectoryRepositoryInterface $repository
    ) {}

    public function execute(CreateDirectoryDTO $dto): DirectoryResponseDTO
    {
        return DB::transaction(function () use ($dto) {
            Log::info('Creating Directory', $dto->toArray());

            $entity = new Directory(
                // TODO: Map DTO to Entity
            );

            $entity = $this->repository->save($entity);

            Log::info('Directory created successfully', ['id' => $entity->getId()]);

            return DirectoryResponseDTO::fromEntity($entity);
        });
    }
}
