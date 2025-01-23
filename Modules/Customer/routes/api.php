<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\v1\CustomerController;

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

    Route::get("/customer/media/image/{id}", [CustomerController::class, "getImage"]);

    /**
     * Admin panel routes
     */
    Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
        Route::apiResource('customers', CustomerController::class);
        Route::get('/customers/change-order/{id}/{substituteId}', [CustomerController::class, 'changeOrder'])->name('customers.order');
    });
});
