<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;

// 1. Halaman Landing (Welcome)
// Kita kasih logika: kalau sudah login, pas buka '/' langsung dilempar ke dashboard
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

// 2. Dashboard & Fitur Utama (Dibungkus Middleware Auth)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard - Sekarang memanggil fungsi index di DebtController (Biar $contacts kebaca!)
    Route::get('/dashboard', [DebtController::class, 'index'])->name('dashboard');

    // Fitur Kelola Utang
    Route::post('/tambah-utang', [DebtController::class, 'store']);
    Route::post('/update-status/{id}', [DebtController::class, 'updateStatus']);
    Route::delete('/hapus-utang/{id}', [DebtController::class, 'destroy']);

    // Fitur Profile (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. Autentikasi Google (Socialite)
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

require __DIR__.'/auth.php';