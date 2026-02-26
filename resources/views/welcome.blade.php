<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAYU - Daftar Piutang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        summary::-webkit-details-marker { display: none; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen pb-20">

    <div class="max-w-2xl mx-auto pt-12 px-4">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-blue-600 tracking-tight">💰 BAYU</h1>
            <p class="text-slate-500 mt-2 font-medium uppercase tracking-widest text-xs">Penagih Utang Digital</p>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded-r-lg shadow-sm animate-bounce" role="alert">
                <p class="font-bold text-sm">Mantap! {{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 mb-8">
            <form action="/tambah-utang" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1 ml-1">Nama Peminjam</label>
                    <input type="text" name="nama_peminjam" required
                        class="w-full border border-slate-200 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 outline-none transition bg-slate-50" 
                        placeholder="Siapa yang ngutang?">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1 ml-1">Jumlah (Rp)</label>
                        <input type="number" name="jumlah_utang" required
                            class="w-full border border-slate-200 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 outline-none transition bg-slate-50" 
                            placeholder="50000">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1 ml-1">Keterangan</label>
                        <input type="text" name="keterangan"
                            class="w-full border border-slate-200 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 outline-none transition bg-slate-50" 
                            placeholder="Buat apa?">
                    </div>
                </div>

                <button type="submit" 
                    class="w-full bg-blue-600 text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-blue-700 active:scale-95 transition-all shadow-xl shadow-blue-100">
                    Catat Utang Baru
                </button>
            </form>
        </div>

        <div class="space-y-4">
            <h2 class="text-lg font-black text-slate-800 ml-2 mb-4">👥 DAFTAR PEMINJAM</h2>
            
            @forelse($groupedDebts as $nama => $items)
                <details class="group bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all">
                    <summary class="flex justify-between items-center p-5 cursor-pointer list-none select-none">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-2xl flex items-center justify-center font-black shadow-lg shadow-blue-100">
                                {{ strtoupper(substr($nama, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 text-lg">{{ $nama }}</p>
                                <p class="text-xs text-slate-400 font-bold uppercase tracking-tighter">{{ $items->count() }} Transaksi</p>
                            </div>
                        </div>
                        <div class="text-right flex items-center gap-4">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase">Total</p>
                                <p class="font-black text-blue-600">Rp {{ number_format($items->where('status', 'belum_lunas')->sum('jumlah_utang'), 0, ',', '.') }}</p>
                            </div>
                            <svg class="w-5 h-5 text-slate-300 group-open:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </summary>

                    <div class="p-4 bg-slate-50 border-t border-slate-100 space-y-3">
                        @foreach($items as $debt)
                            <div class="bg-white p-4 rounded-xl border border-slate-100 flex justify-between items-center shadow-sm">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm font-bold {{ $debt->status == 'lunas' ? 'line-through text-slate-300' : 'text-slate-700' }}">
                                            {{ $debt->keterangan ?: 'Tanpa Keterangan' }}
                                        </p>
                                        @if($debt->status == 'lunas')
                                            <span class="bg-emerald-100 text-emerald-600 text-[9px] font-black px-2 py-0.5 rounded-md uppercase">Lunas</span>
                                        @endif
                                    </div>
                                    <p class="text-md font-black text-blue-600">Rp {{ number_format($debt->jumlah_utang, 0, ',', '.') }}</p>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">{{ $debt->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="flex gap-2">
                                    <form action="/update-status/{{ $debt->id }}" method="POST">
                                        @csrf
                                        <button class="p-2 rounded-lg border {{ $debt->status == 'lunas' ? 'bg-amber-50 border-amber-200 text-amber-600' : 'bg-emerald-50 border-emerald-200 text-emerald-600' }} transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </button>
                                    </form>
                                    <form action="/hapus-utang/{{ $debt->id }}" method="POST" onsubmit="return confirm('Hapus permanen?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 rounded-lg border border-red-100 text-red-400 hover:bg-red-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </details>
            @empty
                <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-300">
                    <p class="text-slate-400 font-bold italic">Belum ada yang ngutang. Hidup tenang!</p>
                </div>
            @endforelse
        </div>

        <div class="mt-20 text-center opacity-30 group hover:opacity-100 transition-opacity">
            <p class="text-[10px] font-black tracking-[0.3em] text-slate-900 uppercase">Dibuat dengan emosi oleh Bayu App &copy; 2026</p>
        </div>
    </div>

</body>
</html>