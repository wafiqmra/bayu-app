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
            'nomor_wa' => 'nullable|string',
        ]);

        Debt::create([
            'nama_peminjam' => $request->nama_peminjam,
            'jumlah_utang' => $request->jumlah_utang,
            'nomor_wa' => $request->nomor_wa,
            'keterangan' => $request->keterangan,
            'status' => 'belum_lunas',
            'user_id' => auth()->id(),
        ]);

        return redirect('/dashboard')->with('success', 'Catatan utang berhasil ditambah!');
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

    public function index()
    {
        $user = auth()->user();
        
        // Ambil semua utang user
        $debts = $user->debts()->latest()->get();
        
        // Ambil daftar peminjam unik untuk fitur Auto-fill (Fitur No. 2)
        $contacts = $user->debts()
            ->whereNotNull('nomor_wa')
            ->select('nama_peminjam', 'nomor_wa')
            ->distinct('nama_peminjam')
            ->get();

        return view('dashboard', [
            'groupedDebts' => $debts->groupBy('nama_peminjam'),
            'contacts' => $contacts // Kirim data kontak ke view
        ]);
    }
}