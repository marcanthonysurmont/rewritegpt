<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewHomeController;
use App\Http\Controllers\StoreAPIKeyController;
use App\Http\Controllers\StorePromptController;

Route::get('/', ViewHomeController::class)->name('home');
Route::post('/information/apikey', StoreAPIKeyController::class)->name('store.apikey');
Route::post('/information/prompt', StorePromptController::class)->name('store.prompt');
