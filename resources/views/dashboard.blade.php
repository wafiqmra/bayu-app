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

    <div class="min-h-screen bg-[#F0F5FA] py-6 sm:py-8">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="max-w-2xl mx-auto mb-4">
                    <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-3 rounded-r-lg text-sm" role="alert">
                        <p class="font-medium flex items-center gap-2">
                            <span>✅</span> {{ session('success') }}
                        </p>
                    </div>
                </div>
            @endif

            <div class="max-w-2xl mx-auto mb-6">
                <div class="overflow-x-auto pb-2 -mx-4 px-4 sm:overflow-visible sm:mx-0 sm:px-0">
                    <div class="flex sm:grid sm:grid-cols-3 gap-3 min-w-max sm:min-w-full">
                        <div class="w-48 sm:w-auto bg-[#1E3A5F] p-4 rounded-xl shadow-sm">
                            <div class="flex items-center justify-between mb-1">
                                <p class="text-[10px] font-medium uppercase text-[#B8D1E5] tracking-wider">Total Piutang</p>
                                <span class="text-lg">💰</span>
                            </div>
                            <h3 class="text-xl font-bold text-white">Rp {{ number_format($stats['total_piutang'] ?? 0, 0, ',', '.') }}</h3>
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
                            <h3 class="text-xl font-bold text-[#1E3A5F]">{{ $stats['peminjam_aktif'] ?? 0 }} Orang</h3>
                        </div>
                    </div>
                </div>
            </div>

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
                                    <label class="block text-[10px] font-medium text-[#5F7D9C] mb-1">Nama Peminjam</label>
                                    <input type="text" name="nama_peminjam" required x-model="nama" list="peminjam_list" autocomplete="off"
                                        class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 outline-none transition bg-white text-sm" placeholder="Cth: Bu Sari">
                                    <datalist id="peminjam_list">
                                        @foreach($contacts as $contact) 
                                            <option value="{{ data_get($contact, 'nama_peminjam') }}"> 
                                        @endforeach
                                    </datalist>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-medium text-[#5F7D9C] mb-1">WhatsApp</label>
                                    <input type="tel" name="nomor_wa" x-model="wa"
                                        class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 outline-none transition bg-white text-sm" placeholder="08xxxxxxxxxx">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[10px] font-medium text-[#5F7D9C] mb-1">Jumlah (Rp)</label>
                                    <input type="number" name="jumlah_utang" required
                                        class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 outline-none transition bg-white text-sm" placeholder="50000">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-medium text-[#5F7D9C] mb-1">Janji Bayar</label>
                                    <input type="date" name="jatuh_tempo"
                                        class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 outline-none transition bg-white text-sm">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] font-medium text-[#5F7D9C] mb-1">Keterangan</label>
                                <input type="text" name="keterangan"
                                    class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 outline-none transition bg-white text-sm" placeholder="Buat apa?">
                            </div>

                            <button type="submit" class="w-full bg-[#1E3A5F] hover:bg-[#0F2A47] text-white py-3 rounded-lg font-medium text-sm transition-all shadow-sm active:scale-[0.98] mt-2">
                                <span class="flex items-center justify-center gap-2">
                                    <span>💰</span> Catat Utang Baru
                                </span>
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
                                        <p class="font-bold text-[#1E3A5F] text-sm">{{ $nama }}</p>
                                        <p class="text-[9px] text-[#5F7D9C] uppercase">{{ $items->count() }} Transaksi</p>
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
                                    @endphp
                                    <div class="bg-white p-3 rounded-lg border {{ $isOverdue ? 'border-red-200 bg-red-50/50' : 'border-[#D4E0E8]' }} flex items-center justify-between">
                                        <div class="flex-1">
                                            <p class="text-xs font-bold text-[#1E3A5F]">{{ $debt->keterangan ?: 'Tanpa Keterangan' }} @if($isOverdue) <span class="text-[8px] bg-red-500 text-white px-1.5 py-0.5 rounded-full ml-1">Telat!</span> @endif</p>
                                            <p class="text-sm font-black text-blue-600">Rp {{ number_format($debt->jumlah_utang, 0, ',', '.') }}</p>
                                            <p class="text-[9px] text-slate-400 mt-1">📅 {{ $debt->created_at->format('d M Y') }} @if($debt->jatuh_tempo) | ⏳ {{ \Carbon\Carbon::parse($debt->jatuh_tempo)->format('d M Y') }} @endif</p>
                                        </div>
                                        <div class="flex gap-2">
                                            @if($wa)
                                                <a href="https://wa.me/{{ $wa }}?text={{ urlencode('Halo ' . $nama . ', mau ingetin piutang Rp ' . number_format($debt->jumlah_utang, 0, ',', '.') . '. Nuhun!') }}" target="_blank" class="p-2 rounded-lg border border-[#D4E0E8]"><img src="{{ asset('whatsapp.png') }}" class="w-4 h-4"></a>
                                            @endif
                                            <form action="/update-status/{{ $debt->id }}" method="POST">@csrf <button class="p-2 rounded-lg border border-[#D4E0E8] text-emerald-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></button></form>
                                            <form action="/hapus-utang/{{ $debt->id }}" method="POST" onsubmit="return confirm('Hapus permanen?')">@csrf @method('DELETE') <button class="p-2 rounded-lg border border-[#D4E0E8] text-red-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button></form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </details>
                    @empty
                        <div class="text-center py-12 bg-white rounded-xl border border-dashed border-[#D4E0E8]"><p class="text-sm text-[#5F7D9C]">Lunas semua, mantap! ✨</p></div>
                    @endforelse
                </div>

                <div class="space-y-3" x-show="activeTab === 'riwayat'" x-cloak>
                    @forelse($historyDebts as $nama => $items)
                        <details class="group bg-white border border-[#D4E0E8] rounded-xl overflow-hidden opacity-80">
                            <summary class="flex items-center justify-between p-3 cursor-pointer list-none">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-slate-200 text-slate-500 rounded-lg flex items-center justify-center font-bold text-xs">{{ strtoupper(substr($nama, 0, 1)) }}</div>
                                    <p class="font-bold text-[#1E3A5F] text-sm">{{ $nama }}</p>
                                </div>
                                <p class="text-xs font-bold text-emerald-600 uppercase">Lunas ✅</p>
                            </summary>
                            <div class="p-3 bg-slate-50 border-t border-[#D4E0E8] space-y-2">
                                @foreach($items as $debt)
                                    <div class="bg-white p-3 rounded-lg border border-[#D4E0E8] flex items-center justify-between">
                                        <div class="flex-1">
                                            <p class="text-xs font-bold text-slate-400 line-through">{{ $debt->keterangan ?: 'Tanpa Keterangan' }}</p>
                                            <p class="text-sm font-black text-slate-400">Rp {{ number_format($debt->jumlah_utang, 0, ',', '.') }}</p>
                                        </div>
                                        <form action="/update-status/{{ $debt->id }}" method="POST">@csrf <button class="text-[10px] bg-[#1E3A5F] text-white px-3 py-1 rounded-full font-bold uppercase">Batal Lunas</button></form>
                                    </div>
                                @endforeach
                            </div>
                        </details>
                    @empty
                        <div class="text-center py-12 bg-white rounded-xl border border-dashed border-[#D4E0E8]"><p class="text-sm text-[#5F7D9C]">Belum ada sejarah pelunasan.</p></div>
                    @endforelse
                </div>
            </div>

            <div class="max-w-2xl mx-auto mt-8 text-center">
                <p class="text-[10px] text-[#5F7D9C]">BAYU • Bayar, Yuk! • Khusus UMKM</p>
            </div>
        </div>
    </div>
</x-app-layout>