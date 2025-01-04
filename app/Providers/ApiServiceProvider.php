<?php

namespace App\Providers;

use App\Interfaces\Repositories\MainHeadlineRepositoryInterface;
use App\Interfaces\Repositories\NewsletterRepositoryInterface;
use App\Repositories\MainHeadlineRepository;
use App\Repositories\NewsletterRepository;
use App\Service\MainHeadline\MainHeadlineService;
use App\Service\Newsletter\NewsletterService;
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
        $this->app->bind(NewsletterRepositoryInterface::class, NewsletterRepository::class);
        $this->app->singleton(NewsletterService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
