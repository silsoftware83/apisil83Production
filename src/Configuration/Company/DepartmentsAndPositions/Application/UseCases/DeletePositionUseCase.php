<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Application\UseCases;

use Src\Configuration\Company\DepartmentsAndPositions\Domain\Repositories\DepartmentsAndPositionsRepositoryInterface;
use Illuminate\Support\Facades\Log;

final class DeletePositionUseCase
{
    public function __construct(
        private DepartmentsAndPositionsRepositoryInterface $repository
    ) {}

    public function execute(int $id): void
    {
        Log::info('Deleting position', ['id' => $id]);
        $this->repository->deletePosition($id);
        Log::info('Position deleted successfully', ['id' => $id]);
    }
}
