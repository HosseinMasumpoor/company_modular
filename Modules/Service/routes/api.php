<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\v1\ServiceController;

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

    Route::get("/service/media/icon/{id}", [ServiceController::class, "getIcon"]);
    Route::get("/service/media/image/{id}", [ServiceController::class, "getImage"]);

    /**
     * Admin panel routes
     */
    Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
        Route::apiResource('services', ServiceController::class)->names('service');
        Route::get('/services/change-order/{id}/{substitute}', [ServiceController::class, 'changeOrder'])->name('services.order');
    });
});
