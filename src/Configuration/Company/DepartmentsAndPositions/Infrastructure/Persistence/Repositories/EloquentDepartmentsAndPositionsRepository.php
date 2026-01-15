<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Persistence\Repositories;

use Src\Configuration\Company\DepartmentsAndPositions\Domain\Entities\DepartmentsAndPositions;
use Src\Configuration\Company\DepartmentsAndPositions\Domain\Repositories\DepartmentsAndPositionsRepositoryInterface;
use Src\Configuration\Company\DepartmentsAndPositions\Domain\Exceptions\DepartmentsAndPositionsNotFoundException;
use Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Persistence\Eloquent\Departamento;
use Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Persistence\Eloquent\DepartmentsAndPositionsModel;
use Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Persistence\Eloquent\Puesto;

final class EloquentDepartmentsAndPositionsRepository implements DepartmentsAndPositionsRepositoryInterface
{
    public function save(DepartmentsAndPositions $entity): DepartmentsAndPositions
    {
        $model = $entity->getId()
            ? Departamento::findOrFail($entity->getId())
            : new Departamento();

        $model->nombre = $entity->getNombre();
        $model->descripcion = $entity->getDescripcion();
        $model->id_jefe_area = $entity->getIdJefeArea();
        $model->save();

        if (!empty($entity->getPuestos())) {
            foreach ($entity->getPuestos() as $puestoData) {
                $puesto = new Puesto();
                $puesto->nombre = $puestoData['nombre'] ?? '';
                $puesto->descripcion = $puestoData['descripcion'] ?? '';
                $puesto->level = $puestoData['level'] ?? 'mid';
                $puesto->id_departamento = $model->id;
                $puesto->save();
            }
        }

        $entity->setId($model->id);
        return $entity;
    }

    public function find(int $id): DepartmentsAndPositions
    {
        $model = Departamento::with('puestos')->find($id);

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

        Departamento::destroy($entity->getId());
    }

    public function all(): array
    {
        return Departamento::select('*')->with(['puestos.personal', 'jefe', 'personal'])
            ->get()->toArray();
    }

    public function exists(int $id): bool
    {
        return Departamento::where('id', $id)->exists();
    }

    private function mapToEntity(Departamento $model): DepartmentsAndPositions
    {
        return new DepartmentsAndPositions(
            id: $model->id,
            nombre: $model->nombre,
            descripcion: $model->descripcion,
            idJefeArea: $model->id_jefe_area,
            puestos: $model->puestos ? $model->puestos->toArray() : [],
            createdAt: $model->created_at ? new \DateTimeImmutable($model->created_at) : null,
            updatedAt: $model->updated_at ? new \DateTimeImmutable($model->updated_at) : null,
        );
    }

    public function allDepartmentsWhithPositions(): array
    {
        $model = Departamento::select('id', 'nombre', 'descripcion', 'id_jefe_area')->with('puestos')->get();
        return $model->toArray();
    }

    public function addPositions(int $id, array $positions): void
    {
        if (!$this->exists($id)) {
            throw new DepartmentsAndPositionsNotFoundException($id);
        }

        foreach ($positions as $puestoData) {
            $puesto = new Puesto();
            $puesto->nombre = $puestoData['nombre'];
            $puesto->descripcion = $puestoData['descripcion'] ?? '';
            $puesto->level = $puestoData['level'] ?? 'mid';
            $puesto->id_departamento = $id;
            $puesto->save();
        }
    }

    public function updatePosition(int $id, array $data): void
    {
        $puesto = Puesto::find($id);

        if (!$puesto) {
            throw new DepartmentsAndPositionsNotFoundException($id);
        }

        if (isset($data['nombre'])) {
            $puesto->nombre = $data['nombre'];
        }
        if (isset($data['descripcion'])) {
            $puesto->descripcion = $data['descripcion'];
        }
        if (isset($data['level'])) {
            $puesto->level = $data['level'];
        }

        $puesto->save();
    }

    public function deletePosition(int $id): void
    {
        $puesto = Puesto::find($id);

        if (!$puesto) {
            throw new DepartmentsAndPositionsNotFoundException($id);
        }

        $puesto->delete();
    }
}
