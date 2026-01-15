<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Application\UseCases;

use Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs\UpdatePositionDTO;
use Src\Configuration\Company\DepartmentsAndPositions\Domain\Repositories\DepartmentsAndPositionsRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class UpdatePositionUseCase
{
    public function __construct(
        private DepartmentsAndPositionsRepositoryInterface $repository
    ) {}

    public function execute(UpdatePositionDTO $dto): void
    {
        DB::transaction(function () use ($dto) {
            Log::info('Updating position', ['id' => $dto->id]);

            $this->repository->updatePosition($dto->id, $dto->toArray());

            Log::info('Position updated successfully', ['id' => $dto->id]);
        });
    }
}
