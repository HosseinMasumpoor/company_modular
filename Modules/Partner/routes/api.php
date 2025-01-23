<?php

use Illuminate\Support\Facades\Route;
use Modules\Partner\Http\Controllers\v1\PartnerController;

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

    Route::get("/service/media/image/{id}", [PartnerController::class, "getImage"]);

    /**
     * Admin panel routes
     */
    Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
        Route::apiResource('partners', PartnerController::class);
        Route::get('/partners/change-order/{id}/{substituteId}', [PartnerController::class, 'changeOrder'])->name('partners.order');
    });
});
