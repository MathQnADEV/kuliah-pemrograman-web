<?php

use App\Http\Controllers\admin\AdoptionPetAdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\PetHotelAdminController;
use App\Http\Controllers\admin\UserAdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\User\AdoptionController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\PetHotelController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

Route::fallback([HomeController::class, 'notFound']);

// public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pet-hotel', [HomeController::class, 'petHotelPublic'])->name('pet-hotel.public');
Route::get('/adopsi/{id}', [HomeController::class, 'petDetailPublic'])->name('adoption.public.detail');
Route::get('/adopsi', [HomeController::class, 'adoptionPublic'])->name('adoption.public');

// Auth routes
Route::middleware('guest')->group(function () {
    // Login routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Google OAuth routes
    Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'auth.admin'])->group(function () {

    // Protected admin routes
    Route::middleware(['auth', 'auth.admin'])->group(function () {
        Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
    });

    Route::prefix('pet-hotel')->name('pet-hotel.')->group(function () {
        Route::get('/', [PetHotelAdminController::class, 'index'])->name('index');
        Route::get('/create', [PetHotelAdminController::class, 'create'])->name('create');
        Route::post('/', [PetHotelAdminController::class, 'store'])->name('store');
        Route::get('/{id}', [PetHotelAdminController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [PetHotelAdminController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PetHotelAdminController::class, 'update'])->name('update');
        Route::delete('/{id}', [PetHotelAdminController::class, 'destroy'])->name('destroy');

        // AJAX routes
        Route::post('/{id}/update-status', [PetHotelAdminController::class, 'updateStatus'])->name('update-status');
        Route::post('/{id}/update-payment-status', [PetHotelAdminController::class, 'updatePaymentStatus'])->name('update-payment-status');
        Route::post('/{id}/upload-payment-proof', [PetHotelAdminController::class, 'uploadPaymentProof'])->name('upload-payment-proof');
    });

    // Adoption Pets Routes
    Route::prefix('adoption-pets')->name('adoption-pets.')->group(function () {
        Route::get('/', [AdoptionPetAdminController::class, 'index'])->name('index');
        Route::get('/create', [AdoptionPetAdminController::class, 'create'])->name('create');
        Route::post('/', [AdoptionPetAdminController::class, 'store'])->name('store');
        Route::get('/{id}', [AdoptionPetAdminController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdoptionPetAdminController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdoptionPetAdminController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdoptionPetAdminController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/update-status', [AdoptionPetAdminController::class, 'updateStatus'])->name('update-status');
        Route::delete('/{id}/remove-image', [AdoptionPetAdminController::class, 'removeImage'])->name('remove-image');
    });

        // User Admin Routes
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('', [UserAdminController::class, 'index'])->name('index');
            Route::delete('/{user}', [UserAdminController::class, 'destroy'])->name('destroy');
        });
});

// Protected routes - User Dashboard
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [SocialiteController::class, 'logout'])->name('logout');

    // User Dashboard
    Route::prefix('user')->name('user.')->group(function () {

        // Profile routes
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // Delete account
        Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('account.destroy');

        // Pet Hotel User Routes
        Route::prefix('pet-hotel')->name('pet-hotel.')->group(function () {
            Route::get('/', [PetHotelController::class, 'index'])->name('index');
            Route::get('/create', [PetHotelController::class, 'create'])->name('create');
            Route::get('/{id}/payment', [PetHotelController::class, 'payment'])->name('payment');
            Route::post('/{id}/payment/confirm', [PetHotelController::class, 'confirmPayment'])->name('payment.confirm');
            Route::post('/', [PetHotelController::class, 'store'])->name('store');
            Route::get('/{id}', [PetHotelController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [PetHotelController::class, 'edit'])->name('edit');
            Route::put('/{id}', [PetHotelController::class, 'update'])->name('update');
            Route::delete('/{id}', [PetHotelController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/tracking', [PetHotelController::class, 'tracking'])->name('tracking');
            Route::delete('/{id}/cancel', [PetHotelController::class, 'cancel'])->name('cancel');
        });

        // Adoption User Routes
        Route::prefix('adoption')->name('adoption.')->group(function () {
            Route::get('/', [AdoptionController::class, 'index'])->name('index');
            Route::get('/create', [AdoptionController::class, 'create'])->name('create');
            Route::post('/', [AdoptionController::class, 'store'])->name('store');
            Route::get('/{id}', [AdoptionController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [AdoptionController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AdoptionController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdoptionController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/tracking', [AdoptionController::class, 'tracking'])->name('tracking');
        });
    });
});
