<?php

use App\Http\Controllers\Api\V1\CategoryApiController;
use App\Http\Controllers\Api\V1\MainHeadlineApiController;
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
        Route::apiResource('main-headline', MainHeadlineApiController::class);
        Route::apiResource('categories', CategoryApiController::class);
    }) ;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
