<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CurriculumController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/curriculum_list/{gradeId?}', [CurriculumController::class, 'showCurriculumList'])->name('show.curriculum.list');
    Route::get('/curriculum_create', [CurriculumController::class, 'showCurriculumCreate'])->name('show.curriculum.create');
    Route::get('/curriculum_edit/{id}', [CurriculumController::class, 'showCurriculumEdit'])->name('show.curriculum.edit');
    Route::get('/delivery_edit/{id}', [DeliveryController::class, 'showDeliveryEdit'])->name('show.delivery.edit');
    Route::get('/ajax/curriculums/{gradeId}', [CurriculumController::class, 'getCurriculumsByGradeAjax']);
});