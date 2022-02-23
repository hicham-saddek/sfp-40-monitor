<?php

use App\Http\Controllers\ChannelsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\VariablesController;
use App\Http\Controllers\VisualisationsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ PagesController::class, 'welcome' ])->name('home');

Route::prefix('')->group(function () {
    Route::get('/dashboard', [ PagesController::class, 'dashboard' ])->name('dashboard');
    Route::get('history', [ VisualisationsController::class, 'historyIndex' ])->name('history');
    Route::get('realtime', [ VisualisationsController::class, 'realtimeIndex' ])->name('realtime');
    Route::name('channels.')->prefix('channels')->group(function () {
        Route::get('/', [ ChannelsController::class, 'index' ])->name('index');
        Route::post('/', [ ChannelsController::class, 'store' ])->name('store');
        Route::get('/create', [ ChannelsController::class, 'create' ])->name('create');
        Route::prefix('{channel}')->group(function () {
            Route::get('/', [ ChannelsController::class, 'show' ])->name('show');
            Route::post('/', [ ChannelsController::class, 'update' ])->name('update');
            Route::delete('/', [ ChannelsController::class, 'destroy' ])->name('delete');
            Route::get('/edit', [ ChannelsController::class, 'edit' ])->name('edit');
            Route::patch('/toggleMonitoring', [ ChannelsController::class, 'toggleMonitoring' ])->name('toggleMonitoring');
            Route::name('variables.')->prefix('variables')->group(function () {
                Route::get('/all', [ ChannelsController::class, 'fetchAll' ])->name('all-variables');
                Route::get('/watched', [ ChannelsController::class, 'watched' ])->name('watched');
                Route::get('/unwatched', [ ChannelsController::class, 'unwatched' ])->name('unwatched');
                Route::get('/', [ VariablesController::class, 'index' ])->name('index');
                Route::post('/', [ VariablesController::class, 'store' ])->name('store');
                Route::get('/create', [ VariablesController::class, 'create' ])->name('create');
                Route::get('/{variable}', [ VariablesController::class, 'show' ])->name('show');
                Route::patch('/{variable}', [ VariablesController::class, 'update' ])->name('update');
                Route::delete('/{variable}', [ VariablesController::class, 'destroy' ])->name('delete');
                Route::get('/{variable}/edit', [ VariablesController::class, 'edit' ])->name('edit');
                Route::post('/{variable}/toggleWatch', [ VariablesController::class, 'toggleWatch' ])->name('toggleWatch');
                Route::name('data.')->prefix('{variable}/data')->group(function () {
                    Route::get('fetchHistory', [ VisualisationsController::class, 'history' ])->name('fetchHistory');
                    Route::get('fetchRealtime', [ VisualisationsController::class, 'realtime' ])->name('fetchRealtime');
                });
            });
        });
    });
});
