<?php

use App\Http\Controllers;
use App\Http\Middleware;
use Illuminate\Support\Facades\Route;

Route::middleware(Middleware\TrackLastPresence::class)->group(function (): void {
    Route::get('/', Controllers\HomeController::class)->name('home');
});
