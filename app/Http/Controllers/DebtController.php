<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi data (biar gak kosong)
        $request->validate([
            'nama_peminjam' => 'required',
            'jumlah_utang' => 'required|numeric',
        ]);

        // 2. Simpan ke Database
        Debt::create([
            'nama_peminjam' => $request->nama_peminjam,
            'jumlah_utang' => $request->jumlah_utang,
            'keterangan' => $request->keterangan,
            'status' => 'belum_lunas',
        ]);

        // 3. Balik ke halaman depan dengan pesan sukses
        return redirect('/')->with('success', 'Data utang berhasil dicatat!');
    }
}