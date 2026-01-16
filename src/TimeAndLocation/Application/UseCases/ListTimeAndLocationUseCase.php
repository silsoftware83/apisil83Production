<?php

namespace Src\TimeAndLocation\Application\UseCases;

use Src\TimeAndLocation\Application\DTOs\ListTimeAndLocationDTO;
use Src\TimeAndLocation\Application\DTOs\TimeAndLocationResponseDTO;
use Src\TimeAndLocation\Domain\Repositories\TimeAndLocationRepositoryInterface;

final class ListTimeAndLocationUseCase
{
    public function __construct(
        private TimeAndLocationRepositoryInterface $repository
    ) {}

    public function execute(ListTimeAndLocationDTO $dto): array
    {
        $entities = $this->repository->recordsByUserToday($dto->id);

        return array_map(
            fn($entity) => TimeAndLocationResponseDTO::fromEntity($entity),
            $entities
        );
    }
}
