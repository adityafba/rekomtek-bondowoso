<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekomtekController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocumentController;

// Redirect root to rekomtek
Route::get('/', function () {
    return redirect()->route('rekomtek.index');
});

// Rekomtek routes
Route::prefix('rekomtek')->group(function () {
    Route::get('/', [RekomtekController::class, 'index'])->name('rekomtek.index');
    Route::get('/step1', [RekomtekController::class, 'createStep1'])->name('rekomtek.step1');
    Route::post('/step1', [RekomtekController::class, 'storeStep1'])->name('rekomtek.store.step1');
    Route::get('/step2/{id}', [RekomtekController::class, 'createStep2'])->name('rekomtek.step2');
    Route::post('/step2/{id}', [RekomtekController::class, 'storeStep2'])->name('rekomtek.store.step2');
    Route::get('/step3/{id}', [RekomtekController::class, 'createStep3'])->name('rekomtek.step3');
    Route::post('/step3/{id}', [RekomtekController::class, 'storeStep3'])->name('rekomtek.store.step3');
    Route::get('/success/{id}', [RekomtekController::class, 'success'])->name('rekomtek.success');
    Route::get('/generate-pdf/{id}', [RekomtekController::class, 'generatePDF'])->name('rekomtek.pdf');
    Route::get('/download/template/{type}', [RekomtekController::class, 'downloadTemplate'])->name('rekomtek.download.template');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    // Guest routes (login, register)
    Route::middleware(['web', 'guest'])->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login.form');
        Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
        Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('admin.register.form');
        Route::post('/register', [AuthController::class, 'register'])->name('admin.register');
    });

    // Protected routes
    Route::middleware(['web', 'auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
        
        // Application routes
        Route::get('/applications/{id}', [DashboardController::class, 'show'])->name('admin.applications.show');
        Route::get('/applications/{id}/edit', [DashboardController::class, 'edit'])->name('admin.applications.edit');
        Route::put('/applications/{id}', [DashboardController::class, 'update'])->name('admin.applications.update');
        Route::put('/applications/{id}/status', [DashboardController::class, 'updateStatus'])->name('admin.applications.update.status');
        
        // Document routes
        Route::get('/documents/{id}/download', [DocumentController::class, 'download'])->name('admin.documents.download');
        Route::get('/documents/{id}/view', [DocumentController::class, 'view'])->name('admin.documents.view');
    });
});

// Global 404 handler
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
