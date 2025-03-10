<?php

namespace App\Providers;

use App\ViewComposer\CategoryViewComposer;
use App\ViewComposer\NewsletterSourceViewComposer;
use App\ViewComposer\PlacementViewComposer;
use App\ViewComposer\PostStatusViewComposer;
use App\ViewComposer\SiteSettingViewComposer;
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
        View::composer([
            'admin.posts.modals.post-status-modal',
            'author.posts.modals.post-status-modal',
        ], PostStatusViewComposer::class);

        View::composer([
            'admin.layouts.app',
            "admin.layouts.aside"
        ], SiteSettingViewComposer::class);

        View::composer([
            "admin.ads.create",
        ], PlacementViewComposer::class);

        View::composer([
            "admin.ads.create",
        ], AdTypeViewComposer::class);
    }
}
