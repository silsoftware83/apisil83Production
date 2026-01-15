<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Event;
use Src\Configuration\Security\Domain\Events\UserCreated;
use Src\Configuration\Security\Infrastructure\Listeners\SendWelcomeEmail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            UserCreated::class,
            SendWelcomeEmail::class,
        );
    }
}
