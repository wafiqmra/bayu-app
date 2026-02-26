<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required',
            'jumlah_utang' => 'required|numeric',
        ]);

        Debt::create([
            'nama_peminjam' => $request->nama_peminjam,
            'jumlah_utang' => $request->jumlah_utang,
            'keterangan' => $request->keterangan,
            'status' => 'belum_lunas',
        ]);

        return redirect('/')->with('success', 'Catatan utang berhasil ditambah!');
    }

    public function updateStatus($id)
    {
        $debt = Debt::findOrFail($id);
        $debt->status = $debt->status == 'lunas' ? 'belum_lunas' : 'lunas';
        $debt->save();

        return redirect('/')->with('success', 'Status utang diperbarui!');
    }

    public function destroy($id)
    {
        $debt = Debt::findOrFail($id);
        $debt->delete();

        return redirect('/')->with('success', 'Catatan berhasil dihapus!');
    }
}