<?php

namespace Src\Employee\PersonalData\PersonalInformation\Infrastructure\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Src\Employee\PersonalData\PersonalInformation\Domain\Repositories\PersonalDataRepositoryInterface;
use Src\Employee\PersonalData\PersonalInformation\Infrastructure\Persistence\Repositories\EloquentPersonalDataRepository;

final class PersonalDataServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind repository interface to implementation
        $this->app->bind(
            PersonalDataRepositoryInterface::class,
            EloquentPersonalDataRepository::class
        );
    }

    public function boot(): void
    {
        Route::prefix('api/')
            ->middleware('api')
            ->group(base_path('src/Employee/PersonalData/PersonalInformation/Infrastructure/Http/Routes/api.php'));
    }
}
