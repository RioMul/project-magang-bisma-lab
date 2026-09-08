<?php

use App\Http\Controllers\Order\CheckoutController;
use App\Http\Controllers\Order\InvoiceController;
use App\Http\Controllers\Order\OrderWizardController;
use Illuminate\Support\Facades\Route;

Route::prefix('order')
    ->name('order.')
    ->group(function () {
        Route::get('/template', [
            OrderWizardController::class,
            'template',
        ])->name('template');

        Route::post('/template', [
            OrderWizardController::class,
            'storeTemplate',
        ])->name('template.store');

        Route::get('/domain', [
            OrderWizardController::class,
            'searchDomain',
        ])->name('domain');

        Route::post('/domain', [
            OrderWizardController::class,
            'storeDomain',
        ])->name('domain.store');

        Route::get('/package', [
            OrderWizardController::class,
            'selectPackage',
        ])->name('package');

        Route::post('/package', [
            OrderWizardController::class,
            'storePackage',
        ])->name('package.store');

        Route::get('/checkout', [
            CheckoutController::class,
            'index',
        ])->name('checkout');

        Route::post('/checkout/payment-method', [
            CheckoutController::class,
            'savePaymentMethod',
        ])->name('checkout.payment_method');

        Route::post('/checkout/reset-payment', [
            CheckoutController::class,
            'resetPaymentMethod',
        ])->name('checkout.reset_payment');

        Route::post('/checkout/login', [
            CheckoutController::class,
            'login',
        ])->name('check_login.process');

        Route::post('/checkout/register', [
            CheckoutController::class,
            'register',
        ])->name('check_register.process');

        Route::post('/checkout/finalize', [
            CheckoutController::class,
            'finalize',
        ])->name('checkout.finalize');

        Route::get('/invoice/{order:order_number}', [
            InvoiceController::class,
            'show',
        ])->middleware('auth')->name('invoice');
    });