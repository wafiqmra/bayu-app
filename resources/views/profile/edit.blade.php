<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <!-- Tombol Kembali ke Dashboard - ONLY MOBILE -->
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center gap-2 text-[#5F7D9C] hover:text-[#1E3A5F] transition-all duration-300 hover:-translate-x-1 sm:hidden">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span class="text-sm font-medium">Kembali</span>
                </a>
                <!-- Divider hanya muncul di mobile -->
                <span class="text-[#D4E0E8] sm:hidden">|</span>
                <h2 class="font-bold text-xl text-[#1E3A5F] leading-tight">
                    {{ __('Profile') }}
                </h2>
            </div>
            
            <!-- Info User - Desktop Only -->
            <div class="hidden sm:flex items-center gap-3">
                <div class="text-right">
                    <p class="text-xs text-[#5F7D9C]">{{ Auth::user()->email }}</p>
                    <p class="text-sm font-semibold text-[#1E3A5F]">{{ Auth::user()->name }}</p>
                </div>
                <div class="w-10 h-10 bg-[#1E3A5F] rounded-full flex items-center justify-center text-white font-bold text-lg">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-[#F0F5FA] py-8 sm:py-12" style="font-family: 'Poppins', sans-serif; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Profile Settings -->
            <div class="space-y-6">
                <!-- Update Profile Information -->
                <div class="bg-white rounded-xl shadow-sm border border-[#D4E0E8] overflow-hidden">
                    <div class="p-6">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div class="bg-white rounded-xl shadow-sm border border-[#D4E0E8] overflow-hidden">
                    <div class="p-6">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="bg-white rounded-xl shadow-sm border border-[#D4E0E8] overflow-hidden">
                    <div class="p-6">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-xs text-[#5F7D9C]">
                    BAYU • Bayar, Yuk! • khusus pemilik warung & umkm
                </p>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Add Poppins font to the layout -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
    
    * {
        font-family: 'Poppins', sans-serif !important;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
</style>