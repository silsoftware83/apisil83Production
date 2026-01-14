<?php

namespace Src\Employee\Directory\Infrastructure\Persistence\Repositories;

use Src\Employee\Directory\Domain\Entities\Directory;
use Src\Employee\Directory\Domain\Repositories\DirectoryRepositoryInterface;
use Src\Employee\Directory\Domain\Exceptions\DirectoryNotFoundException;
use Src\Employee\Directory\Infrastructure\Persistence\Eloquent\DirectoryModel;
use Src\Employee\PersonalData\PersonalInformation\Infrastructure\Persistence\Eloquent\PersonalDataModel;

final class EloquentDirectoryRepository implements DirectoryRepositoryInterface
{
    public function save(Directory $entity): Directory
    {
        $model = $entity->getId()
            ? DirectoryModel::findOrFail($entity->getId())
            : new DirectoryModel();

        $data = $entity->toArray();
        unset($data['id'], $data['created_at'], $data['updated_at']);

        $model->fill($data);
        $model->save();

        $entity->setId($model->id);
        return $entity;
    }

    public function find(int $id): Directory
    {
        $model = DirectoryModel::find($id);

        if (!$model) {
            throw new DirectoryNotFoundException($id);
        }

        return $this->mapToEntity($model);
    }

    public function delete(Directory $entity): void
    {
        if (!$entity->getId()) {
            throw new DirectoryNotFoundException(0);
        }

        DirectoryModel::destroy($entity->getId());
    }

    public function all(): array
    {
        return PersonalDataModel::all()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();
    }

    public function exists(int $id): bool
    {
        return DirectoryModel::where('id', $id)->exists();
    }

    private function mapToEntity(PersonalDataModel $model): Directory
    {
        return new Directory(
            id: $model->id,
            name: $model->name,
            lastName: $model->lastName,
            puesto: $model->puesto,
            wArea: $model->wArea,
            emailCompany: $model->emailCompany,
            ext_tel: $model->ext_tel,
            phone: $model->phone,
        );
    }
}
