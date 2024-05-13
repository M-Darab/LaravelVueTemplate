<?php

use App\Http\Controllers\Admin\{AuthController, DashboardController};
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->middleware(['guest:admin'])->group(function () {
    Route::get('login', 'showLogin')->name('login');
    Route::post('login', 'postLogin')->name('login');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
    });
});
