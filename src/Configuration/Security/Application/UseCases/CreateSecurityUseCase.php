<?php

namespace Src\Configuration\Security\Application\UseCases;

use Src\Configuration\Security\Application\DTOs\CreateSecurityDTO;
use Src\Configuration\Security\Domain\Repositories\SecurityRepositoryInterface;
use Illuminate\Support\Facades\DB;

final class CreateSecurityUseCase
{
    public function __construct(
        private SecurityRepositoryInterface $repository
    ) {}

    public function execute(CreateSecurityDTO $dto): void
    {
        DB::transaction(function () use ($dto) {
            $data = [];
            $user_id = $dto->userId;

            foreach ($dto->permissions as $module) {
                // Módulo
                $data[] = [
                    'user_id' => $user_id,
                    'module_id' => $module['id'],
                    'submodule_id' => null,
                    'subsubmodule_id' => null,
                    'can_view' => $module['can_view'],
                    'can_create' => $module['can_create'],
                    'can_edit' => $module['can_edit'],
                    'can_delete' => $module['can_delete'],
                ];

                foreach ($module['submodules'] as $submodule) {
                    // Submódulo
                    $data[] = [
                        'user_id' => $user_id,
                        'module_id' => $module['id'],
                        'submodule_id' => $submodule['id'],
                        'subsubmodule_id' => null,
                        'can_view' => $submodule['can_view'],
                        'can_create' => $submodule['can_create'],
                        'can_edit' => $submodule['can_edit'],
                        'can_delete' => $submodule['can_delete'],
                    ];

                    foreach ($submodule['subsubmodules'] as $subsubmodule) {
                        // Sub-submódulo
                        $data[] = [
                            'user_id' => $user_id,
                            'module_id' => $module['id'],
                            'submodule_id' => $submodule['id'],
                            'subsubmodule_id' => $subsubmodule['id'],
                            'can_view' => $subsubmodule['can_view'],
                            'can_create' => $subsubmodule['can_create'],
                            'can_edit' => $subsubmodule['can_edit'],
                            'can_delete' => $subsubmodule['can_delete'],
                        ];
                    }
                }
            }

            $this->repository->deletePrevius($user_id);
            $this->repository->createAccess($data);
        });
    }
}
