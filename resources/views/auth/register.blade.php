<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>BAYU - Daftar Akun</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ctext x='50' y='90' font-size='90' text-anchor='middle' fill='%231E3A5F'%3E💰%3C/text%3E%3C/svg%3E">
    
    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</head>
<body class="min-h-screen w-full overflow-x-hidden bg-[#F0F5FA]">
    
    <!-- Background circles -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-[800px] h-[800px] bg-[#B8D1E5] rounded-full opacity-30 blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-[800px] h-[800px] bg-[#9BB8D4] rounded-full opacity-30 blur-3xl"></div>
    </div>

    <!-- Container -->
    <div class="min-h-screen flex items-center justify-center p-4 relative z-10">
        <div class="w-full max-w-md">
            
            <!-- Logo & Brand -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center mb-2">
                    <span class="text-6xl">💰</span>
                </div>
                <h1 class="text-4xl font-bold text-[#1E3A5F] tracking-tight">BAYU</h1>
                <p class="text-sm text-[#5F7D9C] mt-1">Bayar, Yuk! — catat piutang warung</p>
                <div class="flex justify-center mt-2">
                    <div class="w-12 h-0.5 bg-[#B8D1E5] rounded-full"></div>
                </div>
            </div>

            <!-- Card Register -->
            <div class="bg-white rounded-2xl shadow-xl border border-[#D4E0E8] overflow-hidden">
                <div class="p-6 sm:p-8">
                    
                    <!-- Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-[#1E3A5F] font-medium text-sm" />
                            <x-text-input id="name" 
                                class="block mt-1 w-full border-[#D4E0E8] bg-white focus:border-[#1E3A5F] focus:ring focus:ring-[#1E3A5F]/10 rounded-xl px-4 py-3 text-sm" 
                                type="text" 
                                name="name" 
                                :value="old('name')" 
                                required 
                                autofocus 
                                autocomplete="name" 
                            />
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
                        </div>

                        <!-- Email Address -->
                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email')" class="text-[#1E3A5F] font-medium text-sm" />
                            <x-text-input id="email" 
                                class="block mt-1 w-full border-[#D4E0E8] bg-white focus:border-[#1E3A5F] focus:ring focus:ring-[#1E3A5F]/10 rounded-xl px-4 py-3 text-sm" 
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                required 
                                autocomplete="username" 
                            />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <x-input-label for="password" :value="__('Password')" class="text-[#1E3A5F] font-medium text-sm" />
                            <x-text-input id="password" 
                                class="block mt-1 w-full border-[#D4E0E8] bg-white focus:border-[#1E3A5F] focus:ring focus:ring-[#1E3A5F]/10 rounded-xl px-4 py-3 text-sm"
                                type="password"
                                name="password"
                                required 
                                autocomplete="new-password" 
                            />
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-[#1E3A5F] font-medium text-sm" />
                            <x-text-input id="password_confirmation" 
                                class="block mt-1 w-full border-[#D4E0E8] bg-white focus:border-[#1E3A5F] focus:ring focus:ring-[#1E3A5F]/10 rounded-xl px-4 py-3 text-sm"
                                type="password"
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password" 
                            />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
                        </div>

                        <!-- Password Hint -->
                        <div class="mb-6">
                            <p class="text-[10px] text-[#5F7D9C]">
                                Minimal 8 karakter
                            </p>
                        </div>

                        <!-- Submit Button & Login Link -->
                        <div class="flex items-center justify-between">
                            <a class="text-sm text-[#5F7D9C] hover:text-[#1E3A5F] underline-offset-2 hover:underline transition" href="{{ route('login') }}">
                                {{ __('Sudah punya akun?') }}
                            </a>

                            <button type="submit" 
                                class="bg-[#1E3A5F] hover:bg-[#0F2A47] text-white px-6 py-3 rounded-xl font-semibold text-sm transition-all shadow-lg shadow-[#1E3A5F]/20 active:scale-[0.98]">
                                {{ __('Daftar') }}
                            </button>
                        </div>
                    </form>

                    <!-- Footer -->
                    <div class="mt-8 text-center">
                        <p class="text-[10px] text-[#5F7D9C]">
                            BAYU • Bayar, Yuk! • khusus pemilik warung & umkm
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>