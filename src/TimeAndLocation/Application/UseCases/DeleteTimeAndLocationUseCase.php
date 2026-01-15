<?php

namespace Src\TimeAndLocation\Application\UseCases;

use Src\TimeAndLocation\Domain\Repositories\TimeAndLocationRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class DeleteTimeAndLocationUseCase
{
    public function __construct(
        private TimeAndLocationRepositoryInterface $repository
    ) {}

    public function execute(int $id): void
    {
        DB::transaction(function () use ($id) {
            Log::info('Deleting TimeAndLocation', ['id' => $id]);

            $entity = $this->repository->find($id);
            $this->repository->delete($entity);

            Log::info('TimeAndLocation deleted successfully', ['id' => $id]);
        });
    }
}
