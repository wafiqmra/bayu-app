<?php

use App\Http\Controllers\DebtController;
use App\Models\Debt;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Ambil semua data, lalu kelompokkan berdasarkan nama_peminjam
    $groupedDebts = Debt::orderBy('created_at', 'desc')->get()->groupBy('nama_peminjam');
    return view('welcome', compact('groupedDebts'));
});

Route::post('/tambah-utang', [DebtController::class, 'store']);
Route::post('/update-status/{id}', [DebtController::class, 'updateStatus']);
Route::delete('/hapus-utang/{id}', [DebtController::class, 'destroy']);