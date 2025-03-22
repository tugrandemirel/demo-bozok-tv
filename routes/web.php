<?php

use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\CommentController;
use App\Http\Controllers\Front\NewsletterController;
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
Route::as("front.")->group(function () {
    Route::get("/", [\App\Http\Controllers\Front\HomeController::class, 'index'])->name("index");
    Route::prefix('{category_slug}')->as("category.")->group(function () {
        Route::get('/', [CategoryController::class, 'show'])->name('show');
        Route::as("newsletter.")->group(function () {
            Route::get('/{newsletter_slug}', [NewsletterController::class, 'show'])->name('show');
            Route::prefix("comment")->as("comment.")->group(function () {
                Route::post('/fetch', [CommentController::class, 'index'])->name('index');
                Route::post('/', [CommentController::class, 'store'])->name('store');
//                Route::post('/{comment_id}/like', [\App\Http\Controllers\Front\CommentController::class, 'like'])->name('like');
//                Route::post('/{comment_id}/dislike', [\App\Http\Controllers\Front\CommentController::class, 'dislike'])->name('dislike');
            });
        });
    });
});
