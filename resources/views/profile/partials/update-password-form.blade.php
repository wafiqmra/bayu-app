<section class="bg-white rounded-xl shadow-sm border border-[#D4E0E8] overflow-hidden">
    <div class="p-6 sm:p-8">
        <header class="mb-6">
            <h2 class="text-lg font-bold text-[#1E3A5F] flex items-center gap-2">
                <span class="w-1 h-5 bg-[#1E3A5F] rounded-full"></span>
                {{ __('Update Password') }}
            </h2>

            <p class="mt-2 text-sm text-[#5F7D9C]">
                {{ __('Pastikan akun kamu menggunakan password yang kuat dan acak untuk keamanan.') }}
            </p>
        </header>

        <form method="post" action="{{ route('password.update') }}" class="space-y-5">
            @csrf
            @method('put')

            <!-- Current Password -->
            <div>
                <x-input-label for="update_password_current_password" :value="__('Password Saat Ini')" class="text-[#1E3A5F] font-medium text-sm" />
                <x-text-input id="update_password_current_password" 
                    name="current_password" 
                    type="password" 
                    class="block mt-1 w-full border border-[#D4E0E8] bg-white focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 rounded-lg p-2.5 text-sm" 
                    autocomplete="current-password" 
                />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- New Password -->
            <div>
                <x-input-label for="update_password_password" :value="__('Password Baru')" class="text-[#1E3A5F] font-medium text-sm" />
                <x-text-input id="update_password_password" 
                    name="password" 
                    type="password" 
                    class="block mt-1 w-full border border-[#D4E0E8] bg-white focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 rounded-lg p-2.5 text-sm" 
                    autocomplete="new-password" 
                />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-sm text-red-600" />
                
                <!-- Password Hint -->
                <p class="mt-1 text-[10px] text-[#5F7D9C]">
                    Minimal 8 karakter, kombinasi huruf dan angka
                </p>
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Password Baru')" class="text-[#1E3A5F] font-medium text-sm" />
                <x-text-input id="update_password_password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    class="block mt-1 w-full border border-[#D4E0E8] bg-white focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 rounded-lg p-2.5 text-sm" 
                    autocomplete="new-password" 
                />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Security Tips -->
            <div class="bg-[#F0F5FA] rounded-lg p-3 border border-[#D4E0E8]">
                <h4 class="text-xs font-medium text-[#1E3A5F] flex items-center gap-1 mb-1">
                    <span>🔐</span> Tips Keamanan:
                </h4>
                <ul class="text-[10px] text-[#5F7D9C] space-y-0.5 list-disc list-inside">
                    <li>Jangan gunakan password yang sama dengan akun lain</li>
                    <li>Hindari tanggal lahir atau angka yang mudah ditebak</li>
                    <li>Gunakan kombinasi huruf besar, kecil, angka, dan simbol</li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4 pt-2">
                <button type="submit" 
                    class="bg-[#1E3A5F] hover:bg-[#0F2A47] text-white px-6 py-2.5 rounded-lg font-medium text-sm transition-all shadow-sm active:scale-[0.98]">
                    {{ __('Update Password') }}
                </button>

                @if (session('status') === 'password-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-emerald-600 flex items-center gap-1"
                    >
                        <span>✅</span> {{ __('Password diperbarui.') }}
                    </p>
                @endif
            </div>
        </form>
    </div>
</section>