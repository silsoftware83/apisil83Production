<?php

namespace Src\Configuration\Security\Application\UseCases;

use Src\Configuration\Security\Application\DTOs\AddUserDTO;
use Src\Configuration\Security\Domain\Repositories\SecurityRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Src\Configuration\Security\Domain\Events\UserCreated;

final class AddUserUseCase
{
    public function __construct(
        private SecurityRepositoryInterface $repository
    ) {}

    public function execute(AddUserDTO $dto): void
    {
        $employee = $this->repository->getInformationEmployee($dto->employee_id);

        if (!$employee) {
            throw new \Exception("Employee not found");
        }

        $email = strtolower($employee->email);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : 'alexisduarte1512@gmail.com';

        $temporaryPassword = Str::random(8);
        $password = Hash::make($temporaryPassword);

        $user = $this->repository->createUser([
            'id_personal' => $dto->employee_id,
            'name' => "{$employee->name} {$employee->lastName}",
            'email' => $email,
            'password' => $password,
            'passwordLetter' => $temporaryPassword,
        ]);

        if ($user) {
            event(new UserCreated(
                email: $email,
                temporaryPassword: $temporaryPassword
            ));
        }
    }
}
