<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $allDebts = $user->debts()->latest()->get();
        
        // Pisahkan data untuk Tab
        $activeDebts = $allDebts->where('status', 'belum_lunas')->groupBy('nama_peminjam');
        $historyDebts = $allDebts->where('status', 'lunas')->groupBy('nama_peminjam');

        $stats = [
            'total_piutang'  => $allDebts->where('status', 'belum_lunas')->sum('jumlah_utang'),
            'total_kembali'  => $allDebts->where('status', 'lunas')->sum('jumlah_utang'),
            'peminjam_aktif' => $activeDebts->count(),
        ];

        $contacts = $allDebts->whereNotNull('nomor_wa')
            ->unique('nama_peminjam')
            ->map(function ($item) {
                return [
                    'nama_peminjam' => $item->nama_peminjam,
                    'nomor_wa'      => $item->nomor_wa,
                ];
            })->values();

        return view('dashboard', [
            'activeDebts'  => $activeDebts,
            'historyDebts' => $historyDebts,
            'contacts'     => $contacts,
            'stats'        => $stats
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'jumlah_utang'  => 'required|numeric|min:0',
            'nomor_wa'      => 'nullable|string',
            'jatuh_tempo'   => 'nullable|date',
        ]);

        Debt::create([
            'nama_peminjam' => $request->nama_peminjam,
            'jumlah_utang'  => $request->jumlah_utang,
            'nomor_wa'      => $request->nomor_wa,
            'keterangan'    => $request->keterangan,
            'jatuh_tempo'   => $request->jatuh_tempo,
            'status'        => 'belum_lunas',
            'user_id'       => auth()->id(),
        ]);

        return redirect('/dashboard')->with('success', 'Catatan utang berhasil ditambah!');
    }

    public function updateStatus($id)
    {
        $debt = auth()->user()->debts()->findOrFail($id);
        $debt->status = ($debt->status == 'lunas') ? 'belum_lunas' : 'lunas';
        $debt->save();
        return back()->with('success', 'Status diperbarui!');
    }

    public function destroy($id)
    {
        $debt = auth()->user()->debts()->findOrFail($id);
        $debt->delete();
        return back()->with('success', 'Berhasil dihapus!');
    }
}