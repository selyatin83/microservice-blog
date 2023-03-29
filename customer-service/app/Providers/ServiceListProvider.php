<?php

namespace App\Providers;

use App\Interfaces\Services\AuthenticationServiceInterface;
use App\Services\AuthenticationService;
use Illuminate\Support\ServiceProvider;

/**
 * @author <Mikhail Selyatin>
 */
class ServiceListProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthenticationServiceInterface::class, AuthenticationService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
