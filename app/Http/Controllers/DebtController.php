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
            'jatuh_tempo' => 'nullable|date',
        ]);

        Debt::create([
            'nama_peminjam' => $request->nama_peminjam,
            'jumlah_utang' => $request->jumlah_utang,
            'nomor_wa' => $request->nomor_wa,
            'keterangan' => $request->keterangan,
            'jatuh_tempo' => $request->jatuh_tempo,
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

        // Ganti '/' jadi back() atau '/dashboard' biar gak nyasar ke welcome
        return back()->with('success', 'Status utang diperbarui!');
    }

    public function destroy($id)
    {
        $debt = Debt::findOrFail($id);
        $debt->delete();

        // Ganti '/' jadi back() atau '/dashboard'
        return back()->with('success', 'Catatan berhasil dihapus!');
    }

    public function index()
    {
        $user = auth()->user();
        
        $debts = $user->debts()->latest()->get();
        
        $stats = [
            'total_piutang' => $user->debts()->where('status', 'belum_lunas')->sum('jumlah_utang'),
            'total_kembali' => $user->debts()->where('status', 'lunas')->sum('jumlah_utang'),
            'peminjam_aktif' => $user->debts()->where('status', 'belum_lunas')->distinct('nama_peminjam')->count('nama_peminjam'),
        ];
        $contacts = $user->debts()
            ->whereNotNull('nomor_wa')
            ->select('nama_peminjam', 'nomor_wa')
            ->get()
            ->unique('nama_peminjam')
            ->values(); // Reset index array agar Alpine.js bacanya gampang

        return view('dashboard', [
            'groupedDebts' => $debts->groupBy('nama_peminjam'),
            'contacts' => $contacts,
            'stats' => $stats
        ]);
    }
}