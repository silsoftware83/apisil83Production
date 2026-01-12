<?php

namespace Src\Employee\PersonalData\Application\UseCases;

use Src\Employee\PersonalData\Application\DTOs\UpdatePersonalDataDTO;
use Src\Employee\PersonalData\Application\DTOs\PersonalDataResponseDTO;
use Src\Employee\PersonalData\Domain\Repositories\PersonalDataRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class UpdatePersonalDataUseCase
{
    public function __construct(
        private PersonalDataRepositoryInterface $repository
    ) {}

    public function execute(UpdatePersonalDataDTO $dto): PersonalDataResponseDTO
    {
        return DB::transaction(function () use ($dto) {
            Log::info('Updating PersonalData', ['id' => $dto->id]);

            $entity = $this->repository->find($dto->id);

            // TODO: Update entity properties from DTO

            $entity = $this->repository->save($entity);

            Log::info('PersonalData updated successfully', ['id' => $entity->getId()]);

            return PersonalDataResponseDTO::fromEntity($entity);
        });
    }
}
