<?php

namespace App\Providers;

use App\Interfaces\Repositories\MainHeadlineRepositoryInterface;
use App\Repositories\MainHeadlineRepository;
use App\Service\MainHeadline\MainHeadlineService;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MainHeadlineRepositoryInterface::class, MainHeadlineRepository::class);
        $this->app->singleton(MainHeadlineService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
