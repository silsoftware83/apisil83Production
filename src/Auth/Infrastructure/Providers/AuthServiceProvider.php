<?php

namespace Src\Auth\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Src\Auth\Domain\Repositories\UserRepositoryInterface;
use Src\Auth\Infrastructure\Persistence\Repositories\EloquentUserRepository;

final class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind repository interface to implementation
        $this->app->bind(
            UserRepositoryInterface::class,
            EloquentUserRepository::class
        );
    }

    public function boot(): void
    {
        Route::prefix('api/auth')
            ->middleware('api')
            ->group(base_path('src/Auth/Infrastructure/Http/Routes/api.php'));
    }
}
