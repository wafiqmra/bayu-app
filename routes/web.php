<?php

use App\Http\Controllers\DebtController;
use App\Models\Debt;
use Illuminate\Support\Facades\Route;

// Ambil data utang dan tampilkan di halaman depan
Route::get('/', function () {
    $debts = Debt::orderBy('created_at', 'desc')->get();
    return view('welcome', compact('debts'));
});

Route::post('/tambah-utang', [DebtController::class, 'store']);
Route::post('/update-status/{id}', [DebtController::class, 'updateStatus']);
Route::delete('/hapus-utang/{id}', [DebtController::class, 'destroy']);