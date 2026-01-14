<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Application\UseCases;

use Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs\CreateDepartmentsAndPositionsDTO;
use Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs\DepartmentsAndPositionsResponseDTO;
use Src\Configuration\Company\DepartmentsAndPositions\Domain\Entities\DepartmentsAndPositions;
use Src\Configuration\Company\DepartmentsAndPositions\Domain\Repositories\DepartmentsAndPositionsRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class CreateDepartmentsAndPositionsUseCase
{
    public function __construct(
        private DepartmentsAndPositionsRepositoryInterface $repository
    ) {}

    public function execute(CreateDepartmentsAndPositionsDTO $dto): DepartmentsAndPositionsResponseDTO
    {
        return DB::transaction(function () use ($dto) {
            Log::info('Creating DepartmentsAndPositions', $dto->toArray());

            $entity = new DepartmentsAndPositions(
                nombre: $dto->nombre,
                descripcion: $dto->descripcion,
                idJefeArea: $dto->id_jefe_area,
                puestos: $dto->puestos
            );

            $entity = $this->repository->save($entity);

            Log::info('DepartmentsAndPositions created successfully', ['id' => $entity->getId()]);

            return DepartmentsAndPositionsResponseDTO::fromEntity($entity);
        });
    }
}
