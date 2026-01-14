<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Persistence\Repositories;

use Src\Configuration\Company\DepartmentsAndPositions\Domain\Entities\DepartmentsAndPositions;
use Src\Configuration\Company\DepartmentsAndPositions\Domain\Repositories\DepartmentsAndPositionsRepositoryInterface;
use Src\Configuration\Company\DepartmentsAndPositions\Domain\Exceptions\DepartmentsAndPositionsNotFoundException;
use Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Persistence\Eloquent\Departamento;
use Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Persistence\Eloquent\DepartmentsAndPositionsModel;

final class EloquentDepartmentsAndPositionsRepository implements DepartmentsAndPositionsRepositoryInterface
{
    public function save(DepartmentsAndPositions $entity): DepartmentsAndPositions
    {
        $model = $entity->getId()
            ? DepartmentsAndPositionsModel::findOrFail($entity->getId())
            : new DepartmentsAndPositionsModel();

        $data = $entity->toArray();
        unset($data['id'], $data['created_at'], $data['updated_at']);

        $model->fill($data);
        $model->save();

        $entity->setId($model->id);
        return $entity;
    }

    public function find(int $id): DepartmentsAndPositions
    {
        $model = DepartmentsAndPositionsModel::find($id);

        if (!$model) {
            throw new DepartmentsAndPositionsNotFoundException($id);
        }

        return $this->mapToEntity($model);
    }

    public function delete(DepartmentsAndPositions $entity): void
    {
        if (!$entity->getId()) {
            throw new DepartmentsAndPositionsNotFoundException(0);
        }

        DepartmentsAndPositionsModel::destroy($entity->getId());
    }

    public function all(): array
    {
        return DepartmentsAndPositionsModel::all()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();
    }

    public function exists(int $id): bool
    {
        return DepartmentsAndPositionsModel::where('id', $id)->exists();
    }

    private function mapToEntity(DepartmentsAndPositionsModel $model): DepartmentsAndPositions
    {
        return new DepartmentsAndPositions(
            id: $model->id,
            // TODO: Map other properties
            createdAt: $model->created_at ? new \DateTimeImmutable($model->created_at) : null,
            updatedAt: $model->updated_at ? new \DateTimeImmutable($model->updated_at) : null,
        );
    }

    public function allDepartmentsWhithPositions(): array
    {
        $model = Departamento::select('id', 'nombre', 'descripcion', 'id_jefe_area')->with('puestos')->get();
        return $model->toArray();
    }
}
