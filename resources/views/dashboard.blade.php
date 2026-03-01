<x-app-layout>
    {{-- Slot header ganda dihapus, navbar tetap satu di atas --}}

    <div class="min-h-screen bg-[#F0F5FA] py-6 sm:py-8" x-data="{ showTagihModal: false }" style="font-family: 'Poppins', sans-serif; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4">
                    <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-3 rounded-r-lg text-sm" role="alert">
                        <p class="font-medium flex items-center gap-2"><span>✅</span> {{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                {{-- KOLOM KIRI (Statistik & Form Input) --}}
                <div class="lg:col-span-5 space-y-6">
                    
                    {{-- 1. KARTU STATISTIK --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-[#1E3A5F] p-4 rounded-xl shadow-sm text-white border border-slate-700">
                            <p class="text-[10px] font-medium uppercase text-[#B8D1E5] tracking-wider mb-1">Total Piutang</p>
                            <h3 class="text-lg font-bold">Rp {{ number_format($stats['total_piutang'] ?? 0, 0, ',', '.') }}</h3>
                        </div>
                        <div class="bg-emerald-600 p-4 rounded-xl shadow-sm text-white border border-emerald-500">
                            <p class="text-[10px] font-medium uppercase text-emerald-100 tracking-wider mb-1">Masuk Hari Ini</p>
                            <h3 class="text-lg font-bold">Rp {{ number_format($stats['masuk_hari_ini'] ?? 0, 0, ',', '.') }}</h3>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-[#D4E0E8]">
                            <p class="text-[10px] font-medium uppercase text-[#5F7D9C] tracking-wider mb-1">Sudah Kembali</p>
                            <h3 class="text-md font-bold text-[#1E3A5F]">Rp {{ number_format($stats['total_kembali'] ?? 0, 0, ',', '.') }}</h3>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-[#D4E0E8]">
                            <p class="text-[10px] font-medium uppercase text-[#5F7D9C] tracking-wider mb-1">Peminjam</p>
                            <h3 class="text-md font-bold text-[#1E3A5F]">{{ $stats['peminjam_aktif'] ?? 0 }} Org</h3>
                        </div>
                    </div>

                    {{-- TOMBOL NAGIH HARI INI --}}
                    @php
                        $todayDebts = collect($activeDebts)->flatten()->filter(function($debt) {
                            return $debt->jatuh_tempo && \Carbon\Carbon::parse($debt->jatuh_tempo)->isToday();
                        });
                    @endphp

                    @if($todayDebts->count() > 0)
                    <button @click="showTagihModal = true" class="w-full bg-orange-500 hover:bg-orange-600 text-white p-4 rounded-2xl flex items-center justify-between shadow-lg shadow-orange-900/20 transition-all active:scale-[0.98] animate-pulse">
                        <div class="flex items-center gap-3 text-left">
                            <span class="text-2xl">🔔</span>
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest opacity-80 leading-none mb-1">Jadwal Nagih</p>
                                <p class="text-sm font-bold">{{ $todayDebts->count() }} orang janji bayar hari ini!</p>
                            </div>
                        </div>
                        <span class="bg-white/20 px-3 py-1 rounded-lg text-xs font-black uppercase">Cek List</span>
                    </button>
                    @endif

                    {{-- 2. FORM INPUT UTANG --}}
                    <div class="bg-white rounded-xl shadow-sm border border-[#D4E0E8] p-5" x-data="{ 
                            nama: '', wa: '', contacts: {{ $contacts->toJson() }},
                            init() {
                                this.$watch('nama', (v) => {
                                    if (v.length > 0) {
                                        let match = this.contacts.find(c => (c.nama_peminjam || '').toLowerCase() === v.trim().toLowerCase());
                                        if (match) { this.wa = match.nomor_wa || ''; }
                                    }
                                });
                            }
                         }">
                        <h3 class="text-sm font-bold text-[#1E3A5F] mb-4 flex items-center gap-2">
                            <span class="w-1 h-4 bg-[#1E3A5F] rounded-full"></span> Catat Utang Baru
                        </h3>
                        <form action="/tambah-utang" method="POST" class="space-y-4">
                            @csrf
                            <div class="space-y-3">
                                <input type="text" name="nama_peminjam" required x-model="nama" list="peminjam_list" autocomplete="off"
                                    class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] outline-none transition bg-white text-sm" placeholder="Nama Peminjam">
                                <datalist id="peminjam_list">@foreach($contacts as $c) <option value="{{ data_get($c, 'nama_peminjam') }}"> @endforeach</datalist>
                                
                                <input type="tel" name="nomor_wa" x-model="wa" class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] outline-none transition bg-white text-sm" placeholder="WhatsApp (08...)">
                                
                                <div class="grid grid-cols-2 gap-3">
                                    <input type="number" name="jumlah_utang" required class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] outline-none transition bg-white text-sm" placeholder="Jumlah (Rp)">
                                    <input type="date" name="jatuh_tempo" class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] outline-none transition bg-white text-sm">
                                </div>
                                
                                <input type="text" name="keterangan" class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] outline-none transition bg-white text-sm" placeholder="Keterangan (Cth: Beras 2kg)">
                            </div>
                            <button type="submit" class="w-full bg-[#1E3A5F] hover:bg-[#0F2A47] text-white py-3 rounded-lg font-bold text-sm transition-all shadow-sm active:scale-[0.98] uppercase tracking-widest text-center">
                                💰 Simpan Catatan
                            </button>
                        </form>
                    </div>
                </div>

                {{-- KOLOM KANAN (Daftar Utang & Riwayat) --}}
                <div class="lg:col-span-7" x-data="{ activeTab: 'aktif' }">
                    <div class="bg-white rounded-2xl shadow-sm border border-[#D4E0E8] p-6 min-h-[500px]">
                        <div class="flex items-center justify-between mb-6 border-b border-[#D4E0E8]">
                            <div class="flex gap-8">
                                <button @click="activeTab = 'aktif'" 
                                    :class="activeTab === 'aktif' ? 'text-[#1E3A5F] border-[#1E3A5F]' : 'text-[#5F7D9C] border-transparent'"
                                    class="pb-4 text-sm font-bold uppercase tracking-wider border-b-2 transition-all">
                                    🔥 Utang Aktif
                                </button>
                                <button @click="activeTab = 'riwayat'" 
                                    :class="activeTab === 'riwayat' ? 'text-emerald-600 border-emerald-600' : 'text-[#5F7D9C] border-transparent'"
                                    class="pb-4 text-sm font-bold uppercase tracking-wider border-b-2 transition-all">
                                    ✅ Riwayat Lunas
                                </button>
                            </div>
                        </div>
                        
                        {{-- TAB UTANG AKTIF --}}
                        <div class="space-y-4" x-show="activeTab === 'aktif'">
                            @forelse($activeDebts as $nama => $items)
                                <details class="group border border-[#D4E0E8] rounded-xl overflow-hidden shadow-sm">
                                    <summary class="flex items-center justify-between p-4 cursor-pointer list-none bg-slate-50/50">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-[#1E3A5F] text-white rounded-lg flex items-center justify-center font-bold text-sm">{{ strtoupper(substr($nama, 0, 1)) }}</div>
                                            <div>
                                                <p class="font-bold text-[#1E3A5F] text-sm leading-none mb-1">{{ $nama }}</p>
                                                <p class="text-[9px] text-[#5F7D9C] uppercase tracking-tighter">{{ $items->count() }} Transaksi</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <p class="font-black text-[#1E3A5F] text-md">Rp {{ number_format($items->sum('jumlah_utang'), 0, ',', '.') }}</p>
                                            <svg class="w-5 h-5 text-[#B8D1E5] group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </summary>
                                    <div class="p-4 bg-white space-y-3">
                                        @foreach($items as $debt)
                                            @php
                                                $isOverdue = $debt->jatuh_tempo && \Carbon\Carbon::parse($debt->jatuh_tempo)->isPast() && $debt->status != 'lunas';
                                                $wa = $debt->nomor_wa;
                                                if ($wa && str_starts_with($wa, '0')) { $wa = '62' . substr($wa, 1); }
                                                $msgWA = "Halo $nama 😊 Mau ngingetin piutang " . ($debt->keterangan ?: 'belanjaan') . " sebesar Rp " . number_format($debt->jumlah_utang, 0, ',', '.') . ". Cek rincian & QRIS di sini: " . route('debt.invoice', $debt->id);
                                            @endphp
                                            <div class="p-3 rounded-lg border {{ $isOverdue ? 'border-red-200 bg-red-50/30' : 'border-slate-100' }} flex items-center justify-between shadow-sm">
                                                <div class="flex-1">
                                                    <p class="text-xs font-bold text-[#1E3A5F]">{{ $debt->keterangan ?: 'Utang' }} @if($isOverdue) <span class="text-[8px] bg-red-500 text-white px-1.5 py-0.5 rounded-full ml-1 font-black uppercase">Telat!</span> @endif</p>
                                                    <p class="text-sm font-black text-blue-600">Rp {{ number_format($debt->jumlah_utang, 0, ',', '.') }}</p>
                                                    <p class="text-[9px] text-slate-400 mt-1 uppercase">📅 {{ $debt->created_at->format('d M Y') }}</p>
                                                </div>
                                                <div class="flex gap-2">
                                                    @if($wa)
                                                        <a href="https://wa.me/{{ $wa }}?text={{ urlencode($msgWA) }}" target="_blank" class="p-2 rounded-lg border border-emerald-100 hover:bg-emerald-50 transition-colors"><img src="{{ asset('whatsapp.png') }}" class="w-4 h-4"></a>
                                                    @endif
                                                    <form action="/update-status/{{ $debt->id }}" method="POST">@csrf <button class="p-2 rounded-lg border border-emerald-100 text-emerald-600 hover:bg-emerald-50 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="3" d="M5 13l4 4L19 7" stroke-linecap="round"/></svg></button></form>
                                                    
                                                    {{-- TOMBOL HAPUS YANG TADI ILANG --}}
                                                    <form action="/hapus-utang/{{ $debt->id }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                                                        @csrf @method('DELETE')
                                                        <button class="p-2 rounded-lg border border-red-100 text-red-400 hover:bg-red-50 transition-colors">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </details>
                            @empty
                                <div class="text-center py-20 opacity-40"><p class="text-sm font-bold text-slate-400">Belum ada piutang aktif. ✨</p></div>
                            @endforelse

                            {{-- PAGINATION --}}
                            @if(isset($activeNames) && $activeNames->hasPages())
                                <div class="mt-8 p-4 bg-[#F8FAFC] rounded-2xl border border-[#D4E0E8]">
                                    {{ $activeNames->links() }}
                                </div>
                            @endif
                        </div>

                        {{-- TAB RIWAYAT --}}
                        <div class="space-y-4" x-show="activeTab === 'riwayat'" x-cloak>
                            @forelse($historyDebts as $nama => $items)
                                <details class="group border border-[#D4E0E8] rounded-xl overflow-hidden opacity-80 shadow-sm">
                                    <summary class="flex items-center justify-between p-4 cursor-pointer list-none bg-slate-50/50">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-slate-200 text-slate-500 rounded-lg flex items-center justify-center font-bold text-sm">{{ strtoupper(substr($nama, 0, 1)) }}</div>
                                            <p class="font-bold text-[#1E3A5F] text-sm leading-none">{{ $nama }}</p>
                                        </div>
                                        <p class="text-xs font-black text-emerald-600 uppercase tracking-widest">Lunas ✅</p>
                                    </summary>
                                    <div class="p-4 bg-white space-y-3">
                                        @foreach($items as $debt)
                                            <div class="p-3 rounded-lg border border-slate-100 flex items-center justify-between">
                                                <div class="flex-1">
                                                    <p class="text-xs font-bold text-slate-400 line-through">{{ $debt->keterangan ?: 'Utang' }}</p>
                                                    <p class="text-sm font-black text-slate-400">Rp {{ number_format($debt->jumlah_utang, 0, ',', '.') }}</p>
                                                    <p class="text-[9px] text-emerald-600 font-black mt-1 uppercase">✅ {{ $debt->updated_at->timezone('Asia/Jakarta')->translatedFormat('d F Y | H:i') }} WIB</p>
                                                </div>
                                                <div class="flex gap-2">
                                                    <form action="/update-status/{{ $debt->id }}" method="POST">@csrf <button class="text-[10px] bg-[#1E3A5F] text-white px-4 py-1.5 rounded-full font-black uppercase active:scale-95 transition-all shadow-sm">Batal</button></form>
                                                    
                                                    {{-- TOMBOL HAPUS DI RIWAYAT --}}
                                                    <form action="/hapus-utang/{{ $debt->id }}" method="POST" onsubmit="return confirm('Hapus riwayat ini?')">
                                                        @csrf @method('DELETE')
                                                        <button class="p-2 rounded-lg border border-red-100 text-red-400 hover:bg-red-50 transition-colors">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </details>
                            @empty
                                <div class="text-center py-20 opacity-40"><p class="text-sm font-bold text-slate-400">Belum ada sejarah pelunasan.</p></div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODAL NAGIH --}}
            <div x-show="showTagihModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" x-cloak x-transition>
                <div class="bg-white w-full max-w-md rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/20">
                    <div class="bg-orange-500 p-6 text-white flex justify-between items-center shadow-lg">
                        <div>
                            <h3 class="font-black text-xl tracking-tight mb-1">Nagih Serentak 📢</h3>
                            <p class="text-xs font-medium opacity-80 uppercase tracking-widest">Janji Bayar Hari Ini ({{ date('d M Y') }})</p>
                        </div>
                        <button @click="showTagihModal = false" class="w-10 h-10 flex items-center justify-center bg-white/20 hover:bg-white/30 rounded-full transition-colors font-bold text-xl">✕</button>
                    </div>
                    <div class="p-6 max-h-[60vh] overflow-y-auto space-y-3 bg-[#F8FAFC]">
                        @foreach($todayDebts as $todayDebt)
                            @php
                                $waToday = $todayDebt->nomor_wa;
                                if ($waToday && str_starts_with($waToday, '0')) $waToday = '62' . substr($waToday, 1);
                                $msgToday = "Halo {$todayDebt->nama_peminjam}, sekadar mengingatkan janji bayar hari ini untuk belanjaan '{$todayDebt->keterangan}' sebesar Rp " . number_format($todayDebt->jumlah_utang, 0, ',', '.') . ". Rincian & QRIS: " . route('debt.invoice', $todayDebt->id);
                            @endphp
                            <div class="flex items-center justify-between p-4 bg-white rounded-2xl border border-slate-200 shadow-sm">
                                <div class="text-left">
                                    <p class="font-bold text-[#1E3A5F] text-sm leading-tight mb-1">{{ $todayDebt->nama_peminjam }}</p>
                                    <p class="text-xs font-black text-orange-600">Rp {{ number_format($todayDebt->jumlah_utang, 0, ',', '.') }}</p>
                                </div>
                                <a href="https://wa.me/{{ $waToday }}?text={{ urlencode($msgToday) }}" target="_blank" class="bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase transition-all active:scale-95 shadow-md">Kirim WA</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center pb-8">
                <p class="text-[10px] text-[#5F7D9C] font-black uppercase tracking-[0.4em] italic">💰 BAYU • Solusi Digital Warung Mikro</p>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
    [x-cloak] { display: none !important; }
</style>