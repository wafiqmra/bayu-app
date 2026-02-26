<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAYU - Bayar Yuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen pb-20">

    <div class="max-w-2xl mx-auto pt-12 px-4">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-blue-600 tracking-tight">💰 BAYU</h1>
            <p class="text-slate-500 mt-2">Aplikasi Pengelola Utang Piutang (Bayar Yuk!)</p>
        </div>

        @if(session('success'))
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 shadow-sm rounded-r-lg" role="alert">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 mb-10">
            <form action="/tambah-utang" method="POST" class="flex flex-col gap-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Peminjam</label>
                    <input type="text" name="nama_peminjam" required
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                        placeholder="Contoh: Budi">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Jumlah Utang (Rp)</label>
                        <input type="number" name="jumlah_utang" required
                            class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                            placeholder="50000">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Keterangan</label>
                        <input type="text" name="keterangan"
                            class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                            placeholder="Misal: Nasi Goreng">
                    </div>
                </div>

                <button type="submit" 
                    class="mt-2 w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 active:scale-[0.98] transition-all shadow-lg shadow-blue-200">
                    Simpan ke Database Cloud
                </button>
            </form>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
            <h2 class="text-xl font-bold mb-6 text-slate-800 flex items-center gap-2">
                📋 Daftar Piutang 
                <span class="bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full">{{ $debts->count() }}</span>
            </h2>

            <div class="space-y-4">
                @forelse($debts as $debt)
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-4 border rounded-xl gap-4 {{ $debt->status == 'lunas' ? 'bg-slate-50 opacity-75' : 'bg-white border-slate-200' }}">
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <p class="font-bold text-slate-900 {{ $debt->status == 'lunas' ? 'line-through text-slate-400' : '' }}">
                                    {{ $debt->nama_peminjam }}
                                </p>
                                <span class="text-xs px-2 py-0.5 rounded-full font-semibold {{ $debt->status == 'lunas' ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-600' }}">
                                    {{ $debt->status == 'lunas' ? 'LUNAS' : 'BELUM' }}
                                </span>
                            </div>
                            <p class="text-lg font-extrabold text-blue-600 mt-1">
                                Rp {{ number_format($debt->jumlah_utang, 0, ',', '.') }}
                            </p>
                            <p class="text-sm text-slate-500 italic">{{ $debt->keterangan ?? 'Tanpa keterangan' }}</p>
                            <p class="text-[10px] text-slate-400 mt-1 uppercase tracking-wider">{{ $debt->created_at->diffForHumans() }}</p>
                        </div>

                        <div class="flex gap-2 w-full md:w-auto">
                            <form action="/update-status/{{ $debt->id }}" method="POST" class="flex-1">
                                @csrf
                                <button class="w-full text-xs font-bold py-2 px-4 rounded-lg border {{ $debt->status == 'lunas' ? 'border-amber-500 text-amber-600 hover:bg-amber-50' : 'border-emerald-500 text-emerald-600 hover:bg-emerald-50' }}">
                                    {{ $debt->status == 'lunas' ? 'Batal Lunas' : 'Set Lunas' }}
                                </button>
                            </form>

                            <form action="/hapus-utang/{{ $debt->id }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin mau hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="w-full text-xs font-bold py-2 px-4 rounded-lg border border-red-200 text-red-500 hover:bg-red-50">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <p class="text-slate-400 italic text-sm">Belum ada catatan utang. Tambahin yuk!</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="mt-10 text-center text-slate-400 text-xs tracking-widest uppercase">
            <p>&copy; 2026 BAYU APP • SIAP NAGIH</p>
        </div>
    </div>

</body>
</html>