<x-app-layout>
    <x-slot name="header">
        <div class="bg-white/95 backdrop-blur-sm border-b border-[#D4E0E8]">
            <div class="w-full px-4 sm:px-6 lg:px-8 py-4">
                <h2 class="font-bold text-xl text-[#1E3A5F] leading-tight flex items-center gap-2">
                    <span class="text-2xl">💰</span> 
                    Kelola Piutangs
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
                <div class="block sm:hidden overflow-x-auto pb-2 -mx-4 px-4">
                    <div class="flex gap-3 min-w-max">
                        <div class="w-48 bg-[#1E3A5F] p-4 rounded-xl shadow-sm flex-shrink-0">
                            <div class="flex items-center justify-between mb-1">
                                <p class="text-[10px] font-medium uppercase text-[#B8D1E5] tracking-wider">Total Piutang</p>
                                <span class="text-lg text-white/70">💰</span>
                            </div>
                            <h3 class="text-xl font-bold text-white">Rp {{ number_format($stats['total_piutang'] ?? 0, 0, ',', '.') }}</h3>
                        </div>

                        <div class="w-48 bg-white p-4 rounded-xl shadow-sm border border-[#D4E0E8] flex-shrink-0">
                            <div class="flex items-center justify-between mb-1">
                                <p class="text-[10px] font-medium uppercase text-[#5F7D9C] tracking-wider">Sudah Kembali</p>
                                <span class="text-lg text-[#5F7D9C]">✨</span>
                            </div>
                            <h3 class="text-xl font-bold text-[#1E3A5F]">Rp {{ number_format($stats['total_kembali'] ?? 0, 0, ',', '.') }}</h3>
                        </div>

                        <div class="w-48 bg-white p-4 rounded-xl shadow-sm border border-[#D4E0E8] flex-shrink-0">
                            <div class="flex items-center justify-between mb-1">
                                <p class="text-[10px] font-medium uppercase text-[#5F7D9C] tracking-wider">Peminjam Aktif</p>
                                <span class="text-lg text-[#5F7D9C]">👥</span>
                            </div>
                            <h3 class="text-xl font-bold text-[#1E3A5F]">{{ $stats['peminjam_aktif'] ?? 0 }} Orang</h3>
                        </div>
                    </div>
                </div>

                <div class="hidden sm:grid sm:grid-cols-3 gap-3">
                    <div class="bg-[#1E3A5F] p-4 rounded-xl shadow-sm">
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-[10px] font-medium uppercase text-[#B8D1E5] tracking-wider">Total Piutang</p>
                            <span class="text-lg text-white/70">💰</span>
                        </div>
                        <h3 class="text-xl font-bold text-white">Rp {{ number_format($stats['total_piutang'] ?? 0, 0, ',', '.') }}</h3>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow-sm border border-[#D4E0E8]">
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-[10px] font-medium uppercase text-[#5F7D9C] tracking-wider">Sudah Kembali</p>
                            <span class="text-lg text-[#5F7D9C]">✨</span>
                        </div>
                        <h3 class="text-xl font-bold text-[#1E3A5F]">Rp {{ number_format($stats['total_kembali'] ?? 0, 0, ',', '.') }}</h3>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow-sm border border-[#D4E0E8]">
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-[10px] font-medium uppercase text-[#5F7D9C] tracking-wider">Peminjam Aktif</p>
                            <span class="text-lg text-[#5F7D9C]">👥</span>
                        </div>
                        <h3 class="text-xl font-bold text-[#1E3A5F]">{{ $stats['peminjam_aktif'] ?? 0 }} Orang</h3>
                    </div>
                </div>
            </div>

            <div class="max-w-2xl mx-auto mb-6">
                <div class="bg-white rounded-xl shadow-sm border border-[#D4E0E8] overflow-hidden">
                    <div class="p-5"
                         x-data="{ 
                            nama: '', 
                            wa: '', 
                            contacts: {{ $contacts->toJson() }},
                            init() {
                                this.$watch('nama', (value) => {
                                    if (value.length > 0) {
                                        let match = this.contacts.find(c => 
                                            c.nama_peminjam.toLowerCase() === value.trim().toLowerCase()
                                        );
                                        if (match) { this.wa = match.nomor_wa; }
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
                                        class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 outline-none transition bg-white text-sm" 
                                        placeholder="Cth: Bu Sari">
                                    <datalist id="peminjam_list">
                                        @foreach($contacts as $contact) <option value="{{ $contact->nama_peminjam }}"> @endforeach
                                    </datalist>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-medium text-[#5F7D9C] mb-1">WhatsApp</label>
                                    <input type="tel" name="nomor_wa" x-model="wa"
                                        class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 outline-none transition bg-white text-sm" 
                                        placeholder="08xxxxxxxxxx">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[10px] font-medium text-[#5F7D9C] mb-1">Jumlah (Rp)</label>
                                    <input type="number" name="jumlah_utang" required
                                        class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 outline-none transition bg-white text-sm" 
                                        placeholder="50000">
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
                                    class="w-full border border-[#D4E0E8] rounded-lg p-2.5 focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 outline-none transition bg-white text-sm" 
                                    placeholder="Buat apa? (opsional)">
                            </div>

                            <button type="submit" 
                                class="w-full bg-[#1E3A5F] hover:bg-[#0F2A47] text-white text-center py-3 rounded-lg font-medium text-sm transition-all shadow-sm active:scale-[0.98] mt-2">
                                <span class="flex items-center justify-center gap-2">
                                    <span>💰</span> Catat Utang Baru
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="max-w-2xl mx-auto">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-sm font-bold text-[#1E3A5F] flex items-center gap-2">
                        <span>👥</span> Daftar Peminjam
                    </h2>
                    <span class="text-[10px] bg-[#1E3A5F]/10 text-[#1E3A5F] px-2 py-1 rounded-full">
                        {{ $groupedDebts->count() }} peminjam
                    </span>
                </div>
                
                <div class="space-y-2">
                    @forelse($groupedDebts as $nama => $items)
                        @php
                            $nomorTujuan = $items->first()->nomor_wa;
                            $waFormatted = $nomorTujuan;
                            if ($waFormatted && str_starts_with($waFormatted, '0')) { $waFormatted = '62' . substr($waFormatted, 1); }
                            $totalUtang = $items->where('status', 'belum_lunas')->sum('jumlah_utang');
                        @endphp

                        <details class="group bg-white border border-[#D4E0E8] rounded-xl overflow-hidden shadow-sm">
                            <summary class="flex items-center justify-between p-3 cursor-pointer list-none">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-[#1E3A5F] text-white rounded-lg flex items-center justify-center font-bold text-sm">
                                        {{ strtoupper(substr($nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-medium text-[#1E3A5F] text-sm">{{ $nama }}</p>
                                        <p class="text-[9px] text-[#5F7D9C]">{{ $items->count() }} transaksi</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <p class="font-bold text-[#1E3A5F] text-sm">Rp {{ number_format($totalUtang, 0, ',', '.') }}</p>
                                    <svg class="w-4 h-4 text-[#B8D1E5] group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </summary>

                            <div class="p-3 bg-[#F0F5FA] border-t border-[#D4E0E8] space-y-2">
                                @foreach($items as $debt)
                                    @php
                                        $isOverdue = $debt->jatuh_tempo && \Carbon\Carbon::parse($debt->jatuh_tempo)->isPast() && $debt->status != 'lunas';
                                        $pesan = $isOverdue 
                                            ? "Halo {$nama}, mau ngingetin utang Rp " . number_format($debt->jumlah_utang, 0, ',', '.') . " untuk '{$debt->keterangan}' sudah LEWAT JATUH TEMPO pada " . \Carbon\Carbon::parse($debt->jatuh_tempo)->translatedFormat('d F Y') . ". Mohon segera dibayar ya! 🙏"
                                            : "Halo {$nama}, mau ngingetin catatan piutang di BAYU sebesar Rp " . number_format($debt->jumlah_utang, 0, ',', '.') . " untuk '{$debt->keterangan}'. Mohon dicek ya, nuhun! 🙏";
                                        $linkWA = $waFormatted ? "https://wa.me/{$waFormatted}?text=" . urlencode($pesan) : null;
                                    @endphp

                                    <div class="bg-white p-3 rounded-lg border {{ $isOverdue ? 'border-red-200 bg-red-50/50' : 'border-[#D4E0E8]' }} flex items-center justify-between gap-2">
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 mb-0.5">
                                                <p class="text-xs font-medium {{ $debt->status == 'lunas' ? 'line-through text-[#5F7D9C]' : 'text-[#1E3A5F]' }} truncate">
                                                    {{ $debt->keterangan ?: 'Tanpa Keterangan' }}
                                                </p>
                                                @if($isOverdue)
                                                    <span class="text-[8px] bg-red-500 text-white px-1.5 py-0.5 rounded-full shrink-0">Telat</span>
                                                @endif
                                            </div>
                                            <p class="text-sm font-bold text-[#1E3A5F]">Rp {{ number_format($debt->jumlah_utang, 0, ',', '.') }}</p>
                                            <div class="flex flex-col gap-0.5 mt-1">
                                                <p class="text-[9px] text-[#5F7D9C] flex items-center gap-1">
                                                    <span>📅</span> Dicatat: {{ \Carbon\Carbon::parse($debt->created_at)->translatedFormat('d F Y') }}
                                                </p>
                                                @if($debt->jatuh_tempo)
                                                    <p class="text-[9px] {{ $isOverdue ? 'text-red-500 font-medium' : 'text-[#5F7D9C]' }} flex items-center gap-1">
                                                        <span>⏳</span> Janji: {{ \Carbon\Carbon::parse($debt->jatuh_tempo)->translatedFormat('d F Y') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="flex gap-2 shrink-0 items-center">
                                            @if($debt->nomor_wa && $debt->status != 'lunas' && $linkWA)
                                                <a href="{{ $linkWA }}" target="_blank" 
                                                   class="p-2 rounded-lg border border-[#D4E0E8] bg-white hover:bg-emerald-50 transition-all flex items-center justify-center">
                                                    <img src="{{ asset('whatsapp.png') }}" alt="WA" class="w-5 h-5 object-contain">
                                                </a>
                                            @endif
                                            
                                            <form action="/update-status/{{ $debt->id }}" method="POST">
                                                @csrf
                                                <button class="p-2 rounded-lg border {{ $debt->status == 'lunas' ? 'bg-[#1E3A5F] text-white border-[#1E3A5F]' : 'border-[#D4E0E8] bg-white text-[#1E3A5F] hover:bg-[#1E3A5F] hover:text-white' }} transition-all flex items-center justify-center">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                            
                                            <form action="/hapus-utang/{{ $debt->id }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                                @csrf @method('DELETE')
                                                <button class="p-2 rounded-lg border border-red-100 bg-red-50 text-red-500 hover:bg-red-100 hover:text-red-600 transition-all flex items-center justify-center">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </details>
                    @empty
                        <div class="text-center py-12 bg-white rounded-xl border border-dashed border-[#D4E0E8]">
                            <span class="text-4xl block mb-2">💰</span>
                            <p class="text-sm text-[#5F7D9C]">Belum ada yang ngutang.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="max-w-2xl mx-auto mt-8 text-center">
                <p class="text-[10px] text-[#5F7D9C]">
                    BAYU • Bayar, Yuk! • khusus pemilik warung & umkm
                </p>
            </div>
        </div>
    </div>
</x-app-layout>