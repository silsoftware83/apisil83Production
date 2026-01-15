<?php

namespace Src\TimeAndLocation\Infrastructure\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Src\TimeAndLocation\Domain\Repositories\TimeAndLocationRepositoryInterface;
use Src\TimeAndLocation\Infrastructure\Persistence\Repositories\EloquentTimeAndLocationRepository;

final class TimeAndLocationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind repository interface to implementation
        $this->app->bind(
            TimeAndLocationRepositoryInterface::class,
            EloquentTimeAndLocationRepository::class
        );
    }

    public function boot(): void
    {

        Route::prefix('api/')
            ->middleware('api')
            ->group(base_path('src/TimeAndLocation/Infrastructure/Http/Routes/api.php'));
    }
}
