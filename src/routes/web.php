<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Client\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [
    LandingController::class,
    'index',
])->name('home');

Route::get('/template/{slug}', [
    LandingController::class,
    'templateDetail',
])->name('template.detail');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [
        DashboardController::class,
        'index',
    ])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [
        ProfileController::class,
        'edit',
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update',
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy',
    ])->name('profile.destroy');
});

require __DIR__ . '/order.php';
require __DIR__ . '/auth.php';