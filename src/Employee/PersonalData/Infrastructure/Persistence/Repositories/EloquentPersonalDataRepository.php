<?php

namespace Src\Employee\PersonalData\Infrastructure\Persistence\Repositories;

use Src\Employee\PersonalData\Domain\Entities\PersonalData;
use Src\Employee\PersonalData\Domain\Repositories\PersonalDataRepositoryInterface;
use Src\Employee\PersonalData\Domain\Exceptions\PersonalDataNotFoundException;
use Src\Employee\PersonalData\Infrastructure\Persistence\Eloquent\PersonalDataModel;

final class EloquentPersonalDataRepository implements PersonalDataRepositoryInterface
{
    public function save(PersonalData $entity): PersonalData
    {
        $model = $entity->getId()
            ? PersonalDataModel::findOrFail($entity->getId())
            : new PersonalDataModel();

        $data = $entity->toArray();
        unset($data['id'], $data['created_at'], $data['updated_at']);

        $model->fill($data);
        $model->save();

        $entity->setId($model->id);
        return $entity;
    }

    public function find(int $id): PersonalData
    {
        $model = PersonalDataModel::find($id);

        if (!$model) {
            throw new PersonalDataNotFoundException($id);
        }

        return $this->mapToEntity($model);
    }

    public function delete(PersonalData $entity): void
    {
        if (!$entity->getId()) {
            throw new PersonalDataNotFoundException(0);
        }

        PersonalDataModel::destroy($entity->getId());
    }

    public function all(int $perPage, int $active, int $page = 1): array
    {
        $paginator = PersonalDataModel::where('activo', $active)
            ->paginate($perPage, ['*'], 'page', $page);

        $paginator->getCollection()->transform(fn($model) => $this->mapToEntity($model));

        return $paginator->toArray();
    }

    public function exists(int $id): bool
    {
        return PersonalDataModel::where('id', $id)->exists();
    }

    private function mapToEntity(PersonalDataModel $model): PersonalData
    {
        return new PersonalData(
            id: $model->id,
            name: $model->name,
            lastName: $model->lastName,
            email: $model->email,
        );
    }
}
