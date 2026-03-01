<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DebtController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // 1. Ambil Nama Peminjam Aktif dengan Pagination (5 orang per halaman)
        $activeNames = $user->debts()
            ->where('status', 'belum_lunas')
            ->select('nama_peminjam')
            ->groupBy('nama_peminjam')
            ->paginate(5); // Angka ini bisa kamu ubah sesuai selera

        // 2. Ambil Detail Utang hanya untuk nama yang ada di halaman ini
        $activeDebts = $user->debts()
            ->where('status', 'belum_lunas')
            ->whereIn('nama_peminjam', $activeNames->pluck('nama_peminjam'))
            ->get()
            ->groupBy('nama_peminjam');

        // 3. Riwayat Lunas (Tetap ambil semua atau bisa dipaginasi juga nanti)
        $historyDebts = $user->debts()
            ->where('status', 'lunas')
            ->latest('updated_at')
            ->get()
            ->groupBy('nama_peminjam');

        // 4. Statistik (Tetap hitung dari seluruh data user)
        $allStatsDebts = $user->debts()->get();
        $stats = [
            'total_piutang'  => $allStatsDebts->where('status', 'belum_lunas')->sum('jumlah_utang'),
            'total_kembali'  => $allStatsDebts->where('status', 'lunas')->sum('jumlah_utang'),
            'peminjam_aktif' => $user->debts()->where('status', 'belum_lunas')->distinct('nama_peminjam')->count(),
            'masuk_hari_ini' => $allStatsDebts->where('status', 'lunas')
                                             ->where('updated_at', '>=', Carbon::today())
                                             ->sum('jumlah_utang'),
        ];

        $contacts = $allStatsDebts->whereNotNull('nomor_wa')
            ->unique('nama_peminjam')
            ->map(function ($item) {
                return [
                    'nama_peminjam' => $item->nama_peminjam,
                    'nomor_wa'      => $item->nomor_wa,
                ];
            })->values();

        return view('dashboard', [
            'activeDebts'  => $activeDebts,
            'activeNames'  => $activeNames, // Variabel penting untuk tombol halaman
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
        // Saat save, updated_at akan otomatis terisi waktu sekarang (tanggal lunas)
        $debt->save();

        return back()->with('success', 'Status berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $debt = auth()->user()->debts()->findOrFail($id);
        $debt->delete();
        return back()->with('success', 'Catatan berhasil dihapus!');
    }

    public function showInvoice($id)
    {
        // Cari utang berdasarkan ID, kalau gak ada muncul 404
        $debt = Debt::findOrFail($id);
        
        return view('invoice', compact('debt'));
    }
}