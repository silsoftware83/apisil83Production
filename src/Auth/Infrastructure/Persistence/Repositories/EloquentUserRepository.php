<?php

namespace Src\Auth\Infrastructure\Persistence\Repositories;

use Src\Auth\Domain\Entities\User;
use Src\Auth\Domain\Repositories\UserRepositoryInterface;
use App\Models\User as EloquentUser;
use Src\Employee\PersonalData\Domain\Entities\PersonalData;
use Src\Employee\PersonalData\Infrastructure\Persistence\Eloquent\PersonalDataModel;
use Illuminate\Support\Facades\Log;

final class EloquentUserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email): ?User
    {
        $model = EloquentUser::where('email', $email)->first();

        if (!$model) {
            return null;
        }

        return $this->mapToEntity($model);
    }
    public function findByEmailWithPersona(string $email): ?User
    {
        $model = EloquentUser::where('email', $email)->with('persona')->first();

        if (!$model) {
            return null;
        }

        return $this->mapToEntityPersona($model);
    }

    public function findById(int $id): ?User
    {
        $model = EloquentUser::find($id);

        if (!$model) {
            return null;
        }

        return $this->mapToEntity($model);
    }

    public function save(User $user): User
    {
        $model = $user->getId()
            ? EloquentUser::findOrFail($user->getId())
            : new EloquentUser();

        $model->name = $user->getName();
        $model->email = $user->getEmail();
        $model->save();

        $user->setId($model->id);
        return $user;
    }

    public function exists(string $email): bool
    {
        return EloquentUser::where('email', $email)->exists();
    }

    private function mapToEntity(EloquentUser $model): User
    {
        return new User(
            id: $model->id,
            name: $model->name,
            email: $model->email,
            createdAt: $model->created_at ? new \DateTimeImmutable($model->created_at) : null,
            updatedAt: $model->updated_at ? new \DateTimeImmutable($model->updated_at) : null,

        );
    }
    private function mapToEntityPersona(EloquentUser $model): User
    {
        return new User(
            id: $model->id,
            name: $model->name,
            email: $model->email,
            persona: $model->persona,
            createdAt: $model->created_at ? new \DateTimeImmutable($model->created_at) : null,
            updatedAt: $model->updated_at ? new \DateTimeImmutable($model->updated_at) : null,
        );
    }
}
