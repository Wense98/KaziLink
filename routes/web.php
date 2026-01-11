<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WorkerProfileController;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = ServiceCategory::all();
    return view('welcome', compact('categories'));
});

require __DIR__.'/auth.php';
Route::middleware(['auth'])->group(function () {
    Route::get('/become-a-worker', [WorkerProfileController::class, 'create'])->name('worker.create');
    Route::post('/become-a-worker', [WorkerProfileController::class, 'store'])->name('worker.store');
    
    Route::get('/worker/edit', [WorkerProfileController::class, 'edit'])->name('worker.edit');
    Route::patch('/worker/edit', [WorkerProfileController::class, 'update'])->name('worker.update');

    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('/subscriptions/checkout', [SubscriptionController::class, 'checkout'])->name('subscriptions.checkout');
    Route::get('/subscriptions/checkout', [SubscriptionController::class, 'checkout'])->name('subscriptions.checkout');
    Route::post('/subscriptions/process', [SubscriptionController::class, 'store'])->name('subscriptions.store');
    Route::get('/subscriptions/callback', [SubscriptionController::class, 'callback'])->name('subscriptions.callback');

    // Worker Verification
    Route::get('/worker/verification', [\App\Http\Controllers\WorkerVerificationController::class, 'show'])->name('worker.verification.show');
    Route::post('/worker/verification', [\App\Http\Controllers\WorkerVerificationController::class, 'store'])->name('worker.verification.store');

    Route::post('/worker/{worker}/review', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');

    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Panel
    Route::middleware(['admin', 'audit'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('/', [AdminDashboardController::class, 'updateSettings']); // Fallback for legacy form submissions
        Route::post('/workers/{worker}/verify', [AdminDashboardController::class, 'verify'])->name('workers.verify');
        Route::post('/users/{user}/toggle', [AdminDashboardController::class, 'toggleUserStatus'])->name('users.toggle');
        Route::post('/payments/{subscription}/confirm', [AdminDashboardController::class, 'confirmPayment'])->name('payments.confirm');

        // Data Management
        Route::post('/data/locations', [AdminDashboardController::class, 'storeLocation'])->name('data.locations.store');
        Route::delete('/data/locations/{location}', [AdminDashboardController::class, 'destroyLocation'])->name('data.locations.destroy');
        Route::post('/data/categories', [AdminDashboardController::class, 'storeCategory'])->name('data.categories.store');
        Route::delete('/data/categories/{category}', [AdminDashboardController::class, 'destroyCategory'])->name('data.categories.destroy');
        
        // System Settings
        Route::post('/settings', [AdminDashboardController::class, 'updateSettings'])->name('settings.update');
    });

    // Messaging
    Route::get('/messages', [App\Http\Controllers\MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [App\Http\Controllers\MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{user}', [App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');

    // Job Requests
    Route::get('/job-requests', [App\Http\Controllers\JobRequestController::class, 'index'])->name('job-requests.index');
    Route::post('/job-requests/{user}', [App\Http\Controllers\JobRequestController::class, 'store'])->name('job-requests.store');
    Route::patch('/job-requests/{jobRequest}', [App\Http\Controllers\JobRequestController::class, 'update'])->name('job-requests.update');
    Route::get('/job-requests/callback', [App\Http\Controllers\JobRequestController::class, 'callback'])->name('job-requests.callback');
    
    // Reviews
    Route::post('/reviews/{worker}', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/verify-otp', [\App\Http\Controllers\OtpVerificationController::class, 'show'])->name('verification.notice');
    Route::post('/verify-otp', [\App\Http\Controllers\OtpVerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/verify-otp/resend', [\App\Http\Controllers\OtpVerificationController::class, 'resend'])->name('verification.resend');
});

Route::get('/search', [\App\Http\Controllers\WorkerSearchController::class, 'index'])->name('search.index');
Route::get('/worker/{worker}', [\App\Http\Controllers\WorkerProfileController::class, 'show'])->name('worker.show');
