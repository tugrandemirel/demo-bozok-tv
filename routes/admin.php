<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\Newsleter\NewsletterTagController;
use App\Http\Controllers\Admin\Newsletter\NewsletterCategoryController;
use App\Http\Controllers\Admin\Newsletter\NewsletterController;
use App\Http\Controllers\Admin\Newsletter\NewsletterNewsletterSourceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Super-Admin ve Admin Routes
|--------------------------------------------------------------------------
|
| Burada super-admin ve admin kullanıcıları için tanımlanan route'lar yer alır.
| Bu route'lar sadece super-admin ve admin yetkisine sahip kullanıcılar tarafından erişilebilir.
|
*/

Route::middleware(['auth'])->prefix('dashboard')->as('admin.')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');

    Route::prefix('newsletters')->as('newsletters.')->group(function () {
        Route::any('/', [NewsletterController::class, 'index'])->name('index');
        Route::get('/create', [NewsletterController::class, 'create'])->name('create');
        Route::post('/store', [NewsletterController::class, 'store'])->name('store');
        Route::get('/show/{newsletter_uuid}', [NewsletterController::class, 'show'])->name('show');
        Route::get('/edit/{newsletter_uuid}', [NewsletterController::class, 'edit'])->name('edit');
        Route::post('/update/', [NewsletterController::class, 'update'])->name('update');

        Route::prefix('category')->as('category.')->group(function () {
            Route::get('/index', [NewsletterCategoryController::class, 'index'])->name('index');
            Route::post('store', [NewsletterCategoryController::class, 'store'])->name('store');
        });

        Route::prefix('publication-status')->as('publication-status.')->group(function () {
            Route::post('/change-status', [NewsletterController::class, 'changePublicationStatus'])->name('changePublicationStatus');
        });

        Route::prefix('newsletter-source')->as('newsletter-source.')->group(function () {
            Route::get('/index', [NewsletterNewsletterSourceController::class, 'index'])->name('index');
            Route::post('store', [NewsletterNewsletterSourceController::class, 'store'])->name('store');
        });

        Route::prefix('tags')->as('tag.')->group(function () {
            Route::get('/index', [NewsletterTagController::class, 'index'])->name('index');
            Route::post('store', [NewsletterTagController::class, 'store'])->name('store');
        });
    });
});
