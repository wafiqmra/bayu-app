<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagihan Digital - BAYU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-[#F0F5FA] min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-[#D4E0E8]">
        <div class="bg-[#1E3A5F] p-8 text-center text-white">
            <p class="text-[10px] uppercase tracking-[0.3em] font-bold opacity-60 mb-2">Total Tagihan</p>
            <h1 class="text-3xl font-black">Rp {{ number_format($debt->jumlah_utang, 0, ',', '.') }}</h1>
            <div class="inline-block mt-3 px-3 py-1 bg-white/10 rounded-full">
                <p class="text-[10px] font-medium uppercase tracking-wider">Status: Belum Lunas</p>
            </div>
        </div>

        <div class="p-8 space-y-6">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1">
                    <p class="text-[10px] uppercase font-bold text-[#5F7D9C] tracking-wider">Peminjam</p>
                    <p class="font-bold text-[#1E3A5F]">{{ $debt->nama_peminjam }}</p>
                </div>
                <div class="space-y-1 text-right">
                    <p class="text-[10px] uppercase font-bold text-[#5F7D9C] tracking-wider">Tanggal Pinjam</p>
                    <p class="font-bold text-[#1E3A5F]">{{ $debt->created_at->translatedFormat('d F Y') }}</p>
                </div>
            </div>

            <div class="space-y-1 bg-[#F8FAFC] p-4 rounded-2xl border border-[#D4E0E8]">
                <p class="text-[10px] uppercase font-bold text-[#5F7D9C] tracking-wider mb-1">Barang / Keterangan</p>
                <p class="font-semibold text-[#1E3A5F] italic">"{{ $debt->keterangan ?: 'Belanjaan Warung' }}"</p>
            </div>

            <hr class="border-dashed border-slate-200">

            <div class="text-center py-4">
                <p class="text-[11px] font-black text-[#1E3A5F] mb-4 tracking-widest uppercase">Scan QRIS untuk Bayar</p>
                
                <div class="relative inline-block p-4 bg-white border-4 border-[#1E3A5F]/5 rounded-3xl shadow-inner">
                    <img src="{{ asset('qris.jpeg') }}" alt="QRIS" class="w-52 h-52 object-contain mx-auto rounded-lg">
                </div>
                
                <p class="text-[10px] text-[#5F7D9C] mt-4 italic">Silakan simpan/screenshot QRIS di atas</p>
            </div>

            <div class="pt-2">
                @php
                    // Pesan otomatis buat si peminjam lapor ke WA pemilik warung
                    $pesanKonfirmasi = "Halo, saya sudah bayar utang {$debt->keterangan} sebesar Rp " . number_format($debt->jumlah_utang, 0, ',', '.') . ". Ini bukti transfernya ya! 🙏";
                    // Ambil nomor WA pemilik warung (User yang login)
                    $waPemilik = $debt->user->nomor_wa ?? '628xxxxxxxx'; 
                @endphp
                
                <a href="https://wa.me/{{ $waPemilik }}?text={{ urlencode($pesanKonfirmasi) }}" 
                   target="_blank"
                   class="flex items-center justify-center gap-2 w-full bg-emerald-600 hover:bg-emerald-700 text-white py-4 rounded-2xl font-bold text-sm shadow-xl shadow-emerald-900/20 transition-all active:scale-95 uppercase tracking-wider">
                   <span>📱</span> Konfirmasi Bayar (Kirim Bukti)
                </a>
            </div>
        </div>

        <div class="bg-[#F8FAFC] py-4 text-center border-t border-slate-100">
            <p class="text-[9px] text-[#5F7D9C] font-bold uppercase tracking-[0.4em]">💰 BAYU • Bayar, Yuk!</p>
        </div>
    </div>

</body>
</html>