<?php

namespace App\Providers;

use App\Models\MainHeadline;
use App\Observers\MainHeadlineObserve;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        MainHeadline::observe(MainHeadlineObserve::class);
    }
}
