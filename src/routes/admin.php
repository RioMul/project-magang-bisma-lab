<?php

use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])
            ->name('login');

        Route::post('/login', [AuthController::class, 'login'])
            ->name('login.store');
    });

    Route::middleware(['auth', 'admin'])->group(function () {

        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/analytics', [AnalyticsController::class, 'index'])
            ->name('analytics');

        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

        Route::get('/users/{user}', [UserController::class, 'show'])
            ->name('users.show');

        Route::get('/templates', [TemplateController::class, 'index'])
            ->name('templates.index');

        Route::get('/templates/create', [TemplateController::class, 'create'])
            ->name('templates.create');

        Route::post('/templates', [TemplateController::class, 'store'])
            ->name('templates.store');

        Route::get('/templates/{template}/edit', [TemplateController::class, 'edit'])
            ->name('templates.edit');

        Route::put('/templates/{template}', [TemplateController::class, 'update'])
            ->name('templates.update');

        Route::delete('/templates/{template}', [TemplateController::class, 'destroy'])
            ->name('templates.destroy');

        Route::get('/packages', [PackageController::class, 'index'])
            ->name('packages.index');

        Route::get('/packages/create', [PackageController::class, 'create'])
            ->name('packages.create');

        Route::post('/packages', [PackageController::class, 'store'])
            ->name('packages.store');

        Route::get('/packages/{package}/edit', [PackageController::class, 'edit'])
            ->name('packages.edit');

        Route::put('/packages/{package}', [PackageController::class, 'update'])
            ->name('packages.update');

        Route::delete('/packages/{package}', [PackageController::class, 'destroy'])
            ->name('packages.destroy');

        Route::get('/orders', [OrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{order}', [OrderController::class, 'show'])
            ->name('orders.show');

        Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])
            ->name('orders.status');

        Route::get('/billing', [PaymentController::class, 'index'])
            ->name('billing.index');

        Route::patch('/billing/{payment}/status', [PaymentController::class, 'updateStatus'])
            ->name('billing.status');

        Route::get('/websites', [WebsiteController::class, 'index'])
            ->name('websites.index');
    });
});