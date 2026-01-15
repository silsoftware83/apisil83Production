<?php

namespace Src\Configuration\Security\Application\UseCases;

use Src\Configuration\Security\Application\DTOs\RestorePasswordDTO;
use Src\Configuration\Security\Domain\Repositories\SecurityRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\ResetPasswordMail;

final class RestorePasswordUseCase
{
    public function __construct(
        private SecurityRepositoryInterface $repository
    ) {}

    public function execute(RestorePasswordDTO $dto): void
    {
        $user = User::find($dto->id);
        if (!$user) {
            throw new \Exception("User not found");
        }

        $email = strtolower($user->email);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : 'alexisduarte1512@gmail.com';

        $stringAleatorio = Str::random(8);

        User::where('id', $dto->id)->update([
            'password' => Hash::make($stringAleatorio),
            'passwordLetter' => $stringAleatorio,
            'passwordactualizadopor' => $dto->updatedBy,
        ]);

        Mail::to($email)->cc(['alexisduarte1512@gmail.com'])->send(new ResetPasswordMail($email, $stringAleatorio));
    }
}
