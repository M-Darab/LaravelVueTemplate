<?php

use App\Http\Controllers\Admin\{AuthController, DashboardController, UserController};
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->middleware(['guest:admin'])->group(function () {
    Route::get('login', 'showLogin')->name('login');
    Route::post('login', 'postLogin');
});

Route::middleware(['auth:admin'])->group(function () {

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    
    Route::controller(UserController::class)->name('users.')->prefix('users')->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('create', 'create')->name('create');
    });
});
