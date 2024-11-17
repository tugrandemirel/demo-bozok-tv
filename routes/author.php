<?php

use App\Http\Controllers\Author\IndexController;
use App\Http\Controllers\Author\Post\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:Author'])->prefix('dashboard')->as('author.')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');

    Route::prefix('posts')->as('posts.')->group(function (){
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::post('/', [PostController::class, 'index'])->name('post');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::get('/show/{post_uuid}', [PostController::class, 'show'])->name('show');
        Route::get('/edit/{post_uuid}', [PostController::class, 'edit'])->name('edit');
        Route::post('/update', [PostController::class, 'update'])->name('update');
    });
//    Route::resource('posts', PostController::class);
});
