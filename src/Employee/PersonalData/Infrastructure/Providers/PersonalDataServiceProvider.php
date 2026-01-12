<?php

namespace Src\Employee\PersonalData\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Employee\PersonalData\Domain\Repositories\PersonalDataRepositoryInterface;
use Src\Employee\PersonalData\Infrastructure\Persistence\Repositories\EloquentPersonalDataRepository;

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
        $this->loadRoutesFrom(
            base_path('src/Employee/PersonalData/Infrastructure/Http/Routes/api.php')
        );
    }
}
