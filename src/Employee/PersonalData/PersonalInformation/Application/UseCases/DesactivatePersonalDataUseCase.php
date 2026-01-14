<?php

namespace Src\Employee\PersonalData\PersonalInformation\Application\UseCases;

use Src\Employee\PersonalData\PersonalInformation\Domain\Repositories\PersonalDataRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class DesactivatePersonalDataUseCase
{
    public function __construct(
        private PersonalDataRepositoryInterface $repository
    ) {}

    public function execute(int $id): void
    {
        DB::transaction(function () use ($id) {
            Log::info('Desactivating PersonalData', ['id' => $id]);

            $entity = $this->repository->find($id);
            $entity->setActivo(0);

            $this->repository->save($entity);

            Log::info('PersonalData desactivated successfully', ['id' => $id]);
        });
    }
}
