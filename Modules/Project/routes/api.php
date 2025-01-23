<?php

use Illuminate\Support\Facades\Route;
use Modules\Project\Http\Controllers\v1\ProjectController;
use Modules\Project\Http\Controllers\v1\ProjectFeatureController;
use Modules\Project\Http\Controllers\v1\ProjectImageController;

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

    Route::get('/project/media/gallery/image/{id}', [ProjectImageController::class, 'getImage']);
    Route::get('/project/media/image/{id}', [ProjectController::class, 'getImage']);
    Route::get('/project/media/presentation/{id}', [ProjectController::class, 'getPresentationFile']);

    /**
     * Admin panel routes
     */
    Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
        Route::apiResource('projects', ProjectController::class)->names('project');

        Route::prefix('projects')->name('projects.')->group(function () {

        //Gallery
        Route::get('/{id}/gallery', [ProjectImageController::class, 'index'])->name('gallery');
        Route::post('/{id}/gallery', [ProjectImageController::class, 'store'])->name('gallery.store');
        Route::delete('/gallery/{projectImage}', [ProjectImageController::class, 'destroy'])->name('gallery.destroy');
        Route::get('/gallery/order/{imageId}/{substituteId}', [ProjectImageController::class, 'order'])->name('gallery.order');

        //features
        Route::apiResource('/features', ProjectFeatureController::class)->only(['index', 'store', 'destroy']);
        Route::get('{projectId}/features', [ProjectFeatureController::class, 'index'])->name('features.index');
        Route::post('{projectId}/features', [ProjectFeatureController::class, 'store'])->name('features.store');
        Route::delete('/features/{id}', [ProjectFeatureController::class, 'delete'])->name('features.delete');
        Route::get('/features/order/{featureId}/{substituteId}', [ProjectFeatureController::class, 'order'])->name('features.order');

        });

    });
});
