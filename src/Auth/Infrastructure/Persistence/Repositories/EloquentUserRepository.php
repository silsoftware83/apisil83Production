<?php

namespace Src\Auth\Infrastructure\Persistence\Repositories;

use Src\Auth\Domain\Entities\User;
use Src\Auth\Domain\Repositories\UserRepositoryInterface;
use App\Models\User as EloquentUser;
use Src\Employee\PersonalData\Domain\Entities\PersonalData;

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
        $model = EloquentUser::where('email', $email)->with([
            'persona' => function ($q) {
                $q->select('id', 'name', 'lastName', 'id_departamento', 'id_puesto')
                    ->with([
                        'departamento:id,nombre',
                        'puesto:id,id_departamento,nombre'
                    ]);
            }
        ])->first();

        if (!$model) {
            return null;
        }

        return $this->mapToEntityPersonaLogin($model);
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
        );
    }

    private function mapToEntityPersonaLogin(EloquentUser $model): User
    {
        return new User(
            id: $model->id,
            name: $model->name,
            email: $model->email,
            persona: new PersonalData(
                id: $model->persona->id,
                idDepartamento: $model->persona->id_departamento,
                idPuesto: $model->persona->id_puesto,
                idJefeInmediato: $model->persona->id_jefe_inmediato,
                name: $model->persona->name,
                lastName: $model->persona->lastName,
                departamento: $model->persona->departamento,
                puesto: $model->persona->puesto,
            )
        );
    }
}
