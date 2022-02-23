<?php

use App\Http\Controllers\ChannelsController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\VariablesController;
use App\Http\Controllers\VisualisationsController;
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
                Route::post('/{variable}/toggleWatch', [ VariablesController::class, 'toggleWatch' ])->name('apiToggleWatch');
                Route::prefix('/{variable}/data')->group(function (){
                    Route::get('fetchHistory', [VisualisationsController::class, 'history'])->name('apiFetchHistory');
                });
            });
        });
    });
});
