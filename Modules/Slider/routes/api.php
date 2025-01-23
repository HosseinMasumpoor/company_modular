<?php

use Illuminate\Support\Facades\Route;
use Modules\Slider\Http\Controllers\v1\SliderController;

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
    Route::prefix('admin')->group(function () {
        Route::prefix('/sliders')->name('sliders.')->group(function () {
            Route::get('/', [SliderController::class, 'index'])->name('index');
            Route::prefix('/{slider}/slides')->name('slides.')->group(function () {
                Route::get('/', [SliderController::class, 'manageSlides'])->name('index');
                Route::post('/', [SliderController::class, 'storeSlide'])->name('store');

                Route::put('/{slide}', [SliderController::class, 'updateSlide'])->name('update');
            });
            Route::delete('/slides/{slide}/{type}', [SliderController::class, 'deleteSlide'])->name('slides.destroy');
            Route::put('/slides/{slide}/{type}', [SliderController::class, 'updateSlide'])->name('slides.update');
            Route::get('/slides/{slideId}/order/{subtitudeId}/{type}', [SliderController::class, 'changeSlideOrder'])->name('slides.order');
        });
    });
});
