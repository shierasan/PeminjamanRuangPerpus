<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminAnnouncementController;
use App\Http\Controllers\AdminCancellationController;
use App\Http\Controllers\AdminHistoryController;

// Root - Landing Page
Route::get('/', function () {
    return view('landing');
})->name('home');

// Authentication Routes (Admin Only)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Notifications
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
    Route::get('/notifications/{id}/read', [AdminController::class, 'markAsRead'])->name('notifications.read');

    // Profile
    Route::get('/profile', function () {
        return view('admin.profile');
    })->name('profile');

    // Room Management
    Route::resource('rooms', AdminRoomController::class);

    // Booking Management
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
    Route::post('/bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');

    // Announcement Management
    Route::resource('announcements', AdminAnnouncementController::class);

    // Cancellation Management
    Route::get('/cancellations', [AdminCancellationController::class, 'index'])->name('cancellations.index');
    Route::post('/cancellations/{id}/approve', [AdminCancellationController::class, 'approve'])->name('cancellations.approve');
    Route::post('/cancellations/{id}/reject', [AdminCancellationController::class, 'reject'])->name('cancellations.reject');

    // History Management  
    Route::get('/history', [AdminHistoryController::class, 'index'])->name('history.index');
    Route::delete('/history/{id}', [AdminHistoryController::class, 'destroy'])->name('history.destroy');
});

// User Routes (Only accessible by users, not admins)
Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/rooms', [App\Http\Controllers\UserController::class, 'rooms'])->name('rooms');
    Route::get('/rooms/{id}', [App\Http\Controllers\UserController::class, 'roomDetail'])->name('rooms.detail');
    Route::get('/rooms/{id}/booking', [App\Http\Controllers\UserController::class, 'createBooking'])->name('rooms.booking');
    Route::post('/bookings', [App\Http\Controllers\UserController::class, 'storeBooking'])->name('bookings.store');
    Route::get('/history', [App\Http\Controllers\UserController::class, 'history'])->name('history');
    Route::get('/bookings/{id}', [App\Http\Controllers\UserController::class, 'bookingDetail'])->name('bookings.detail');
    Route::get('/notifications', [App\Http\Controllers\UserController::class, 'notifications'])->name('notifications');
    Route::get('/notifications/{id}/read', [App\Http\Controllers\UserController::class, 'markNotificationAsRead'])->name('notifications.read');
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
});
