<section class="bg-white rounded-xl shadow-sm border border-[#D4E0E8] overflow-hidden">
    <div class="p-6 sm:p-8">
        <header class="mb-6">
            <h2 class="text-lg font-bold text-red-600 flex items-center gap-2">
                <span class="w-1 h-5 bg-red-600 rounded-full"></span>
                {{ __('Hapus Akun') }}
            </h2>

            <p class="mt-2 text-sm text-[#5F7D9C]">
                {{ __('Setelah akun dihapus, semua data dan sumber daya akan terhapus permanen. Sebelum menghapus, pastikan kamu sudah menyimpan data penting yang ingin disimpan.') }}
            </p>
        </header>

        <!-- Delete Button -->
        <div>
            <button
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-lg font-medium text-sm transition-all shadow-sm active:scale-[0.98] flex items-center gap-2"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                {{ __('Hapus Akun') }}
            </button>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="bg-white rounded-xl p-6 max-w-md mx-auto">
            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-5">
                @csrf
                @method('delete')

                <!-- Icon & Title -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-[#1E3A5F]">
                        {{ __('Yakin mau hapus akun?') }}
                    </h2>
                    <p class="mt-2 text-sm text-[#5F7D9C]">
                        {{ __('Setelah akun dihapus, semua data akan hilang permanen. Masukkan password untuk konfirmasi.') }}
                    </p>
                </div>

                <!-- Password Input -->
                <div class="bg-[#F0F5FA] p-4 rounded-lg border border-[#D4E0E8]">
                    <x-input-label for="password" value="{{ __('Password') }}" class="text-[#1E3A5F] font-medium text-sm mb-1" />
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="block w-full border border-[#D4E0E8] bg-white focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 rounded-lg p-2.5 text-sm"
                        placeholder="{{ __('Masukkan password kamu') }}"
                    />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Warning Text -->
                <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                    <p class="text-xs text-red-600 flex items-start gap-2">
                        <span class="shrink-0">⚠️</span>
                        <span>{{ __('Tindakan ini tidak bisa dibatalkan. Semua data piutang, catatan, dan informasi akun akan hilang selamanya.') }}</span>
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-3 pt-2">
                    <button
                        type="button"
                        x-on:click="$dispatch('close')"
                        class="bg-white hover:bg-[#F0F5FA] text-[#5F7D9C] px-5 py-2.5 rounded-lg font-medium text-sm border border-[#D4E0E8] transition-all"
                    >
                        {{ __('Batal') }}
                    </button>

                    <button
                        type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-lg font-medium text-sm transition-all shadow-sm active:scale-[0.98] flex items-center gap-2"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        {{ __('Hapus Permanen') }}
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</section>