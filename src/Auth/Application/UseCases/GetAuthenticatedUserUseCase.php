<?php

namespace Src\Auth\Application\UseCases;

use Src\Auth\Application\DTOs\UserResponseDTO;
use Src\Auth\Domain\Repositories\UserRepositoryInterface;
use Src\Auth\Domain\Exceptions\UserNotFoundException;
use App\Models\User as EloquentUser;

final class GetAuthenticatedUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $repository
    ) {}

    public function execute(EloquentUser $eloquentUser): UserResponseDTO
    {
        $user = $this->repository->findById($eloquentUser->id);

        if (!$user) {
            throw new UserNotFoundException((string) $eloquentUser->id);
        }

        return UserResponseDTO::fromEntity($user);
    }
}
