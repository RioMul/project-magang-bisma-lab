<?php

use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\WebsiteController;
use App\Http\Controllers\Client\PageController;
use App\Http\Controllers\Client\StatisticController;
use App\Http\Controllers\Client\BillingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('client')->name('client.')->group(function () {
        // Website Editor
        Route::get('/website/edit', [WebsiteController::class, 'edit'])->name('website.edit');
        Route::put('/website', [WebsiteController::class, 'update'])->name('website.update');

        // Pages Management
        Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('/pages/{id}/edit', [PageController::class, 'edit'])->name('pages.edit');
        
        // Route::get('/statistics', [StatisticController::class, 'index'])->name('statistics.index');
        // Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');
    });
});