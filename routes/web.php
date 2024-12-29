<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/test', [\App\Http\Controllers\TestController::class, 'index']);
/* $main_headlines = \App\Models\MainHeadline::query()
        ->with(['headlineable' => function (\Illuminate\Database\Eloquent\Relations\MorphTo $morphTo) {
            $morphTo->constrain([
                \App\Models\Newsletter::class => function ($qu) {
                $qu->with([
                    'category',
                    'images' => function ($q) {
                        $q->where('image_type', \App\Enum\MorphImage\MorphImageImageTypeEnum::COVER);
                    }
                ]);
                },
                \App\Models\Ads::class => function ($qu) {
                    $qu->where('is_active', \App\Enum\Ads\AdsIsActiveEnum::ACTIVE);
                    $qu->with('image');
                }
            ]);
        }])
        ->limit(10)
        ->orderBy('order')
        ->get();*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::post('image-upload', [ImageController::class, 'upload'])
    ->middleware(['auth'])
    ->name('image-upload');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
