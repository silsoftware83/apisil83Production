<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Application\UseCases;

use Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs\CreatePositionsDTO;
use Src\Configuration\Company\DepartmentsAndPositions\Domain\Repositories\DepartmentsAndPositionsRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class CreatePositionsUseCase
{
    public function __construct(
        private DepartmentsAndPositionsRepositoryInterface $repository
    ) {}

    public function execute(CreatePositionsDTO $dto): void
    {
        DB::transaction(function () use ($dto) {
            Log::info('Adding positions to department', ['id' => $dto->id]);

            $this->repository->addPositions($dto->id, $dto->positions);

            Log::info('Positions added successfully', ['id' => $dto->id]);
        });
    }
}
