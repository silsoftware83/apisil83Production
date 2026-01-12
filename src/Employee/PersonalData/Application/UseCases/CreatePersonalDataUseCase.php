<?php

namespace Src\Employee\PersonalData\Application\UseCases;

use Src\Employee\PersonalData\Application\DTOs\CreatePersonalDataDTO;
use Src\Employee\PersonalData\Application\DTOs\PersonalDataResponseDTO;
use Src\Employee\PersonalData\Domain\Entities\PersonalData;
use Src\Employee\PersonalData\Domain\Repositories\PersonalDataRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class CreatePersonalDataUseCase
{
    public function __construct(
        private PersonalDataRepositoryInterface $repository
    ) {}

    public function execute(CreatePersonalDataDTO $dto): PersonalDataResponseDTO
    {
        return DB::transaction(function () use ($dto) {
            Log::info('Creating PersonalData', $dto->toArray());

            $entity = new PersonalData(
                // TODO: Map DTO to Entity
            );

            $entity = $this->repository->save($entity);

            Log::info('PersonalData created successfully', ['id' => $entity->getId()]);

            return PersonalDataResponseDTO::fromEntity($entity);
        });
    }
}
