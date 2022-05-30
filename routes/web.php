<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/{any}', [MainController::class, 'index'])->where('any', '.*');

Route::post('/load-file', [MainController::class, 'loadFile']);
Route::post('/get-wordbooks', [MainController::class, 'showWordBooks']);
Route::post('/get-wordbook/{id}', [MainController::class, 'showBooks']);
Route::post('/save-wordbook/{id}', [MainController::class, 'saveWordbook']);

Route::post('/load', [MainController::class, 'loadFile'])->name('load_file');
Route::post('/clear-books', [MainController::class, 'clearBooks']);

