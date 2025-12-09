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
use App\Http\Controllers\AdminRoomClosureController;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\DisplayController;

// Root - Landing Page
Route::get('/', function () {
    $announcements = \App\Models\Announcement::where('is_active', true)
        ->orderBy('published_date', 'desc')
        ->limit(3)
        ->get();
    return view('landing', compact('announcements'));
})->name('home');

// Public Information Routes (accessible without login)
Route::get('/contacts', [ContactController::class, 'publicIndex'])->name('public.contacts');
Route::get('/terms', [TermController::class, 'publicIndex'])->name('public.terms');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
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

    // Room Closure Management
    Route::get('/closures', [AdminRoomClosureController::class, 'index'])->name('closures.index');
    Route::get('/closures/create', [AdminRoomClosureController::class, 'create'])->name('closures.create');
    Route::post('/closures', [AdminRoomClosureController::class, 'store'])->name('closures.store');
    Route::delete('/closures/{closure}', [AdminRoomClosureController::class, 'destroy'])->name('closures.destroy');

    // Booking Management
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
    Route::post('/bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');
    Route::post('/bookings/{booking}/key-returned', [AdminBookingController::class, 'markKeyReturned'])->name('bookings.key-returned');

    // Announcement Management
    Route::resource('announcements', AdminAnnouncementController::class);

    // Cancellation Management
    Route::get('/cancellations', [AdminCancellationController::class, 'index'])->name('cancellations.index');
    Route::post('/cancellations/{id}/approve', [AdminCancellationController::class, 'approve'])->name('cancellations.approve');
    Route::post('/cancellations/{id}/reject', [AdminCancellationController::class, 'reject'])->name('cancellations.reject');

    // History Management  
    Route::get('/history', [AdminHistoryController::class, 'index'])->name('history.index');
    Route::delete('/history/{id}', [AdminHistoryController::class, 'destroy'])->name('history.destroy');

    // Aspiration Management
    Route::get('/aspirations', [AspirationController::class, 'index'])->name('aspirations.index');
    Route::get('/aspirations/{id}', [AspirationController::class, 'show'])->name('aspirations.show');
    Route::delete('/aspirations/{id}', [AspirationController::class, 'destroy'])->name('aspirations.destroy');

    // Contact Management
    Route::get('/contacts', [ContactController::class, 'adminIndex'])->name('contacts.index');
    Route::get('/contacts/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('/contacts', [ContactController::class, 'update'])->name('contacts.update');

    // Terms Management
    Route::get('/terms', [TermController::class, 'adminIndex'])->name('terms.index');
    Route::get('/terms/edit', [TermController::class, 'edit'])->name('terms.edit');
    Route::post('/terms', [TermController::class, 'store'])->name('terms.store');
    Route::put('/terms', [TermController::class, 'update'])->name('terms.update');
    Route::delete('/terms/{id}', [TermController::class, 'destroy'])->name('terms.destroy');
    Route::post('/terms/upload-document', [TermController::class, 'uploadDocument'])->name('terms.uploadDocument');

    // Booking Flow Management
    Route::get('/booking-flow', [\App\Http\Controllers\BookingFlowController::class, 'adminIndex'])->name('booking-flow.index');
    Route::put('/booking-flow', [\App\Http\Controllers\BookingFlowController::class, 'update'])->name('booking-flow.update');
    Route::post('/booking-flow/{id}/upload-image', [\App\Http\Controllers\BookingFlowController::class, 'uploadImage'])->name('booking-flow.uploadImage');
    Route::delete('/booking-flow/{id}/delete-image', [\App\Http\Controllers\BookingFlowController::class, 'deleteImage'])->name('booking-flow.deleteImage');
});

// Public Booking Flow Route (accessible without login)
Route::get('/alur-peminjaman', [\App\Http\Controllers\BookingFlowController::class, 'publicIndex'])->name('public.booking-flow');



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
    Route::get('/aspirations/form', function () {
        return view('user.aspiration-form');
    })->name('aspirations.form');
    Route::post('/aspirations', [AspirationController::class, 'store'])->name('aspirations.store');
    Route::get('/aspirations/{id}', [AspirationController::class, 'userShow'])->name('aspirations.show');
    Route::get('/contacts', [ContactController::class, 'userIndex'])->name('contacts.index');
    Route::get('/terms', [TermController::class, 'userIndex'])->name('terms.index');
    Route::get('/announcements', [App\Http\Controllers\UserController::class, 'announcements'])->name('announcements.index');
    Route::get('/announcements/{id}', [App\Http\Controllers\UserController::class, 'announcementDetail'])->name('announcements.show');

    // Booking management
    Route::delete('/bookings/{id}/delete', [App\Http\Controllers\UserController::class, 'deletePendingBooking'])->name('bookings.delete');
    Route::post('/bookings/{id}/cancel', [App\Http\Controllers\UserController::class, 'requestCancellation'])->name('bookings.cancel');
});

// Display Routes (Public Display Monitor)
Route::middleware(['auth', 'display'])->prefix('display')->name('display.')->group(function () {
    Route::get('/', [DisplayController::class, 'index'])->name('index');
    Route::get('/room/{id}', [DisplayController::class, 'showRoom'])->name('room');
});
