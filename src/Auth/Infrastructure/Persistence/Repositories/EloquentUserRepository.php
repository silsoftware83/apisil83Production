<?php

namespace Src\Auth\Infrastructure\Persistence\Repositories;

use Src\Auth\Domain\Entities\User;
use Src\Auth\Domain\Repositories\UserRepositoryInterface;
use App\Models\User as EloquentUser;
use Illuminate\Support\Collection;
use Src\Employee\PersonalData\Domain\Entities\PersonalData;
use Illuminate\Support\Facades\DB;

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
                    ->with(['departamento:id,nombre', 'puesto:id,id_departamento,nombre']);
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
            passwordLetter: $model->passwordLetter,
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


    public function getModulesListByUser(int $userId): Collection

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
                'm.route',
                'm.sort_order',
                DB::raw('IFNULL(uma.can_view, 0) as can_view'),
                DB::raw('IFNULL(uma.can_create, 0) as can_create'),
                DB::raw('IFNULL(uma.can_edit, 0) as can_edit'),
                DB::raw('IFNULL(uma.can_delete, 0) as can_delete')
            )->orderBy('m.sort_order', 'asc')
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
                    's.route',
                    's.level',
                    DB::raw('IFNULL(uma.can_view, 0) as can_view'),
                    DB::raw('IFNULL(uma.can_create, 0) as can_create'),
                    DB::raw('IFNULL(uma.can_edit, 0) as can_edit'),
                    DB::raw('IFNULL(uma.can_delete, 0) as can_delete')
                )
                ->get();
        }

        foreach ($modules as $module) {
            $module->submodules = $module->submodules->map(function ($sub) use ($userId) {

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
                        's.route',
                        DB::raw('IFNULL(uma.can_view, 0) as can_view'),
                        DB::raw('IFNULL(uma.can_create, 0) as can_create'),
                        DB::raw('IFNULL(uma.can_edit, 0) as can_edit'),
                        DB::raw('IFNULL(uma.can_delete, 0) as can_delete')
                    )
                    ->get()
                    ->filter(fn($ss) => $ss->can_view == 1)
                    ->values();

                return $sub;
            })
                // dejar solo submódulos visibles o que tengan hijos visibles
                ->filter(fn($sub) => $sub->can_view == 1 || $sub->subsubmodules->isNotEmpty())
                ->values();
        }

        // dejar solo módulos visibles o que tengan submódulos visibles
        $modules = $modules
            ->filter(fn($module) => $module->can_view == 1 || $module->submodules->isNotEmpty())
            ->values();

        return $modules;
    }
}
