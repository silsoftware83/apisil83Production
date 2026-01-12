<?php

namespace Src\Employee\PersonalData\Application\UseCases;

use Src\Employee\PersonalData\Domain\Repositories\PersonalDataRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class DeletePersonalDataUseCase
{
    public function __construct(
        private PersonalDataRepositoryInterface $repository
    ) {}

    public function execute(int $id): void
    {
        DB::transaction(function () use ($id) {
            Log::info('Deleting PersonalData', ['id' => $id]);

            $entity = $this->repository->find($id);
            $this->repository->delete($entity);

            Log::info('PersonalData deleted successfully', ['id' => $id]);
        });
    }
}
