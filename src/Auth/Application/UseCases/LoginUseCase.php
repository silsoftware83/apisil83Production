<?php

namespace Src\Auth\Application\UseCases;

use Src\Auth\Application\DTOs\LoginDTO;
use Src\Auth\Application\DTOs\AuthResponseDTO;
use Src\Auth\Application\DTOs\UserResponseDTO;
use Src\Auth\Domain\Repositories\UserRepositoryInterface;
use Src\Auth\Domain\Exceptions\InvalidCredentialsException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User as EloquentUser;

final class LoginUseCase
{
    private $repository;
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(LoginDTO $dto): AuthResponseDTO
    {


        // Find user by email
        $user = $this->repository->findByEmailWithPersona($dto->email);

        if (!$user) {
            Log::warning('Login failed: User not found', ['email' => $dto->email]);
            throw new InvalidCredentialsException();
        }

        // Get the Eloquent user model to verify password and create token
        $eloquentUser = EloquentUser::where('email', $dto->email)->first();

        if (!$eloquentUser || !Hash::check($dto->password, $eloquentUser->password)) {
            Log::warning('Login failed: Invalid password', ['email' => $dto->email]);
            throw new InvalidCredentialsException();
        }

        // Revoke all previous tokens
        $eloquentUser->tokens()->delete();

        // Create new token
        $token = $eloquentUser->createToken('auth-token')->plainTextToken;


        $tokenType = 'Bearer';
        return new AuthResponseDTO(
            user: UserResponseDTO::fromEntity($user),
            access_token: $token,
            token_type: $tokenType,
            modules: $this->repository->getModulesListByUser($user->getId())
        );
    }
}
