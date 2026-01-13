<?php

namespace Src\Employee\Directory\Application\UseCases;

use Src\Employee\Directory\Domain\Repositories\DirectoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class DeleteDirectoryUseCase
{
    public function __construct(
        private DirectoryRepositoryInterface $repository
    ) {}

    public function execute(int $id): void
    {
        DB::transaction(function () use ($id) {
            Log::info('Deleting Directory', ['id' => $id]);

            $entity = $this->repository->find($id);
            $this->repository->delete($entity);

            Log::info('Directory deleted successfully', ['id' => $id]);
        });
    }
}
