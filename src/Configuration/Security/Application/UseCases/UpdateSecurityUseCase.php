<?php

namespace Src\Configuration\Security\Application\UseCases;

use Src\Configuration\Security\Application\DTOs\UpdateSecurityDTO;
use Src\Configuration\Security\Application\DTOs\SecurityResponseDTO;
use Src\Configuration\Security\Domain\Repositories\SecurityRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class UpdateSecurityUseCase
{
    public function __construct(
        private SecurityRepositoryInterface $repository
    ) {}

    public function execute(UpdateSecurityDTO $dto): SecurityResponseDTO
    {
        return DB::transaction(function () use ($dto) {
            Log::info('Updating Security', ['id' => $dto->id]);

            $entity = $this->repository->find($dto->id);

            // TODO: Update entity properties from DTO

            $entity = $this->repository->save($entity);

            Log::info('Security updated successfully', ['id' => $entity->getId()]);

            return SecurityResponseDTO::fromEntity($entity);
        });
    }
}
