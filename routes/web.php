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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/surveys', [SurveyController::class, 'index'])->middleware(['auth'])->name('surveys');
Route::get('/create', [SurveyController::class, 'create'])->middleware(['auth'])->name('surveys.create');
Route::post('/create', [SurveyController::class, 'store'])->middleware(['auth'])->name('surveys.store');
Route::delete('/delete', [SurveyController::class, 'destroy'])->middleware(['auth'])->name('surveys.delete');
Route::get('/edit/{id}', [SurveyController::class, 'edit'])->middleware(['auth'])->name('surveys.edit');
Route::post('/edit/{id}', [SurveyController::class, 'update'])->middleware(['auth'])->name('surveys.update');
Route::get('/results/{survey}', [SurveyController::class, 'results'])->middleware(['auth'])->name('surveys.results');
Route::get('/survey/vote/{survey}', [SurveyController::class, 'share'])->name('survey.share');
Route::post('/survey/vote/{survey}', [SurveyController::class, 'vote'])->name('survey.vote');


require __DIR__.'/auth.php';
