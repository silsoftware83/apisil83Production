<?php

namespace Src\Configuration\Security\Application\UseCases;

use Src\Configuration\Security\Application\DTOs\CreateSecurityDTO;
use Src\Configuration\Security\Application\DTOs\SecurityResponseDTO;
use Src\Configuration\Security\Domain\Entities\Security;
use Src\Configuration\Security\Domain\Repositories\SecurityRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class CreateSecurityUseCase
{
    public function __construct(
        private SecurityRepositoryInterface $repository
    ) {}

    public function execute(CreateSecurityDTO $dto): SecurityResponseDTO
    {
        return DB::transaction(function () use ($dto) {
            Log::info('Creating Security', $dto->toArray());

            $entity = new Security(
                // TODO: Map DTO to Entity
            );

            $entity = $this->repository->save($entity);

            Log::info('Security created successfully', ['id' => $entity->getId()]);

            return SecurityResponseDTO::fromEntity($entity);
        });
    }
}
