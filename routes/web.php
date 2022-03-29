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

Route::get('/', function () {
    return view('home');
});

Route::get('/load', function () {
    return view('loader');
});

Route::post('/load', [MainController::class, 'loadFile'])->name('load_file');

Route::get('/wordbooks', [MainController::class, 'showWordBooks']);

Route::get('/translated/{id}', [MainController::class, 'showBooks'])->name('show_books');
Route::get('/clear-books', [MainController::class, 'clearBooks']);
