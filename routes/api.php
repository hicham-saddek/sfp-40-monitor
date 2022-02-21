<?php

use App\Http\Controllers\ChannelsController;
use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::name('channels.')->prefix('channels')->group(function () {
        Route::get('/configurations/{channel:slug}', [ ChannelsController::class, 'configs' ])->name('configs');
        Route::prefix('/{channel}')->group(function () {
            Route::get('/', [ ChannelsController::class, 'show' ])->name('show');
            Route::name('variables.')->prefix('variables')->group(function () {
                Route::get('/watched', [ ChannelsController::class, 'watched' ])->name('watched');
                Route::get('/unwatched', [ ChannelsController::class, 'unwatched' ])->name('unwatched');
                Route::post('/{variable}/data', [ DataController::class, 'store' ])->name('data.store');
            });
        });
    });
});
