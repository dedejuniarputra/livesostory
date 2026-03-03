<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\PaymentAccountController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/packages/{category}', [HomeController::class, 'showCategory'])->name('packages.category');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Booking Routes (Public)
Route::get('/booking/{package}', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking/{package}', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/payment/{booking}', [BookingController::class, 'payment'])->name('booking.payment');
Route::post('/booking/confirm/{booking}', [BookingController::class, 'confirm'])->name('booking.confirm');
Route::post('/booking/cancel/{booking}', [BookingController::class, 'cancel'])->name('booking.cancel');

// API for calendar
Route::get('/api/available-dates', [BookingController::class, 'getAvailableDates'])->name('api.available-dates');

// Basic Dashboard Redirects
Route::redirect('/dashboard', '/admin');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::redirect('/dashboard', '/admin');

    // Portfolio Management
    Route::resource('portfolios', PortfolioController::class);

    // Package Management
    Route::resource('packages', PackageController::class);

    // Booking Management
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{booking}/export-pdf', [AdminBookingController::class, 'exportPdf'])->name('bookings.export-pdf');
    Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.update-status');
    Route::delete('/bookings/all', [AdminBookingController::class, 'destroyAll'])->name('bookings.destroy-all');
    Route::delete('/bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');

    // Schedule Management
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::post('/schedules/block', [ScheduleController::class, 'blockDate'])->name('schedules.block');
    Route::delete('/schedules/block/purge', [ScheduleController::class, 'purge'])->name('schedules.purge');
    Route::delete('/schedules/{blockedDate}', [ScheduleController::class, 'unblockDate'])->name('schedules.unblock');

    // Payment Accounts
    Route::get('/payment-accounts', [PaymentAccountController::class, 'index'])->name('payment-accounts.index');
    Route::post('/payment-accounts', [PaymentAccountController::class, 'store'])->name('payment-accounts.store');
    Route::get('/payment-accounts/{paymentAccount}/edit', [PaymentAccountController::class, 'edit'])->name('payment-accounts.edit');
    Route::put('/payment-accounts/{paymentAccount}', [PaymentAccountController::class, 'update'])->name('payment-accounts.update');
    Route::delete('/payment-accounts/{paymentAccount}', [PaymentAccountController::class, 'destroy'])->name('payment-accounts.destroy');

    // Contact Messages
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::delete('/settings/hero-image', [SettingController::class, 'deleteHeroImage'])->name('settings.delete-hero-image');
    Route::delete('/settings/contact-image', [SettingController::class, 'deleteContactImage'])->name('settings.delete-contact-image');
});

require __DIR__ . '/auth.php';
