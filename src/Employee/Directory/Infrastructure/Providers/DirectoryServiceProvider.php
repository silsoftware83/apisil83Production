<?php

namespace Src\Employee\Directory\Infrastructure\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Src\Employee\Directory\Domain\Repositories\DirectoryRepositoryInterface;
use Src\Employee\Directory\Infrastructure\Persistence\Repositories\EloquentDirectoryRepository;

final class DirectoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind repository interface to implementation
        $this->app->bind(
            DirectoryRepositoryInterface::class,
            EloquentDirectoryRepository::class
        );
    }

    public function boot(): void
    {

        Route::prefix('api/')
            ->middleware('api')
            ->group(base_path('src/Employee/Directory/Infrastructure/Http/Routes/api.php'));
    }
}
