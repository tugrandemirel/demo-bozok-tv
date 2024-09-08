<?php

use App\Http\Controllers\Admin\IndexController;
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
});
