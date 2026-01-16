<?php

namespace Src\TimeAndLocation\Application\UseCases;

use Src\TimeAndLocation\Application\DTOs\CreateTimeAndLocationDTO;
use Src\TimeAndLocation\Application\DTOs\TimeAndLocationResponseDTO;
use Src\TimeAndLocation\Domain\Entities\TimeAndLocation;
use Src\TimeAndLocation\Domain\Repositories\TimeAndLocationRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class CreateTimeAndLocationUseCase
{
    public function __construct(
        private TimeAndLocationRepositoryInterface $repository
    ) {}

    public function execute(CreateTimeAndLocationDTO $dto): TimeAndLocationResponseDTO
    {
        return DB::transaction(function () use ($dto) {
            Log::info('Creating TimeAndLocation', $dto->toArray());

            $entity = new TimeAndLocation(
                id: 0,
                latitud: $dto->latitud,
                longitud: $dto->longitud,
                id_user: $dto->id_user,
                time: $dto->time,
                ip: $dto->ip,
                cancheckoutnotary: $dto->cancheckoutnotary,
                isweb: $dto->isweb,
                comments: $dto->comments,
                type: $dto->type,
            );

            $entity = $this->repository->save($entity);

            Log::info('TimeAndLocation created successfully', ['id' => $entity->getId()]);

            return TimeAndLocationResponseDTO::fromEntity($entity);
        });
    }
}
