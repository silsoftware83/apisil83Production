<?php

namespace Src\Employee\PersonalData\PersonalInformation\Application\UseCases;

use Src\Employee\PersonalData\PersonalInformation\Application\DTOs\PersonalDataResponseDTO;
use Src\Employee\PersonalData\PersonalInformation\Application\DTOs\SearchPersonalDataDTO;
use Src\Employee\PersonalData\PersonalInformation\Domain\Repositories\PersonalDataRepositoryInterface;

class SearchPersonalDataUseCase
{
    public function __construct(
        private PersonalDataRepositoryInterface $repository
    ) {}

    public function execute(SearchPersonalDataDTO $dto): array
    {
        $entities = $this->repository->search($dto->search);

        return array_map(
            fn($entity) => PersonalDataResponseDTO::fromEntity($entity)->toArray(),
            $entities
        );
    }
}
