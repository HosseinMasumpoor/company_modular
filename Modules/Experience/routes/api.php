<?php

use Illuminate\Support\Facades\Route;
use Modules\Experience\Http\Controllers\v1\ExperienceController;

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

    Route::get('/experience/media/image/{id}', [ExperienceController::class, 'getImage']);

    /**
     * Admin panel routes
     */
    Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
        Route::resource('experiences', ExperienceController::class)->names('experience');
    });
});
