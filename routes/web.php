<?php

use App\Http\Controllers\User\NoticeController;
use Illuminate\Support\Facades\Route;

Route::get('/notice/{id}', [NoticeController::class, 'show'])->name('notice.show');

