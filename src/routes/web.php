<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\OrderWizardController;
use App\Http\Controllers\ProfileController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::prefix('order')->name('order.')->group(function () {
    Route::get('/template', [OrderWizardController::class, 'template'])->name('template');
    Route::post('/template', [OrderWizardController::class, 'postTemplate'])->name('template.post');

    Route::get('/domain', [OrderWizardController::class, 'domain'])->name('domain');
    Route::post('/domain', [OrderWizardController::class, 'postDomain'])->name('domain.post');

    Route::get('/paket', [OrderWizardController::class, 'package'])->name('package');
    Route::post('/paket', [OrderWizardController::class, 'postPackage'])->name('package.post');

    Route::get('/checkout', [OrderWizardController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/process', [OrderWizardController::class, 'processOrder'])->name('process');
});

Route::get('/dashboard', function () {
    $orders = Order::with(['template', 'serverPackage'])
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('dashboard', compact('orders'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';