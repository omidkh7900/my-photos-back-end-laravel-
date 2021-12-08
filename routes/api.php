<?php

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

Route::group(['middleware' => ['auth']], function () {
    Route::get('media/{media}/image', \App\Http\Controllers\ImageUrlController::class)->name('media.image');
    Route::get('media/deleted', [\App\Http\Controllers\MediaController::class, 'deleted'])->name('media.deleted');
    Route::apiResource('media', \App\Http\Controllers\MediaController::class);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

