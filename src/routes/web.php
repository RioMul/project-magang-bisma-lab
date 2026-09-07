<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\OrderWizardController;
use App\Http\Controllers\ProfileController;
use App\Models\Order;
use App\Http\Controllers\Client\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Home & Detail
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/template/{slug}', [LandingController::class, 'templateDetail'])->name('template.detail');

// Order Wizard
Route::prefix('order')->name('order.')->group(function () {
    Route::get('/template', [OrderWizardController::class, 'template'])->name('template');
    Route::post('/template', [OrderWizardController::class, 'storeTemplate'])->name('template.store');

    Route::get('/domain', [OrderWizardController::class, 'searchDomain'])->name('domain');
    Route::post('/domain', [OrderWizardController::class, 'storeDomain'])->name('domain.store');

    Route::get('/package', [OrderWizardController::class, 'selectPackage'])->name('package');
    Route::post('/package', [OrderWizardController::class, 'storePackage'])->name('package.store');

    // ALUR CHECKOUT CERDAS
    Route::get('/checkout', [OrderWizardController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/payment-method', [OrderWizardController::class, 'savePaymentMethod'])->name('checkout.payment_method');
    Route::post('/checkout/reset-payment', [OrderWizardController::class, 'resetPaymentMethod'])->name('checkout.reset_payment');
    
    // Auth Checkout
    Route::post('/checkout/login', [OrderWizardController::class, 'processCheckLogin'])->name('check_login.process');
    Route::post('/checkout/register', [OrderWizardController::class, 'processCheckRegister'])->name('check_register.process');

    // Finalize
    Route::post('/checkout/finalize', [OrderWizardController::class, 'finalizeOrder'])->name('checkout.finalize');

    // Invoice
    Route::get('/invoice/{order:order_number}', [OrderWizardController::class, 'invoice'])->middleware('auth')->name('invoice');
});

//Dashboard Client Area Percobaan
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});

// Dashboard Client Area
//Route::middleware(['auth', 'verified'])->group(function () {
    //Route::get('/dashboard', function () {
        //$orders = Order::where('user_id', Auth::id())
            //->with(['template', 'package', 'website'])
           // ->latest()
           // ->get();
      //  return view('dashboard', compact('orders'));
   // })->name('dashboard');
//});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';