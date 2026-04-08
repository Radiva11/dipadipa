<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

// Route untuk halaman utama (Landing Page)
Route::get('/', function () {
    return view('welcome'); // Mengarahkan ke landing page (welcome.blade.php)
});

// Route Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
// Pastikan name rutenya konsisten, biasanya cukup 'login' untuk POST
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route untuk Siswa (dengan middleware auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/siswa/aspirasi', [AspirasiController::class, 'index'])->name('siswa.aspirasi');
    Route::post('/siswa/aspirasi', [AspirasiController::class, 'store'])->name('siswa.aspirasi.store');
});

// Route untuk Admin (dengan middleware auth)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Kategori - LENGKAPI DENGAN UPDATE DAN DELETE
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');      // TAMBAHKAN INI
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy'); // TAMBAHKAN INI

    // Route Users
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Route Aspirasi & Feedback
    Route::get('/aspirasi', [DashboardController::class, 'aspirasi'])->name('aspirasi');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
});
