<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DebtController;
use App\Models\Debt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;

// 1. Halaman Landing (Welcome)
Route::get('/', function () {
    return view('welcome');
});

// 2. Dashboard - Hanya bisa diakses kalau sudah login
Route::get('/dashboard', function () {
    // Kita ambil data utang hanya milik user yang sedang login
    $groupedDebts = Debt::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy('nama_peminjam');

    return view('dashboard', compact('groupedDebts'));
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Fitur Utama BAYU (Dibungkus Middleware Auth agar aman)
Route::middleware('auth')->group(function () {
    // Fitur Utang
    Route::post('/tambah-utang', [DebtController::class, 'store']);
    Route::post('/update-status/{id}', [DebtController::class, 'updateStatus']);
    Route::delete('/hapus-utang/{id}', [DebtController::class, 'destroy']);

    // Fitur Profile (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. Autentikasi Google (Socialite)
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

require __DIR__.'/auth.php';