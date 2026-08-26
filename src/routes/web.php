<?php

use App\Models\Order;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\OrderWizardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Berikan nama 'landing' dan 'home' agar kompatibel dengan seluruh view
Route::get('/', [LandingController::class, 'index'])->name('home');

// Order Wizard Routes
Route::prefix('order')->name('order.')->group(function () {
    Route::get('/template', [OrderWizardController::class, 'template'])->name('template');
    Route::post('/template', [OrderWizardController::class, 'storeTemplate'])->name('template.store');

    Route::get('/domain', [OrderWizardController::class, 'searchDomain'])->name('domain');
    Route::post('/domain', [OrderWizardController::class, 'storeDomain'])->name('domain.store');

    Route::get('/package', [OrderWizardController::class, 'selectPackage'])->name('package');
    Route::post('/package', [OrderWizardController::class, 'storePackage'])->name('package.store');

    Route::get('/checkout', [OrderWizardController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderWizardController::class, 'processCheckout'])->name('checkout.process');

    Route::get('/check-register', [OrderWizardController::class, 'checkRegister'])->name('check_register');
    Route::post('/check-register', [OrderWizardController::class, 'processCheckRegister'])->name('check_register.process');
    Route::post('/check-login', [OrderWizardController::class, 'processCheckLogin'])->name('check_login.process');
});

// Route terpisah untuk tombol POST dari landing page
Route::post('/order/template-post', [OrderController::class, 'storeTemplate'])->name('order.template.post');

// Halaman Dashboard (Digabung & Mengirim data $orders untuk mencegah error)
Route::get('/dashboard', function () {
    $orders = Order::where('user_id', Auth::id())->with(['template', 'package'])->latest()->get();

    return view('dashboard', compact('orders'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';