<?php

use Illuminate\Support\Facades\Route;
use Modules\ContactUs\Http\Controllers\v1\ContactController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::prefix('v1')->group(function () {
    Route::prefix('admin')->middleware('auth:admin')->group(function () {
        Route::get('/contact-us', [ContactController::class, 'index']);
        Route::get('/contact-us/{id}', [ContactController::class, 'show']);
    });

    Route::post('/contact-us', [ContactController::class, 'store']);
});

