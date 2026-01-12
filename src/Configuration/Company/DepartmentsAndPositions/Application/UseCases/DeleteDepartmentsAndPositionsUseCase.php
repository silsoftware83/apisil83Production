<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Application\UseCases;

use Src\Configuration\Company\DepartmentsAndPositions\Domain\Repositories\DepartmentsAndPositionsRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class DeleteDepartmentsAndPositionsUseCase
{
    public function __construct(
        private DepartmentsAndPositionsRepositoryInterface $repository
    ) {}

    public function execute(int $id): void
    {
        DB::transaction(function () use ($id) {
            Log::info('Deleting DepartmentsAndPositions', ['id' => $id]);

            $entity = $this->repository->find($id);
            $this->repository->delete($entity);

            Log::info('DepartmentsAndPositions deleted successfully', ['id' => $id]);
        });
    }
}
