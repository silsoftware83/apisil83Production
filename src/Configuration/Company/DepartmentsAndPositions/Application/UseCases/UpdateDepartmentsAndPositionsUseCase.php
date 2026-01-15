<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Application\UseCases;

use Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs\UpdateDepartmentsAndPositionsDTO;
use Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs\DepartmentsAndPositionsResponseDTO;
use Src\Configuration\Company\DepartmentsAndPositions\Domain\Repositories\DepartmentsAndPositionsRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class UpdateDepartmentsAndPositionsUseCase
{
    public function __construct(
        private DepartmentsAndPositionsRepositoryInterface $repository
    ) {}

    public function execute(UpdateDepartmentsAndPositionsDTO $dto): DepartmentsAndPositionsResponseDTO
    {
        return DB::transaction(function () use ($dto) {
            Log::info('Updating DepartmentsAndPositions', ['id' => $dto->id]);

            $entity = $this->repository->find($dto->id);

            if ($dto->nombre !== null) {
                $entity->setNombre($dto->nombre);
            }
            if ($dto->descripcion !== null) {
                $entity->setDescripcion($dto->descripcion);
            }
            if ($dto->id_jefe_area !== null) {
                $entity->setIdJefeArea($dto->id_jefe_area);
            }

            $entity = $this->repository->save($entity);

            Log::info('DepartmentsAndPositions updated successfully', ['id' => $entity->getId()]);

            return DepartmentsAndPositionsResponseDTO::fromEntity($entity);
        });
    }
}
