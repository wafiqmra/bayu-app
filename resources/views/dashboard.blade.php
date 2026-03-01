<x-app-layout>
    <x-slot name="header">
        <div class="bg-white/95 backdrop-blur-sm border-b border-[#D4E0E8]">
            <div class="w-full px-4 sm:px-6 lg:px-8 py-4">
                <h2 class="font-bold text-xl text-[#1E3A5F] leading-tight flex items-center gap-2">
                    <span class="text-2xl">💰</span> 
                    Kelola Piutang
                    <span class="text-xs bg-[#F0F5FA] text-[#5F7D9C] px-3 py-1 rounded-full ml-2">BAYU</span>
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-[#F0F5FA] py-6 sm:py-8" x-data="{ showTagihModal: false }" style="font-family: 'Poppins', sans-serif; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="max-w-2xl mx-auto mb-4">
                    <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-3 rounded-r-lg text-sm" role="alert">
                        <p class="font-medium flex items-center gap-2"><span>✅</span> {{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="max-w-2xl mx-auto mb-6">
                <div class="overflow-x-auto pb-2 -mx-4 px-4 sm:overflow-visible sm:mx-0 sm:px-0">
                    <div class="flex sm:grid sm:grid-cols-2 lg:grid-cols-4 gap-3 min-w-max sm:min-w-full">
                        <div class="w-48 sm:w-auto bg-[#1E3A5F] p-4 rounded-xl shadow-sm text-white border border-slate-700">
                            <div class="flex items-center justify-between mb-1">
                                <p class="text-[10px] font-medium uppercase text-[#B8D1E5] tracking-wider">Total Piutang</p>
                                <span class="text-lg">💰</span>
                            </div>
                            <h3 class="text-xl font-bold">Rp {{ number_format($stats['total_piutang'] ?? 0, 0, ',', '.') }}</h3>
                        </div>

                        <div class="w-48 sm:w-auto bg-emerald-600 p-4 rounded-xl shadow-sm text-white border border-emerald-500">
                            <div class="flex items-center justify-between mb-1">
                                <p class="text-[10px] font-medium uppercase text-emerald-100 tracking-wider">Masuk Hari Ini</p>
                                <span class="text-lg">💵</span>
                            </div>
                            <h3 class="text-xl font-bold">Rp {{ number_format($stats['masuk_hari_ini'] ?? 0, 0, ',', '.') }}</h3>
                        </div>

                        <div class="w-48 sm:w-auto bg-white p-4 rounded-xl shadow-sm border border-[#D4E0E8]">
                            <div class="flex items-center justify-between mb-1">
                                <p class="text-[10px] font-medium uppercase text-[#5F7D9C] tracking-wider">Sudah Kembali</p>
                                <span class="text-lg">✨</span>
                            </div>
                            <h3 class="text-xl font-bold text-[#1E3A5F]">Rp {{ number_format($stats['total_kembali'] ?? 0, 0, ',', '.') }}</h3>
                        </div>

                        <div class="w-48 sm:w-auto bg-white p-4 rounded-xl shadow-sm border border-[#D4E0E8]">
                            <div class="flex items-center justify-between mb-1">
                                <p class="text-[10px] font-medium uppercase text-[#5F7D9C] tracking-wider">Peminjam Aktif</p>
                                <span class="text-lg">👥</span>
                            </div>
                            <h3 class="text-xl font-bold text-[#1E3A5F]">{{ $stats['peminjam_aktif'] ?? 0 }} Org</h3>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $todayDebts = collect($activeDebts)->flatten()->filter(function($debt) {
                    return $debt->jatuh_tempo && \Carbon\Carbon::parse($debt->jatuh_tempo)->isToday();
                });
            @endphp

            @if($todayDebts->count() > 0)
            <div class="max-w-2xl mx-auto mb-6 text-center">
                <button @click="showTagihModal = true" class="w-full bg-orange-500 hover:bg-orange-600 text-white p-4 rounded-2xl flex items-center justify-between shadow-lg shadow-orange-900/20 transition-all active:scale-[0.98] animate-pulse">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">🔔</span>
                        <div class="text-left">
                            <p class="text-[10px] font-black uppercase tracking-widest opacity-80">Jadwal Nagih Hari Ini</p>
                            <p class="text-sm font-bold">Ada {{ $todayDebts->count() }} orang janji bayar hari ini!</p>
                        </div>
                    </div>
                    <span class="bg-white/20 px-3 py-1 rounded-lg text-xs font-black uppercase tracking-widest">Cek List</span>
                </button>
            </div>
            @endif

            <div class="max-w-2xl mx-auto mb-6">
                <div class="bg-white rounded-xl shadow-sm border border-[#D4E0E8] overflow-hidden">
                    <div class="p-5" x-data="{ 
                            nama: '', 
                            wa: '', 
                            contacts: {{ $contacts->toJson() }},
                            init() {
                                this.$watch('nama', (value) => {
                                    if (value.length > 0) {
                                        let match = this.contacts.find(c => 
                                            (c.nama_peminjam || '').toLowerCase() === value.trim().toLowerCase()
                                        );
                                        if (match) { this.wa = match.nomor_wa || ''; }
                                    }
                                });
                            }
                         }">
                        <h3 class="text-sm font-bold text-[#1E3A5F] mb-3 flex items-center gap-2">
                            <span class="w-1 h-4 bg-[#1E3A5F] rounded-full"></span>
                            Catat Utang Baru
                        </h3>

                        <form action="/tambah-utang" method="POST" class="space-y-3">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[10px] font-medium text-[#5F7D9C] mb-1 uppercase tracking-wider">Nama Peminjam</label>
                                    <input type="text" name="nama_peminjam" required x-model="nama" list="peminjam_list" autocomplete="off"
                                        class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 outline-none transition bg-white text-sm" placeholder="Cth: Bu Sari">
                                    <datalist id="peminjam_list">
                                        @foreach($contacts as $contact) 
                                            <option value="{{ data_get($contact, 'nama_peminjam') }}"> 
                                        @endforeach
                                    </datalist>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-medium text-[#5F7D9C] mb-1 uppercase tracking-wider">WhatsApp</label>
                                    <input type="tel" name="nomor_wa" x-model="wa"
                                        class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 outline-none transition bg-white text-sm" placeholder="08xxxxxxxxxx">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[10px] font-medium text-[#5F7D9C] mb-1 uppercase tracking-wider">Jumlah (Rp)</label>
                                    <input type="number" name="jumlah_utang" required
                                        class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 outline-none transition bg-white text-sm" placeholder="50000">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-medium text-[#5F7D9C] mb-1 uppercase tracking-wider">Janji Bayar</label>
                                    <input type="date" name="jatuh_tempo"
                                        class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 outline-none transition bg-white text-sm">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] font-medium text-[#5F7D9C] mb-1 uppercase tracking-wider">Keterangan</label>
                                <input type="text" name="keterangan"
                                    class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 outline-none transition bg-white text-sm" placeholder="Buat apa?">
                            </div>

                            <button type="submit" class="w-full bg-[#1E3A5F] hover:bg-[#0F2A47] text-white py-3 rounded-lg font-bold text-sm transition-all shadow-sm active:scale-[0.98] mt-2 uppercase tracking-widest">
                                💰 Simpan Catatan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="max-w-2xl mx-auto" x-data="{ activeTab: 'aktif' }">
                <div class="flex items-center justify-between mb-4 border-b border-[#D4E0E8]">
                    <div class="flex gap-6">
                        <button @click="activeTab = 'aktif'" 
                            :class="activeTab === 'aktif' ? 'text-[#1E3A5F] border-[#1E3A5F]' : 'text-[#5F7D9C] border-transparent'"
                            class="pb-2 text-xs font-bold uppercase tracking-wider border-b-2 transition-all">
                            🔥 Aktif
                        </button>
                        <button @click="activeTab = 'riwayat'" 
                            :class="activeTab === 'riwayat' ? 'text-emerald-600 border-emerald-600' : 'text-[#5F7D9C] border-transparent'"
                            class="pb-2 text-xs font-bold uppercase tracking-wider border-b-2 transition-all">
                            ✅ Riwayat
                        </button>
                    </div>
                </div>
                
                <div class="space-y-3" x-show="activeTab === 'aktif'">
                    @forelse($activeDebts as $nama => $items)
                        <details class="group bg-white border border-[#D4E0E8] rounded-xl overflow-hidden shadow-sm">
                            <summary class="flex items-center justify-between p-3 cursor-pointer list-none">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-[#1E3A5F] text-white rounded-lg flex items-center justify-center font-bold text-xs">{{ strtoupper(substr($nama, 0, 1)) }}</div>
                                    <div>
                                        <p class="font-bold text-[#1E3A5F] text-sm leading-none mb-1">{{ $nama }}</p>
                                        <p class="text-[9px] text-[#5F7D9C] uppercase tracking-tighter">{{ $items->count() }} Transaksi</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <p class="font-black text-[#1E3A5F] text-sm">Rp {{ number_format($items->sum('jumlah_utang'), 0, ',', '.') }}</p>
                                    <svg class="w-4 h-4 text-[#B8D1E5] group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </summary>
                            <div class="p-3 bg-[#F8FAFC] border-t border-[#D4E0E8] space-y-2">
                                @foreach($items as $debt)
                                    @php
                                        $isOverdue = $debt->jatuh_tempo && \Carbon\Carbon::parse($debt->jatuh_tempo)->isPast() && $debt->status != 'lunas';
                                        $wa = $debt->nomor_wa;
                                        if ($wa && str_starts_with($wa, '0')) { $wa = '62' . substr($wa, 1); }

                                        // Persiapan Pesan WA Dinamis
                                        $barang = $debt->keterangan ?: 'belanjaan';
                                        $nominal = number_format($debt->jumlah_utang, 0, ',', '.');
                                        $tglN = $debt->created_at->translatedFormat('d F Y');
                                        $urlN = route('debt.invoice', $debt->id);

                                        if($isOverdue) {
                                            $pesanWA = "PUNTEN 🙏 Mau ngingetin utang $barang (Catatan Tgl $tglN) sebesar Rp $nominal SUDAH LEWAT JATUH TEMPO. Mohon segera dilunasi ya. Cek rincian & QRIS di sini: $urlN";
                                        } else {
                                            $pesanWA = "Halo $nama 😊 Sekadar mengingatkan, ada catatan piutang $barang (Catatan Tgl $tglN) sebesar Rp $nominal ya. Rincian dan QRIS bisa dicek di sini: $urlN. Nuhun 🙏";
                                        }
                                    @endphp
                                    <div class="bg-white p-3 rounded-lg border {{ $isOverdue ? 'border-red-200 bg-red-50/50' : 'border-[#D4E0E8]' }} flex items-center justify-between shadow-sm">
                                        <div class="flex-1">
                                            <p class="text-xs font-bold text-[#1E3A5F] mb-0.5">{{ $debt->keterangan ?: 'Tanpa Keterangan' }} @if($isOverdue) <span class="text-[8px] bg-red-500 text-white px-1.5 py-0.5 rounded-full ml-1 uppercase font-black">Telat!</span> @endif</p>
                                            <p class="text-sm font-black text-blue-600">Rp {{ number_format($debt->jumlah_utang, 0, ',', '.') }}</p>
                                            <p class="text-[9px] text-slate-400 mt-1 uppercase font-medium">📅 {{ $debt->created_at->format('d M Y') }} @if($debt->jatuh_tempo) | ⏳ {{ \Carbon\Carbon::parse($debt->jatuh_tempo)->format('d M Y') }} @endif</p>
                                        </div>
                                        <div class="flex gap-2">
                                            @if($wa)
                                                <a href="https://wa.me/{{ $wa }}?text={{ urlencode($pesanWA) }}" target="_blank" class="p-2 rounded-lg border border-emerald-100 hover:bg-emerald-50 transition-colors"><img src="{{ asset('whatsapp.png') }}" class="w-4 h-4"></a>
                                            @endif
                                            <form action="/update-status/{{ $debt->id }}" method="POST">@csrf <button class="p-2 rounded-lg border border-emerald-100 text-emerald-600 hover:bg-emerald-50 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></button></form>
                                            <form action="/hapus-utang/{{ $debt->id }}" method="POST" onsubmit="return confirm('Hapus permanen?')">@csrf @method('DELETE') <button class="p-2 rounded-lg border border-red-100 text-red-400 hover:bg-red-50 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button></form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </details>
                    @empty
                        <div class="text-center py-12 bg-white rounded-xl border border-dashed border-[#D4E0E8]"><p class="text-sm text-[#5F7D9C] font-medium tracking-wide">Lunas semua, mantap! ✨</p></div>
                    @endforelse
                </div>

                <div class="space-y-3" x-show="activeTab === 'riwayat'" x-cloak>
                    @forelse($historyDebts as $nama => $items)
                        <details class="group bg-white border border-[#D4E0E8] rounded-xl overflow-hidden opacity-80 shadow-sm">
                            <summary class="flex items-center justify-between p-3 cursor-pointer list-none">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-slate-200 text-slate-500 rounded-lg flex items-center justify-center font-bold text-xs">{{ strtoupper(substr($nama, 0, 1)) }}</div>
                                    <p class="font-bold text-[#1E3A5F] text-sm leading-none">{{ $nama }}</p>
                                </div>
                                <p class="text-xs font-black text-emerald-600 uppercase tracking-widest">Lunas ✅</p>
                            </summary>
                            <div class="p-3 bg-slate-50 border-t border-[#D4E0E8] space-y-2">
                                @foreach($items as $debt)
                                    <div class="bg-white p-3 rounded-lg border border-[#D4E0E8] flex items-center justify-between">
                                        <div class="flex-1">
                                            <p class="text-xs font-bold text-slate-400 line-through">{{ $debt->keterangan ?: 'Tanpa Keterangan' }}</p>
                                            <p class="text-sm font-black text-slate-400">Rp {{ number_format($debt->jumlah_utang, 0, ',', '.') }}</p>
                                            <p class="text-[9px] text-emerald-600 font-black mt-1 uppercase flex items-center gap-1">
                                                <span>✅</span> Lunas pada: {{ $debt->updated_at->timezone('Asia/Jakarta')->translatedFormat('d F Y | H:i') }} WIB
                                            </p>
                                        </div>
                                        <form action="/update-status/{{ $debt->id }}" method="POST">@csrf <button class="text-[10px] bg-[#1E3A5F] text-white px-3 py-1 rounded-full font-black uppercase active:scale-95 transition-all shadow-sm">Batal</button></form>
                                    </div>
                                @endforeach
                            </div>
                        </details>
                    @empty
                        <div class="text-center py-12 bg-white rounded-xl border border-dashed border-[#D4E0E8]"><p class="text-sm text-[#5F7D9C] font-medium tracking-wide">Belum ada sejarah pelunasan.</p></div>
                    @endforelse
                </div>
            </div>

            <div x-show="showTagihModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" x-cloak x-transition>
                <div class="bg-white w-full max-w-md rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/20">
                    <div class="bg-orange-500 p-6 text-white flex justify-between items-center shadow-lg">
                        <div>
                            <h3 class="font-black text-xl tracking-tight leading-none mb-1">Nagih Serentak 📢</h3>
                            <p class="text-xs font-medium opacity-80 uppercase tracking-widest">Janji Bayar Hari Ini ({{ date('d M Y') }})</p>
                        </div>
                        <button @click="showTagihModal = false" class="w-10 h-10 flex items-center justify-center bg-white/20 hover:bg-white/30 rounded-full transition-colors font-bold text-xl">✕</button>
                    </div>
                    <div class="p-6 max-h-[60vh] overflow-y-auto space-y-3 bg-[#F8FAFC]">
                        @foreach($todayDebts as $todayDebt)
                            @php
                                $waToday = $todayDebt->nomor_wa;
                                if ($waToday && str_starts_with($waToday, '0')) $waToday = '62' . substr($waToday, 1);
                                
                                $tglT = $todayDebt->created_at->translatedFormat('d F Y');
                                $urlT = route('debt.invoice', $todayDebt->id);
                                $msgToday = "Halo {$todayDebt->nama_peminjam}, sekadar mengingatkan janji bayar hari ini untuk belanjaan '{$todayDebt->keterangan}' (Tgl $tglT) sebesar Rp " . number_format($todayDebt->jumlah_utang, 0, ',', '.') . ". Rincian & QRIS: $urlT";
                            @endphp
                            <div class="flex items-center justify-between p-4 bg-white rounded-2xl border border-slate-200 shadow-sm hover:border-orange-200 transition-colors">
                                <div>
                                    <p class="font-bold text-[#1E3A5F] text-sm leading-tight mb-1">{{ $todayDebt->nama_peminjam }}</p>
                                    <p class="text-xs font-black text-orange-600">Rp {{ number_format($todayDebt->jumlah_utang, 0, ',', '.') }}</p>
                                </div>
                                <a href="https://wa.me/{{ $waToday }}?text={{ urlencode($msgToday) }}" target="_blank" class="bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all active:scale-95 shadow-md shadow-emerald-900/10">Kirim WA</a>
                            </div>
                        @endforeach
                    </div>
                    <div class="p-6 border-t border-slate-100 bg-white text-center">
                        <p class="text-[10px] text-[#5F7D9C] font-black uppercase tracking-[0.3em] italic">💰 BAYU • Tagih Cepat Modal Selamat</p>
                    </div>
                </div>
            </div>

            <div class="max-w-2xl mx-auto mt-12 text-center pb-8">
                <p class="text-[10px] text-[#5F7D9C] font-black uppercase tracking-[0.4em] italic">BAYU • Bayar, Yuk! • Khusus UMKM & Warung</p>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
    [x-cloak] { display: none !important; }
</style>