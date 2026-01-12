<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Configuration\Company\DepartmentsAndPositions\Domain\Repositories\DepartmentsAndPositionsRepositoryInterface;
use Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Persistence\Repositories\EloquentDepartmentsAndPositionsRepository;

final class DepartmentsAndPositionsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind repository interface to implementation
        $this->app->bind(
            DepartmentsAndPositionsRepositoryInterface::class,
            EloquentDepartmentsAndPositionsRepository::class
        );
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(
            base_path('src/Configuration/Company/DepartmentsAndPositions/Infrastructure/Http/Routes/api.php')
        );
    }
}
