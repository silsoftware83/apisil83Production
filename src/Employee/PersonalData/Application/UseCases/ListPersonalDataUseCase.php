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
        $result = $this->repository->all($dto->perPage, $dto->active);

        if (isset($result['data']) && is_array($result['data'])) {
            $result['data'] = array_map(
                fn($entity) => PersonalDataResponseDTO::fromEntity($entity)->toArray(),
                $result['data']
            );
            return $result;
        }

        return array_map(
            fn($entity) => PersonalDataResponseDTO::fromEntity($entity)->toArray(),
            $result
        );
    }
}
