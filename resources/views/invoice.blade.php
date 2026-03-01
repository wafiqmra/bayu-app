<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Tagihan Digital - BAYU</title>
    
    <link rel="icon" type="image/png" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ctext x='50' y='90' font-size='90' text-anchor='middle' fill='%231E3A5F'%3E💰%3C/text%3E%3C/svg%3E">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #F0F5FA;
            -webkit-font-smoothing: antialiased;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-[#D4E0E8]">
        <div class="bg-[#1E3A5F] p-8 text-center text-white">
            <p class="text-[10px] uppercase tracking-[0.3em] font-bold opacity-60 mb-2">Total Tagihan</p>
            <h1 class="text-4xl font-black italic">Rp {{ number_format($debt->jumlah_utang, 0, ',', '.') }}</h1>
            <div class="inline-block mt-3 px-4 py-1 bg-white/10 rounded-full border border-white/20">
                <p class="text-[10px] font-bold uppercase tracking-widest">⚠️ Belum Lunas</p>
            </div>
        </div>

        <div class="p-8 space-y-6">
            <div class="flex justify-between items-start gap-4">
                <div class="space-y-1">
                    <p class="text-[10px] uppercase font-bold text-[#5F7D9C] tracking-wider">Peminjam</p>
                    <p class="font-bold text-[#1E3A5F] text-lg">{{ $debt->nama_peminjam }}</p>
                </div>
                <div class="space-y-1 text-right">
                    <p class="text-[10px] uppercase font-bold text-[#5F7D9C] tracking-wider">Tanggal</p>
                    <p class="font-bold text-[#1E3A5F]">{{ $debt->created_at->translatedFormat('d F Y') }}</p>
                </div>
            </div>

            <div class="space-y-1 bg-[#F8FAFC] p-4 rounded-2xl border border-[#D4E0E8]">
                <p class="text-[10px] uppercase font-bold text-[#5F7D9C] tracking-wider mb-1">Keterangan Barang</p>
                <p class="font-semibold text-[#1E3A5F] leading-relaxed">"{{ $debt->keterangan ?: 'Belanjaan Warung' }}"</p>
            </div>

            <hr class="border-dashed border-slate-200">

            <div class="text-center py-2">
                <p class="text-[11px] font-black text-[#1E3A5F] mb-4 tracking-[0.2em] uppercase">Scan QRIS Untuk Bayar</p>
                
                <div class="relative inline-block p-4 bg-white border-4 border-[#1E3A5F]/5 rounded-[2rem] shadow-inner">
                    <img src="{{ asset('qris.jpg') }}" alt="QRIS" class="w-56 h-56 object-contain mx-auto rounded-xl">
                </div>
                
                <p class="text-[10px] text-[#5F7D9C] mt-5 font-medium italic">Silakan simpan atau screenshot kode di atas</p>
            </div>

            <div class="pt-2">
                @php
                    $pesanKonfirmasi = "Halo, saya sudah bayar utang {$debt->keterangan} sebesar Rp " . number_format($debt->jumlah_utang, 0, ',', '.') . ". Ini bukti transfernya ya! 🙏";
                    $waPemilik = $debt->user->nomor_wa ?? '628xxxxxxxx'; 
                @endphp
                
                <a href="https://wa.me/{{ $waPemilik }}?text={{ urlencode($pesanKonfirmasi) }}" 
                   target="_blank"
                   class="flex items-center justify-center gap-3 w-full bg-emerald-600 hover:bg-emerald-700 text-white py-5 rounded-2xl font-bold text-sm shadow-xl shadow-emerald-900/20 transition-all active:scale-95 uppercase tracking-widest">
                   <span>📱</span> Kirim Bukti Bayar
                </a>
            </div>
        </div>

        <div class="bg-[#F8FAFC] py-5 text-center border-t border-slate-100">
            <p class="text-[9px] text-[#5F7D9C] font-black uppercase tracking-[0.4em]">💰 BAYU • Bayar, Yuk!</p>
        </div>
    </div>

</body>
</html>