<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Mey\Spine\Http\Middleware\TrackLastPresence;

Route::middleware(TrackLastPresence::class)->group(function (): void {
    Route::get('/', Controllers\HomeController::class)->name('home');
});
