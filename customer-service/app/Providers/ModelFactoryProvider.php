<?php

namespace App\Providers;

use App\Factories\Models\UserFactory;
use App\Interfaces\Factories\UserFactoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * @author <Mikhail Selyatin>
 */
class ModelFactoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserFactoryInterface::class, UserFactory::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
