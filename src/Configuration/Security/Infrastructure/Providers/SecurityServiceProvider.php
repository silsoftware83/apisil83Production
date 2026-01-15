<?php

namespace Src\Configuration\Security\Infrastructure\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Src\Configuration\Security\Domain\Repositories\SecurityRepositoryInterface;
use Src\Configuration\Security\Infrastructure\Persistence\Repositories\EloquentSecurityRepository;

final class SecurityServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind repository interface to implementation
        $this->app->bind(
            SecurityRepositoryInterface::class,
            EloquentSecurityRepository::class
        );
    }

    public function boot(): void
    {
        // $this->loadRoutesFrom(

        //     base_path('src/Configuration/Security/Infrastructure/Http/Routes/api.php')
        // );
        Route::prefix('api/')
            ->middleware('api')
            ->group(base_path('src/Configuration/Security/Infrastructure/Http/Routes/api.php'));
    }
}
