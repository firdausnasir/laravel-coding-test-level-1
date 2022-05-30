<?php

use App\Http\Controllers\Api\v1\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'events'], function () {
        Route::get('/', [EventController::class, 'index']);
        Route::get('/{id}', [EventController::class, 'show']);
        Route::post('/', [EventController::class, 'store']);
        Route::match(['put', 'patch'], '/{id}', [EventController::class, 'update']);
        Route::delete('/{id}', [EventController::class, 'destroy']);
        Route::get('active-events', [EventController::class, 'active']);
    });
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
