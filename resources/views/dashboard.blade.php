<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-600 leading-tight">
            {{ __('💰 Kelola Piutang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded-r-lg shadow-sm" role="alert">
                    <p class="font-bold text-sm">Mantap! {{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 mb-8"
                 x-data="{ 
                    nama: '', 
                    wa: '', 
                    contacts: {{ $contacts->toJson() }},
                    updateWA() {
                        // Cari apakah nama yang diketik cocok dengan data lama
                        let match = this.contacts.find(c => c.nama_peminjam.toLowerCase() === this.nama.toLowerCase());
                        let match = this.contacts.find(c => c.nama_peminjam.toLowerCase() === search);
                        if (match) {
                            this.wa = match.nomor_wa;
                        }
                    }
                 }">
                <form action="/tambah-utang" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1 ml-1">Nama Peminjam</label>
                            <input type="text" name="nama_peminjam" required 
                                x-model="nama" 
                                @input="updateWA()"
                                @change="updateWA()"
                                list="peminjam_list"
                                class="w-full border border-slate-200 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 outline-none transition bg-slate-50" 
                                placeholder="Siapa yang ngutang?">
                            
                            <datalist id="peminjam_list">
                                @foreach($contacts as $contact)
                                    <option value="{{ $contact->nama_peminjam }}">
                                @endforeach
                            </datalist>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1 ml-1">Nomor WhatsApp</label>
                            <input type="tel" name="nomor_wa" 
                                x-model="wa"
                                class="w-full border border-slate-200 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 outline-none transition bg-slate-50" 
                                placeholder="08xxxxxxxxxx">
                        </div>
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
                    @php
                        $nomorTujuan = $items->first()->nomor_wa;
                        $waFormatted = $nomorTujuan;
                        if ($waFormatted && str_starts_with($waFormatted, '0')) {
                            $waFormatted = '62' . substr($waFormatted, 1);
                        }
                    @endphp

                    <details class="group bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all">
                        <summary class="flex justify-between items-center p-5 cursor-pointer list-none select-none">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-2xl flex items-center justify-center font-black">
                                    {{ strtoupper(substr($nama, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900 text-lg">{{ $nama }}</p>
                                    <p class="text-xs text-slate-400 font-bold uppercase">{{ $items->count() }} Transaksi</p>
                                </div>
                            </div>
                            <div class="text-right flex items-center gap-4">
                                <p class="font-black text-blue-600">Rp {{ number_format($items->where('status', 'belum_lunas')->sum('jumlah_utang'), 0, ',', '.') }}</p>
                                <svg class="w-5 h-5 text-slate-300 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </summary>

                        <div class="p-4 bg-slate-50 border-t border-slate-100 space-y-3">
                            @foreach($items as $debt)
                                @php
                                    $pesan = "Halo {$nama}, mau ngingetin catatan piutang di BAYU sebesar Rp " . number_format($debt->jumlah_utang, 0, ',', '.') . " untuk '{$debt->keterangan}'. Mohon dicek ya, nuhun! 🙏";
                                    $linkWA = "https://wa.me/{$waFormatted}?text=" . urlencode($pesan);
                                @endphp

                                <div class="bg-white p-4 rounded-xl border border-slate-100 flex justify-between items-center shadow-sm">
                                    <div class="flex-1">
                                        <p class="text-sm font-bold {{ $debt->status == 'lunas' ? 'line-through text-slate-300' : 'text-slate-700' }}">
                                            {{ $debt->keterangan ?: 'Tanpa Keterangan' }}
                                        </p>
                                        <p class="text-md font-black text-blue-600">Rp {{ number_format($debt->jumlah_utang, 0, ',', '.') }}</p>
                                    </div>
                                    
                                    <div class="flex gap-2">
                                        @if($debt->nomor_wa && $debt->status != 'lunas')
                                            <a href="{{ $linkWA }}" target="_blank" class="p-2 rounded-lg border border-emerald-100 bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-colors" title="Tagih lewat WA">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.417-.003 6.557-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.305 1.652zm6.599-3.835c1.52.909 3.012 1.388 4.73 1.389 5.234 0 9.493-4.259 9.495-9.493.002-5.233-4.257-9.493-9.493-9.493-2.535 0-4.918.988-6.71 2.781-1.791 1.792-2.776 4.176-2.778 6.709-.001 1.839.52 3.255 1.411 4.743l-.944 3.447 3.535-.927zm10.957-5.231c-.3-.15-1.775-.875-2.05-.975-.275-.1-.475-.15-.675.15-.2.3-.775 1.05-.95 1.25-.175.2-.35.225-.65.075-.3-.15-1.266-.467-2.411-1.487-.891-.795-1.492-1.777-1.667-2.076-.175-.3-.019-.463.13-.612.135-.133.3-.35.45-.525.15-.175.2-.3.3-.5s.05-.375-.025-.525c-.075-.15-.675-1.625-.925-2.225-.244-.589-.491-.51-.675-.519-.175-.009-.375-.01-.575-.01s-.525.075-.8.375c-.275.3-1.05 1.025-1.05 2.5s1.075 2.9 1.225 3.1c.15.2 2.116 3.23 5.125 4.532.715.311 1.275.496 1.708.635.717.227 1.369.195 1.885.118.575-.085 1.775-.725 2.025-1.425.25-.7.25-1.3 0-1.425-.075-.125-.275-.2-.575-.35z"/></svg>
                                            </a>
                                        @endif

                                        <form action="/update-status/{{ $debt->id }}" method="POST">
                                            @csrf
                                            <button class="p-2 rounded-lg border {{ $debt->status == 'lunas' ? 'bg-amber-50 text-amber-600' : 'bg-emerald-50 text-emerald-600' }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            </button>
                                        </form>
                                        
                                        <form action="/hapus-utang/{{ $debt->id }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button class="p-2 rounded-lg border border-red-100 text-red-400">
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
                        <p class="text-slate-400 font-bold italic text-sm">Belum ada yang ngutang.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>