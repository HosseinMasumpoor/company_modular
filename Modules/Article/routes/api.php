<?php

use Illuminate\Support\Facades\Route;
use Modules\Article\Http\Controllers\v1\ArticleController;
use Modules\Article\Http\Controllers\v1\ArticleSliderController;

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

    Route::get("/article/media/image/{id}", [ArticleController::class, "getIcon"]);
    Route::get("/article/media/thumbnail/{id}", [ArticleController::class, "getThumbnail"]);

    /**
     * Admin panel routes
     */
    Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
        Route::apiResource('articles', ArticleController::class)->names('article');

        Route::prefix('/articles/slider')->name('articles.slider.')->group(function () {
            Route::get('/', [ArticleSliderController::class, 'index'])->name('index');
            Route::post('/', [ArticleSliderController::class, 'store'])->name('store');
            Route::delete('/{slide}', [ArticleSliderController::class, 'destroy'])->name('delete');
            Route::get('/{id}/order/{substitute}', [ArticleSliderController::class, 'changeOrder'])->name('order');
        });
    });
});
