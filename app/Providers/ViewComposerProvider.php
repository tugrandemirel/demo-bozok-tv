<?php

namespace App\Providers;

use App\ViewComposer\CategoryViewComposer;
use App\ViewComposer\NewsletterSourceViewComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerProvider extends ServiceProvider
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
        View::composer([
            'admin.newsletter.edit.edit',
            'admin.newsletter.create.create',
        ], CategoryViewComposer::class);

        View::composer([
            'admin.newsletter.edit.edit',
            'admin.newsletter.create.create',
        ], NewsletterSourceViewComposer::class);
    }
}
