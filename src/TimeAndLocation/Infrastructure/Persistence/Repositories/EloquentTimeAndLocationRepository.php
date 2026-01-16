<?php

namespace Src\TimeAndLocation\Infrastructure\Persistence\Repositories;

use Src\TimeAndLocation\Domain\Entities\TimeAndLocation;
use Src\TimeAndLocation\Domain\Repositories\TimeAndLocationRepositoryInterface;
use Src\TimeAndLocation\Domain\Exceptions\TimeAndLocationNotFoundException;
use Src\TimeAndLocation\Infrastructure\Persistence\Eloquent\TimeAndLocationModel;

final class EloquentTimeAndLocationRepository implements TimeAndLocationRepositoryInterface
{
    public function save(TimeAndLocation $entity): TimeAndLocation
    {
        $model = new TimeAndLocationModel();

        $data = $entity->toArray();
        unset($data['id']);

        $model->fill($data);
        $model->save();

        $entity->setId($model->id);
        return $entity;
    }

    public function find(int $id): TimeAndLocation
    {
        $model = TimeAndLocationModel::find($id);

        if (!$model) {
            throw new TimeAndLocationNotFoundException($id);
        }

        return $this->mapToEntity($model);
    }

    public function delete(TimeAndLocation $entity): void
    {
        if (!$entity->getId()) {
            throw new TimeAndLocationNotFoundException(0);
        }

        TimeAndLocationModel::destroy($entity->getId());
    }

    public function all(): array
    {
        return TimeAndLocationModel::all()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();
    }

    public function exists(int $id): bool
    {
        return TimeAndLocationModel::where('id', $id)->exists();
    }

    public function recordsByUserToday(int $userId): array
    {
        return TimeAndLocationModel::where('id_user', $userId)
            ->whereDate('created_at', now()->toDateString())
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();
    }

    private function mapToEntity(TimeAndLocationModel $model): TimeAndLocation
    {
        return new TimeAndLocation(
            id: $model->id,
            latitud: $model->latitud,
            longitud: $model->longitud,
            id_user: $model->id_user,
            time: $model->time,
            ip: $model->ip,
            cancheckoutnotary: $model->cancheckoutnotary,
            isweb: $model->isweb,
            comments: $model->comments,
            createdAt: $model->created_at ? new \DateTimeImmutable($model->created_at) : null,
            updatedAt: $model->updated_at ? new \DateTimeImmutable($model->updated_at) : null,
            type: $model->type
        );
    }
}
