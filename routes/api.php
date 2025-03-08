<?php

use App\Http\Controllers\Api\V1\CategoryApiController;
use App\Http\Controllers\Api\V1\MainHeadlineApiController;
use App\Http\Controllers\Api\V1\NewsletterApiController;
use App\Http\Controllers\Api\V1\NewsletterFeaturedApiController;
use App\Http\Controllers\Api\V1\NewsletterLastMinuteApiController;
use App\Http\Controllers\Api\V1\NewsletterTodayHeadlineApiController;
use App\Http\Controllers\Api\V1\SettingApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix("v2")->group(function () {
    Route::prefix("categories")->group(function () {
        Route::get("home-categories", [\App\Http\Controllers\Api\V2\Categories\CategoryController::class, "getHomeCategories"]);
        Route::get("/{category_slug}/outstandings", [\App\Http\Controllers\Api\V2\Categories\CategoryController::class, "getSlugByOutstandings"]);
    });
    Route::get('/main-headline', [MainHeadlineApiController::class, 'index']);
    Route::get("/newsletter-five-cuff", [App\Http\Controllers\Api\V2\Newsletters\NewsletterFiveCuffController::class, 'index']);
    Route::get("/last-newsletters", [App\Http\Controllers\Api\V2\Newsletters\LastNewsletterController::class, 'index']);
    Route::get("/today-headlines", [App\Http\Controllers\Api\V2\Newsletters\NewsletterTodayHeadlineController::class, 'index']);
    Route::prefix("politic-newsletters")->group(function () {
        Route::get("out-standings/", [App\Http\Controllers\Api\V2\Categories\PoliticNewsletterController::class, 'getPoliticNewslettersWithOutstanding']);
        Route::get("today-headlines/", [App\Http\Controllers\Api\V2\Categories\PoliticNewsletterController::class, 'getPoliticNewslettersWithTodayHeadlines']);
        Route::get("main-headlines/", [App\Http\Controllers\Api\V2\Categories\PoliticNewsletterController::class, 'getPoliticNewslettersWithMainHeadlines']);
    });
//     Route::get("sport-newsletters")
    Route::get("last-minutes", [\App\Http\Controllers\Api\V2\Newsletters\LastMinuteController::class, 'index']);
    Route::get("newsletter-outstandings", [\App\Http\Controllers\Api\V2\Newsletters\NewsletterOutstandingController::class, 'index']);

    Route::prefix("photo-galleries")->group(function () {
        Route::get("/", [\App\Http\Controllers\Api\V2\Galleries\PhotoGalleryController::class, "index"]);
    });

    Route::prefix("setting")->as("setting.")->group(function () {
        Route::get("general-setting", [SettingApiController::class, 'generalSetting'])->name("general-setting");
        Route::get("contact-setting", [SettingApiController::class, 'contactSetting'])->name("contact-setting");
        Route::get("social-media-setting", [SettingApiController::class, 'socialMediaSetting'])->name("social-media-setting");
    });
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
