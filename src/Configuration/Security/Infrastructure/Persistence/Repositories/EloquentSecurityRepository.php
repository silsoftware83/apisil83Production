<?php

namespace Src\Configuration\Security\Infrastructure\Persistence\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Src\Configuration\Security\Domain\Repositories\SecurityRepositoryInterface;
use Src\Employee\PersonalData\PersonalInformation\Infrastructure\Persistence\Eloquent\PersonalDataModel;

use Src\Configuration\Security\Domain\Entities\Security;
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

    public function delete(int $id): void
    {
        SecurityModel::destroy($id);
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

    public function Personal(): array
    {
        return User::where('active', 1)
            ->get()
            ->map(fn($user) => new Security(
                id: $user->id,
                name: $user->name,
                email: $user->email,
                password: $user->password,
                last_seen: $user->last_seen,
                id_personal: $user->id_personal,
                active: $user->active,
                passwordLetter: $user->passwordLetter,
                createdAt: $user->created_at ? new \DateTimeImmutable($user->created_at) : null,
                updatedAt: $user->updated_at ? new \DateTimeImmutable($user->updated_at) : null,
            ))
            ->toArray();
    }

    private function mapToEntity(SecurityModel $model): Security
    {
        return new Security(
            id: $model->id,
            createdAt: $model->created_at ? new \DateTimeImmutable($model->created_at) : null,
            updatedAt: $model->updated_at ? new \DateTimeImmutable($model->updated_at) : null,
        );
    }

    public function getInformationEmployee(int $id): ?object
    {
        return PersonalDataModel::where('id', $id)
            ->select('id', 'name', 'lastName', 'email')
            ->first();
    }

    public function createUser(array $data): object
    {
        return User::create([
            'id_personal' => $data['id_personal'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'passwordLetter' => $data['passwordLetter'],
            'active' => 1,
        ]);
    }

    public function getAllModulesWithFullTreeByUser(int $userId): array
    {
        $modules = DB::table('modules as m')
            ->leftJoin('user_module_access as uma', function ($join) use ($userId) {
                $join->on('uma.module_id', '=', 'm.id')
                    ->where('uma.user_id', $userId)
                    ->whereNull('uma.submodule_id');
            })
            ->select(
                'm.id',
                'm.name',
                'm.slug',
                'm.description',
                'm.icon',
                DB::raw('IFNULL(uma.can_create, 0) as can_create'),
                DB::raw('IFNULL(uma.can_edit, 0) as can_edit'),
                DB::raw('IFNULL(uma.can_view, 0) as can_view'),
                DB::raw('IFNULL(uma.can_delete, 0) as can_delete')
            )
            ->get();

        foreach ($modules as $module) {
            $module->submodules = DB::table('submodules as s')
                ->leftJoin('user_module_access as uma', function ($join) use ($userId) {
                    $join->on('uma.submodule_id', '=', 's.id')
                        ->where('uma.user_id', $userId)
                        ->whereNull('uma.subsubmodule_id');
                })
                ->where('s.level', 1)
                ->where('s.module_id', $module->id)
                ->select(
                    's.id',
                    's.module_id',
                    's.name',
                    's.slug',
                    's.description',
                    's.icon',
                    's.level',
                    DB::raw('IFNULL(uma.can_create, 0) as can_create'),
                    DB::raw('IFNULL(uma.can_edit, 0) as can_edit'),
                    DB::raw('IFNULL(uma.can_view, 0) as can_view'),
                    DB::raw('IFNULL(uma.can_delete, 0) as can_delete')
                )
                ->get();

            foreach ($module->submodules as $sub) {
                $sub->subsubmodules = DB::table('submodules as s')
                    ->leftJoin('user_module_access as uma', function ($join) use ($userId) {
                        $join->on('uma.subsubmodule_id', '=', 's.id')
                            ->where('uma.user_id', $userId);
                    })
                    ->where('s.level', 2)
                    ->where('s.parent_submodule_id', $sub->id)
                    ->select(
                        's.id',
                        's.module_id',
                        's.name',
                        's.slug',
                        's.description',
                        's.icon',
                        's.level',
                        DB::raw('IFNULL(uma.can_create, 0) as can_create'),
                        DB::raw('IFNULL(uma.can_edit, 0) as can_edit'),
                        DB::raw('IFNULL(uma.can_view, 0) as can_view'),
                        DB::raw('IFNULL(uma.can_delete, 0) as can_delete')
                    )
                    ->get();
            }
        }

        return $modules->toArray();
    }

    public function deletePrevius(int $userId): void
    {
        DB::table('user_module_access')->where('user_id', $userId)->delete();
    }

    public function createAccess(array $data): void
    {
        DB::table('user_module_access')->insert($data);
    }

    public function showPassword(int $id): ?object
    {
        return User::where('id', $id)
            ->select('passwordLetter', 'email')
            ->first();
    }

    public function getEmployeeWhitOutUser(): array
    {
        return PersonalDataModel::leftJoin('users', 'users.id_personal', '=', 'personal.id')
            ->whereNull('users.id_personal')
            ->where('personal.activo', 1)
            ->select(
                'personal.id as value',
                'personal.lastName as lastName',
                'personal.name as label',
                'personal.email as aditionalData'
            )
            ->get()
            ->toArray();
    }
}
