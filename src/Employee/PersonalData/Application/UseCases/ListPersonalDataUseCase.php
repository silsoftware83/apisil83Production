<?php

namespace Src\Employee\PersonalData\Application\UseCases;

use Src\Employee\PersonalData\Application\DTOs\ListPersonalDataDTO;
use Src\Employee\PersonalData\Application\DTOs\PersonalDataResponseDTO;
use Src\Employee\PersonalData\Domain\Repositories\PersonalDataRepositoryInterface;

final class ListPersonalDataUseCase
{
    public function __construct(
        private PersonalDataRepositoryInterface $repository
    ) {}

    public function execute(ListPersonalDataDTO $dto): array
    {
        $entities = $this->repository->all($dto->perPage, $dto->active);

        return array_map(
            fn($entity) => PersonalDataResponseDTO::fromEntity($entity),
            $entities
        );
    }
}
