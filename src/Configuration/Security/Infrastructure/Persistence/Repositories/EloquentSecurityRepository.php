<?php

namespace Src\Configuration\Security\Infrastructure\Persistence\Repositories;

use Src\Configuration\Security\Domain\Entities\Security;
use Src\Configuration\Security\Domain\Repositories\SecurityRepositoryInterface;
use Src\Configuration\Security\Domain\Exceptions\SecurityNotFoundException;
use Src\Configuration\Security\Infrastructure\Persistence\Eloquent\SecurityModel;

final class EloquentSecurityRepository implements SecurityRepositoryInterface
{
    public function save(Security $entity): Security
    {
        $model = $entity->getId()
            ? SecurityModel::findOrFail($entity->getId())
            : new SecurityModel();

        $data = $entity->toArray();
        unset($data['id'], $data['created_at'], $data['updated_at']);
        
        $model->fill($data);
        $model->save();

        $entity->setId($model->id);
        return $entity;
    }

    public function find(int $id): Security
    {
        $model = SecurityModel::find($id);

        if (!$model) {
            throw new SecurityNotFoundException($id);
        }

        return $this->mapToEntity($model);
    }

    public function delete(Security $entity): void
    {
        if (!$entity->getId()) {
            throw new SecurityNotFoundException(0);
        }

        SecurityModel::destroy($entity->getId());
    }

    public function all(): array
    {
        return SecurityModel::all()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();
    }

    public function exists(int $id): bool
    {
        return SecurityModel::where('id', $id)->exists();
    }

    private function mapToEntity(SecurityModel $model): Security
    {
        return new Security(
            id: $model->id,
            // TODO: Map other properties
            createdAt: $model->created_at ? new \DateTimeImmutable($model->created_at) : null,
            updatedAt: $model->updated_at ? new \DateTimeImmutable($model->updated_at) : null,
        );
    }
}
