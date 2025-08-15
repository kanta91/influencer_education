<?php

use App\Http\Controllers\Admin\TopController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('show.login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/top', [TopController::class, 'showTop'])->name('show.top');
        Route::get('/curriculum_list', [CurriculumController::class, 'showCurriculumList'])->name('show.curriculum.list');
        Route::get('/article_list', [ArticleController::class, 'showArticleList'])->name('show.article.list');
        Route::get('/banner_edit', [BannerController::class, 'showBannerEdit'])->name('show.banner.edit');
    });
});
