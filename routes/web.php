<?php

use App\Http\Controllers\DebtController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Jalur untuk simpan data
Route::post('/tambah-utang', [DebtController::class, 'store']);