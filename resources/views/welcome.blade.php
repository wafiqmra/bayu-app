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
            <h2 class="text-xl font-semibold mb-6 text-slate-800">Tambah Catatan Utang</h2>
            
            <form action="/tambah-utang" method="POST" class="grid grid-cols-1 gap-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Peminjam</label>
                    <input type="text" name="nama_peminjam" required
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" 
                        placeholder="Contoh: Budi Gunawan">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Jumlah Utang (Rp)</label>
                        <input type="number" name="jumlah_utang" required
                            class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" 
                            placeholder="50000">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Keterangan</label>
                        <input type="text" name="keterangan"
                            class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" 
                            placeholder="Misal: Nasi Goreng">
                    </div>
                </div>

                <button type="submit" 
                    class="mt-2 w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 transform active:scale-[0.98] transition-all shadow-lg shadow-blue-200">
                    Simpan ke Database Cloud
                </button>
            </form>
        </div>

        <div class="text-center text-slate-400 text-sm">
            <p>&copy; 2026 BAYU Project - Terhubung ke Supabase PostgreSQL</p>
        </div>
    </div>

</body>
</html>