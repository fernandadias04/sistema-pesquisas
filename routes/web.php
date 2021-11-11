<?php

use App\Http\Controllers\SurveyController;
use App\Models\Survey;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/surveys')->name('home');

Route::middleware(['auth'])
    ->prefix('surveys')
    ->as('surveys.')
    ->group(function () {
        Route::get('/', [SurveyController::class, 'index'])->name('index');
        Route::get('/create', [SurveyController::class, 'create'])->name('create');
        Route::post('/create', [SurveyController::class, 'store'])->name('store');
        Route::delete('/delete', [SurveyController::class, 'destroy'])->name('delete');
        Route::get('/edit/{id}', [SurveyController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [SurveyController::class, 'update'])->name('update');
        Route::get('/results/{survey}', [SurveyController::class, 'results'])->name('results');
    });

Route::get('/surveys/vote/{survey}', [SurveyController::class, 'share'])->name('survey.share');
Route::post('/surveys/vote/{survey}', [SurveyController::class, 'vote'])->name('survey.vote');


require __DIR__.'/auth.php';
