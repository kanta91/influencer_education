<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\PasswordController;
// use App\Http\Controllers\User\ProgressController; ← いったん不要

Route::get('/user/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
Route::post('/user/profile', [ProfileController::class, 'update'])->name('user.profile.update');

Route::get('/user/password', [PasswordController::class, 'edit'])->name('user.password.edit');
Route::put('/user/password', [PasswordController::class, 'update'])->name('user.password.update');

// ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
// ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
// これを削除 or コメントアウトするだけでOK
// Route::get('/user/progress', [ProgressController::class, 'showProgress'])->name('user.progress');
