<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\User\ProgressController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\PasswordController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 管理者用ルート
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/notice', [NoticeController::class, 'index'])->name('notice.index');
    Route::get('/notice/create', [NoticeController::class, 'create'])->name('notice.create');
    Route::post('/notice', [NoticeController::class, 'store'])->name('notice.store');
    Route::get('/notice/{id}/edit', [NoticeController::class, 'edit'])->name('notice.edit');
    Route::put('/notice/{id}', [NoticeController::class, 'update'])->name('notice.update');
    Route::delete('/notice/{id}', [NoticeController::class, 'destroy'])->name('notice.destroy');
});

// ユーザー用ルート
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/progress', [ProgressController::class, 'showProgress'])->name('progress');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/password', [PasswordController::class, 'edit'])->name('password.edit');
Route::post('/password', [PasswordController::class, 'update'])->name('password.update');
});
