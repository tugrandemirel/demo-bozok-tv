<?php

use App\Http\Controllers\Admin\Ads\AdsController;
use App\Http\Controllers\Admin\Gallery\GalleryController;
use App\Http\Controllers\Admin\Gallery\GalleryImageController;
use App\Http\Controllers\Admin\Gallery\VideoGalleryController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\Newsletter\NewsletterCategoryController;
use App\Http\Controllers\Admin\Newsletter\NewsletterController;
use App\Http\Controllers\Admin\Newsletter\NewsletterFiveCuffController;
use App\Http\Controllers\Admin\Newsletter\NewsletterLastMinuteController;
use App\Http\Controllers\Admin\Newsletter\NewsletterMainHeadlineController;
use App\Http\Controllers\Admin\Newsletter\NewsletterNewsletterSourceController;
use App\Http\Controllers\Admin\Newsletter\NewsletterOutstandingController;
use App\Http\Controllers\Admin\Newsletter\NewsletterTagController;
use App\Http\Controllers\Admin\Newsletter\NewsletterTodayHeadlineController;
use App\Http\Controllers\Admin\Posts\PostController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\SiteSetting\ContactSettingController;
use App\Http\Controllers\Admin\SiteSetting\GeneralSettingController;
use App\Http\Controllers\Admin\SiteSetting\SiteSettingController;
use App\Http\Controllers\Admin\SiteSetting\SocialMediaSettingController;
use App\Http\Controllers\Admin\Surveys\QuestionController;
use App\Http\Controllers\Admin\Surveys\SurveyController;
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

Route::middleware(['auth', 'role:Super-admin|Admin'])->prefix('dashboard')->as('admin.')->group(function () {
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

        Route::prefix('main-headlines')->as('main-headline.')->group(function () {
            Route::get("/", [NewsletterMainHeadlineController::class, 'index'])->name('index');
            Route::post("/update", [NewsletterMainHeadlineController::class, 'update'])->name('update');
        });

        Route::prefix('outstandings')->as('outstandings.')->group(function () {
            Route::any("/", [NewsletterOutstandingController::class, 'index'])->name('index');
//            Route::post("/sort", [NewsletterOutstandingController::class, 'sort'])->name('index');
//            Route::post("/update", [NewsletterMainHeadlineController::class, 'update'])->name('update');
        });

        Route::prefix('top-headlines')->as('top_headlines.')->group(function () {
            Route::any("/", [NewsletterTodayHeadlineController::class, 'index'])->name('index');
        });

        Route::prefix('five-cuffs')->as('five_cuffs.')->group(function () {
            Route::any("/", [NewsletterFiveCuffController::class, 'index'])->name('index');
        });

        Route::prefix('last-minutes')->as('last_minutes.')->group(function () {
            Route::any("/", [NewsletterLastMinuteController::class, 'index'])->name('index');
        });
    });

    Route::prefix('galleries')->as('gallery.')->group(function (){
        Route::get('/', [GalleryController::class, 'index'])->name('index');
        Route::post('/store', [GalleryController::class, 'store'])->name('store');
        Route::get('/edit/{gallery_uuid}', [GalleryController::class, 'edit'])->name('edit');
        Route::post('/update', [GalleryController::class, 'update'])->name('update');
        Route::get('show/{gallery_uuid}', [GalleryController::class, 'show'])->name('show');

        Route::prefix('video')->as('video.')->group(function () {
            Route::post('/store', [VideoGalleryController::class, 'store'])->name('store');
            Route::get('/edit/{video_uuid}', [VideoGalleryController::class, 'edit'])->name('edit');
            Route::post('/update/', [VideoGalleryController::class, 'update'])->name('update');
        });

        Route::prefix('image')->as('image.')->group(function () {
            Route::post('/store', [GalleryImageController::class, 'store'])->name('store');
            Route::get('/edit/{image_uuid}', [GalleryImageController::class, 'edit'])->name('edit');
            Route::post('/update/', [GalleryImageController::class, 'update'])->name('update');
        });
    });

    Route::prefix('posts')->as('posts.')->group(function (){
        Route::any('/', [PostController::class, 'index'])->name('index');
        Route::get('/show/{post_uuid}', [PostController::class, 'show'])->name('show');
        Route::post('/update/', [PostController::class, 'update'])->name('update');
    });

    Route::prefix('surveys')->as('survey.')->group(function (){
        Route::any('/', [SurveyController::class, 'index'])->name('index');
        Route::post('/store', [SurveyController::class, 'store'])->name('store');
        Route::get('/show/{survey_uuid}', [SurveyController::class, 'show'])->name('show');
        Route::get('/edit/{survey_uuid}', [SurveyController::class, 'edit'])->name('edit');
        Route::post('/update', [SurveyController::class, 'update'])->name('update');
        Route::delete('/destroy', [SurveyController::class, 'destroy'])->name('destroy');

        Route::prefix('questions')->as('question.')->group(function (){
            Route::any('/', [QuestionController::class, 'index'])->name('index');
            Route::post('/store', [QuestionController::class, 'store'])->name('store');
            Route::get('/edit/{question_uuid}', [QuestionController::class, 'edit'])->name('edit');
            Route::post('/update', [QuestionController::class, 'update'])->name('update');
            Route::delete('/destroy', [QuestionController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('profile')->as('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('/update', [ProfileController::class, 'update'])->name('update');
        Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('changePassword');
        Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('updatePassword');
    });

    Route::prefix('ads')->as('ads.')->group(function () {
        Route::get('/', [AdsController::class, 'index'])->name('index');
        Route::get('/create', [AdsController::class, 'create'])->name('create');
        Route::post('/store', [AdsController::class, 'store'])->name('store');
    });

    Route::prefix('site-setting')->as('site_setting.')->group(function (){
        Route::get('/index', [SiteSettingController::class, 'index'])->name('index');
        Route::post('/general-setting', [GeneralSettingController::class, 'store'])->name('general-setting-store');
        Route::post('/contact-setting', [ContactSettingController::class, 'store'])->name('contact-setting-store');
        Route::post('/social-media-setting', [SocialMediaSettingController::class, 'store'])->name('social-media-setting');
    });
});
