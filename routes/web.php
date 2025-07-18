<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NoticeController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/notice', [NoticeController::class, 'index'])->name('notice.index');
    Route::get('/notice/create', [NoticeController::class, 'create'])->name('notice.create');
    Route::post('/notice', [NoticeController::class, 'store'])->name('notice.store');
    Route::get('/notice/{id}/edit', [NoticeController::class, 'edit'])->name('notice.edit');
    Route::put('/notice/{id}', [NoticeController::class, 'update'])->name('notice.update');
    Route::delete('/notice/{id}', [NoticeController::class, 'destroy'])->name('notice.destroy');
});
