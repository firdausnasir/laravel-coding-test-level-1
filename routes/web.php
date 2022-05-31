<?php

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

Route::post('/events/{id}/undelete', [\App\Http\Controllers\EventController::class, 'undelete'])->name('events.undelete');
Route::resource('/events', \App\Http\Controllers\EventController::class);

Route::get('fetch', \App\Http\Controllers\ExternalApiController::class)->name('fetch.external-api');

require __DIR__.'/auth.php';
