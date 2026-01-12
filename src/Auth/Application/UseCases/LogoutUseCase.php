<?php

namespace Src\Auth\Application\UseCases;

use Illuminate\Support\Facades\Log;
use App\Models\User as EloquentUser;

final class LogoutUseCase
{
    public function execute(EloquentUser $user): void
    {
        Log::info('Logout attempt', ['user_id' => $user->id]);

        // Revoke current token
        $user->currentAccessToken()->delete();

        Log::info('Logout successful', ['user_id' => $user->id]);
    }
}
