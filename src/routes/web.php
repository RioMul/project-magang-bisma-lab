<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\OrderWizardController;
use App\Http\Controllers\ProfileController;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])
    ->name('home');

//ORDER WIZARD

Route::prefix('order')->name('order.')->group(function () {

//TEMPLATE
    Route::get('/template', [OrderWizardController::class, 'template'])
        ->name('template');

    Route::post('/template', [OrderWizardController::class, 'storeTemplate'])
        ->name('template.store');

//DOMAIN
    Route::get('/domain', [OrderWizardController::class, 'searchDomain'])
        ->name('domain');

    Route::post('/domain', [OrderWizardController::class, 'storeDomain'])
        ->name('domain.store');

//PACKAGE
    Route::get('/package', [OrderWizardController::class, 'selectPackage'])
        ->name('package');

    Route::post('/package', [OrderWizardController::class, 'storePackage'])
        ->name('package.store');

//CHECKOUT
    Route::get('/checkout', [OrderWizardController::class, 'checkout'])
        ->name('checkout');

    Route::post('/checkout', [OrderWizardController::class, 'processCheckout'])
        ->name('checkout.process');


//CHECK REGISTER
    Route::get('/check-register', [OrderWizardController::class, 'checkRegister'])
        ->name('check_register');

    Route::post('/check-register/login', [OrderWizardController::class, 'processCheckLogin'])
        ->name('check_login.process');

    Route::post('/check-register/register', [OrderWizardController::class, 'processCheckRegister'])
        ->name('check_register.process');


// INVOICE
    Route::get('/invoice/{order:order_number}', [OrderWizardController::class, 'invoice'])
        ->middleware('auth')
        ->name('invoice');
});

 //DASHBOARD
Route::get('/dashboard', function () {

    $orders = Order::where('user_id', Auth::id())
        ->with([
            'template',
            'serverPackage'
        ])
        ->latest()
        ->get();

    return view('dashboard', compact('orders'));

})->middleware(['auth', 'verified'])
    ->name('dashboard');

 //PROFILE

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


require __DIR__ . '/auth.php';