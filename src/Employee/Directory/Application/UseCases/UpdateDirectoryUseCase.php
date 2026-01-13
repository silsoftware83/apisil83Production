<?php

namespace Src\Employee\Directory\Application\UseCases;

use Src\Employee\Directory\Application\DTOs\UpdateDirectoryDTO;
use Src\Employee\Directory\Application\DTOs\DirectoryResponseDTO;
use Src\Employee\Directory\Domain\Repositories\DirectoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class UpdateDirectoryUseCase
{
    public function __construct(
        private DirectoryRepositoryInterface $repository
    ) {}

    public function execute(UpdateDirectoryDTO $dto): DirectoryResponseDTO
    {
        return DB::transaction(function () use ($dto) {
            Log::info('Updating Directory', ['id' => $dto->id]);

            $entity = $this->repository->find($dto->id);

            // TODO: Update entity properties from DTO

            $entity = $this->repository->save($entity);

            Log::info('Directory updated successfully', ['id' => $entity->getId()]);

            return DirectoryResponseDTO::fromEntity($entity);
        });
    }
}
