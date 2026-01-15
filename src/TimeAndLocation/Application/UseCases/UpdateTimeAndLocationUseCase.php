<?php

namespace Src\TimeAndLocation\Application\UseCases;

use Src\TimeAndLocation\Application\DTOs\UpdateTimeAndLocationDTO;
use Src\TimeAndLocation\Application\DTOs\TimeAndLocationResponseDTO;
use Src\TimeAndLocation\Domain\Repositories\TimeAndLocationRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class UpdateTimeAndLocationUseCase
{
    public function __construct(
        private TimeAndLocationRepositoryInterface $repository
    ) {}

    public function execute(UpdateTimeAndLocationDTO $dto): TimeAndLocationResponseDTO
    {
        return DB::transaction(function () use ($dto) {
            Log::info('Updating TimeAndLocation', ['id' => $dto->id]);

            $entity = $this->repository->find($dto->id);

            // TODO: Update entity properties from DTO

            $entity = $this->repository->save($entity);

            Log::info('TimeAndLocation updated successfully', ['id' => $entity->getId()]);

            return TimeAndLocationResponseDTO::fromEntity($entity);
        });
    }
}
