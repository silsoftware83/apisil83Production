<?php

namespace Src\Employee\PersonalData\Application\UseCases;

use Src\Employee\PersonalData\Application\DTOs\SearchPersonalDataDTO;
use Src\Employee\PersonalData\Domain\Repositories\PersonalDataRepositoryInterface;

class SearchPersonalDataUseCase
{
    public function __construct(
        private PersonalDataRepositoryInterface $repository
    ) {}

    public function execute(SearchPersonalDataDTO $dto): array
    {
        $entities = $this->repository->search($dto->search);

        return array_map(
            fn($entity) => \Src\Employee\PersonalData\Application\DTOs\PersonalDataResponseDTO::fromEntity($entity)->toArray(),
            $entities
        );
    }
}
