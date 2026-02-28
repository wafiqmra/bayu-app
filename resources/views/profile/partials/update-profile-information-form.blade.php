<section class="bg-white rounded-xl shadow-sm border border-[#D4E0E8] overflow-hidden">
    <div class="p-6 sm:p-8">
        <header class="mb-6">
            <h2 class="text-lg font-bold text-[#1E3A5F] flex items-center gap-2">
                <span class="w-1 h-5 bg-[#1E3A5F] rounded-full"></span>
                {{ __('Informasi Profil') }}
            </h2>

            <p class="mt-2 text-sm text-[#5F7D9C]">
                {{ __("Perbarui informasi profil dan email akun kamu.") }}
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
            @csrf
            @method('patch')

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nama Lengkap')" class="text-[#1E3A5F] font-medium text-sm" />
                <x-text-input id="name" 
                    name="name" 
                    type="text" 
                    class="block mt-1 w-full border border-[#D4E0E8] bg-white focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 rounded-lg p-2.5 text-sm" 
                    :value="old('name', $user->name)" 
                    required 
                    autofocus 
                    autocomplete="name" 
                />
                <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('name')" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-[#1E3A5F] font-medium text-sm" />
                <x-text-input id="email" 
                    name="email" 
                    type="email" 
                    class="block mt-1 w-full border border-[#D4E0E8] bg-white focus:border-[#1E3A5F] focus:ring-1 focus:ring-[#1E3A5F]/10 rounded-lg p-2.5 text-sm" 
                    :value="old('email', $user->email)" 
                    required 
                    autocomplete="username" 
                />
                <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-3 p-3 bg-[#F0F5FA] rounded-lg border border-[#D4E0E8]">
                        <p class="text-xs text-[#5F7D9C]">
                            {{ __('Email kamu belum diverifikasi.') }}

                            <button form="send-verification" 
                                class="text-[#1E3A5F] font-medium hover:underline underline-offset-2 transition">
                                {{ __('Kirim ulang email verifikasi') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-xs font-medium text-emerald-600">
                                {{ __('Link verifikasi baru telah dikirim ke email kamu.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4 pt-2">
                <button type="submit" 
                    class="bg-[#1E3A5F] hover:bg-[#0F2A47] text-white px-6 py-2.5 rounded-lg font-medium text-sm transition-all shadow-sm active:scale-[0.98]">
                    {{ __('Simpan') }}
                </button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-emerald-600 flex items-center gap-1"
                    >
                        <span>✅</span> {{ __('Tersimpan.') }}
                    </p>
                @endif
            </div>
        </form>
    </div>
</section>