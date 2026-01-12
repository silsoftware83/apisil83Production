<?php

namespace Src\Configuration\Security\Application\UseCases;

use Src\Configuration\Security\Domain\Repositories\SecurityRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class DeleteSecurityUseCase
{
    public function __construct(
        private SecurityRepositoryInterface $repository
    ) {}

    public function execute(int $id): void
    {
        DB::transaction(function () use ($id) {
            Log::info('Deleting Security', ['id' => $id]);

            $entity = $this->repository->find($id);
            $this->repository->delete($entity);

            Log::info('Security deleted successfully', ['id' => $id]);
        });
    }
}
