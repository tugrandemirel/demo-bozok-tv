<?php

use App\Http\Controllers\Api\V1\CategoryApiController;
use App\Http\Controllers\Api\V1\MainHeadlineApiController;
use App\Http\Controllers\Api\V1\NewsletterApiController;
use App\Http\Controllers\Api\V1\NewsletterFeaturedApiController;
use App\Http\Controllers\Api\V1\NewsletterLastMinuteApiController;
use App\Http\Controllers\Api\V1\NewsletterTodayHeadlineApiController;
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


    Route::prefix("v1")->group(function (){
        Route::get('main-headline', [MainHeadlineApiController::class, 'index']);
        Route::get('categories', [CategoryApiController::class, 'index']);
        Route::get('categories/{slug}', [CategoryApiController::class, 'show']);
        Route::get('categories/{slug}/related-news', [CategoryApiController::class, 'relatedNewsletters']);
        Route::get('category-newsletters/{slug}', [CategoryApiController::class, 'getCategoryNewsletters']);
        Route::get('last-minutes', [NewsletterLastMinuteApiController::class, 'index']);
        Route::get("featured-news", [NewsletterFeaturedApiController::class, 'index']);
        Route::get("today-headline-news", [NewsletterTodayHeadlineApiController::class, 'index']);
        Route::get("newsletter/{slug}", [NewsletterApiController::class, 'show']);
    }) ;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
