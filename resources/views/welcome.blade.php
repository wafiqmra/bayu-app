<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>BAYU - Bayar, Yuk! - Catat Piutang Warung</title>
    
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
<body class="min-h-screen w-full overflow-x-hidden">
    
    <!-- Background circles - global -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-[800px] h-[800px] bg-[#B8D1E5] rounded-full opacity-30 blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-[800px] h-[800px] bg-[#9BB8D4] rounded-full opacity-30 blur-3xl"></div>
    </div>

    <!-- MOBILE VERSION - background putih full -->
    <div class="block md:hidden w-full min-h-screen relative z-10">
        <div class="w-full min-h-screen flex flex-col bg-white/95 backdrop-blur-sm">
            <!-- Header -->
            <div class="px-5 pt-6 pb-2">
                <div class="flex justify-between items-center">
                    <div class="bg-[#F0F5FA] px-3 py-1.5 rounded-full text-[10px] text-[#5F7D9C] flex items-center gap-1">
                        <span class="w-1.5 h-1.5 bg-[#1E3A5F] rounded-full"></span>
                        <span>siap bantu catat</span>
                    </div>
                    <div class="bg-[#F0F5FA] px-3 py-1.5 rounded-full text-[10px] text-[#5F7D9C]">
                        v1.0
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 px-5 flex flex-col justify-center">
                <div class="mb-6">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-7xl">💰</span>
                        <span class="text-4xl">✨</span>
                    </div>
                    <h1 class="text-6xl font-bold text-[#1E3A5F] tracking-tight">BAYU</h1>
                    <p class="text-lg text-[#5F7D9C] mt-1 font-medium">Bayar, Yuk!</p>
                </div>

                <div class="mb-5">
                    <p class="text-2xl text-[#1E3A5F] font-medium leading-tight">catat piutang warung,</p>
                    <p class="text-2xl text-[#1E3A5F] font-medium leading-tight">santai aja.</p>
                </div>

                <div class="flex flex-wrap gap-2 mb-6">
                    <span class="bg-[#F0F5FA] px-3 py-1.5 rounded-full text-xs text-[#1E3A5F] flex items-center gap-1">
                        <span>⏰</span> gak lupa nagih
                    </span>
                    <span class="bg-[#F0F5FA] px-3 py-1.5 rounded-full text-xs text-[#1E3A5F] flex items-center gap-1">
                        <span>✨</span> gratis
                    </span>
                    <span class="bg-[#F0F5FA] px-3 py-1.5 rounded-full text-xs text-[#1E3A5F] flex items-center gap-1">
                        <span>🔒</span> aman
                    </span>
                </div>

                <div class="space-y-3 mb-6">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block w-full bg-[#1E3A5F] text-white text-center py-4 rounded-xl font-semibold text-base">
                            <span class="flex items-center justify-center gap-2">
                                <span>📋</span> Buka Dashboard
                            </span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full bg-[#1E3A5F] text-white text-center py-4 rounded-xl font-semibold text-base">
                            <span class="flex items-center justify-center gap-2">
                                <span>🔐</span> Masuk / Login
                            </span>
                        </a>
                        <a href="{{ route('register') }}" class="block w-full bg-white text-[#1E3A5F] text-center py-4 rounded-xl font-semibold text-base border-2 border-[#B8D1E5]">
                            <span class="flex items-center justify-center gap-2">
                                <span>✨</span> Daftar Akun Baru
                            </span>
                        </a>
                    @endauth
                </div>

                <div class="grid grid-cols-3 gap-2 mb-6">
                    <div class="bg-[#F0F5FA] rounded-xl p-3">
                        <div class="text-2xl mb-1 text-[#1E3A5F]">📝</div>
                        <div class="font-semibold text-[#1E3A5F] text-xs">Catat</div>
                        <div class="text-[9px] text-[#5F7D9C] mt-0.5">utang piutang</div>
                    </div>
                    <div class="bg-[#F0F5FA] rounded-xl p-3">
                        <div class="text-2xl mb-1 text-[#1E3A5F]">⏰</div>
                        <div class="font-semibold text-[#1E3A5F] text-xs">Ingetin</div>
                        <div class="text-[9px] text-[#5F7D9C] mt-0.5">otomatis nagih</div>
                    </div>
                    <div class="bg-[#F0F5FA] rounded-xl p-3">
                        <div class="text-2xl mb-1 text-[#1E3A5F]">🔒</div>
                        <div class="font-semibold text-[#1E3A5F] text-xs">Aman</div>
                        <div class="text-[9px] text-[#5F7D9C] mt-0.5">terenkripsi</div>
                    </div>
                </div>

                <div class="bg-[#F0F5FA] rounded-xl p-4 mb-4">
                    <h3 class="text-sm font-semibold text-[#1E3A5F] mb-3 flex items-center gap-1">
                        <span>📌</span> Cara kerjanya:
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 bg-[#1E3A5F] text-white rounded-full flex items-center justify-center text-xs font-bold">1</span>
                            <span class="text-sm text-[#5F7D9C]">Catat utang pelanggan</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 bg-[#1E3A5F] text-white rounded-full flex items-center justify-center text-xs font-bold">2</span>
                            <span class="text-sm text-[#5F7D9C]">Dapet notifikasi nagih</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 bg-[#1E3A5F] text-white rounded-full flex items-center justify-center text-xs font-bold">3</span>
                            <span class="text-sm text-[#5F7D9C]">Pelanggan bayar, beres!</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-5 pb-6 pt-2">
                <div class="text-center">
                    <p class="text-[10px] text-[#5F7D9C] leading-relaxed">
                        khusus pemilik warung & umkm<br>
                        © 2024 BAYU • Bayar, Yuk!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- DESKTOP VERSION - SPLIT BACKGROUND -->
    <div class="hidden md:block w-full min-h-screen relative z-10">
        <!-- Split background dengan lebar tetap proporsional -->
        <div class="fixed inset-0 flex pointer-events-none">
            <div class="w-1/2 bg-white"></div>
            <div class="w-1/2 bg-[#F0F5FA]"></div>
        </div>
        
        <!-- Content container dengan padding besar -->
        <div class="relative z-20 w-full min-h-screen flex items-center justify-center px-8 lg:px-16 xl:px-24">
            <!-- Konten lebar penuh -->
            <div class="w-full">
                <!-- Split layout konten -->
                <div class="flex min-h-[700px]">
                    
                    <!-- LEFT SIDE - 50% -->
                    <div class="w-1/2 pr-8 lg:pr-12 xl:pr-16 flex flex-col justify-between">
                        <div>
                            <!-- Header -->
                            <div class="flex items-center justify-between mb-12">
                                <div class="flex items-center gap-4">
                                    <span class="font-medium text-[#1E3A5F] text-lg">Login</span>
                                    <span class="text-[#B8D1E5] text-xl">|</span>
                                    <a href="{{ route('register') }}" class="text-[#5F7D9C] hover:text-[#1E3A5F] text-lg transition">Daftar</a>
                                </div>
                                <span class="text-sm text-[#5F7D9C] bg-[#F0F5FA] px-4 py-2 rounded-full">✨ baru rilis</span>
                            </div>
                            
                            <!-- Logo -->
                            <div class="mb-12">
                                <div class="flex items-center gap-4 mb-4">
                                    <span class="text-8xl">💰</span>
                                </div>
                                <h1 class="text-8xl font-bold text-[#1E3A5F] tracking-tight leading-none mb-3">BAYU</h1>
                                <p class="text-xl text-[#5F7D9C] font-medium">Bayar, Yuk! — solusi catat piutang</p>
                            </div>
                            
                            <!-- Features -->
                            <div class="space-y-6">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-[#F0F5FA] rounded-xl flex items-center justify-center text-2xl">📝</div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-[#1E3A5F]">Catat otomatis</h3>
                                        <p class="text-base text-[#5F7D9C]">Input utang piutang cepat, ga pake ribet</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-[#F0F5FA] rounded-xl flex items-center justify-center text-2xl">⏰</div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-[#1E3A5F]">Pengingat nagih</h3>
                                        <p class="text-base text-[#5F7D9C]">Dapet notifikasi pas waktunya nagih</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-[#F0F5FA] rounded-xl flex items-center justify-center text-2xl">🔒</div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-[#1E3A5F]">Data aman</h3>
                                        <p class="text-base text-[#5F7D9C]">Terenskripsi, cuma kamu yang bisa akses</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Footer kiri -->
                        <div class="mt-auto">
                            <p class="text-sm text-[#5F7D9C] border-t border-[#D4E0E8] pt-6">
                                © 2024 BAYU • khusus pemilik warung & umkm
                            </p>
                        </div>
                    </div>
                    
                    <!-- RIGHT SIDE - 50% -->
                    <div class="w-1/2 pl-8 lg:pl-12 xl:pl-16 flex flex-col justify-between">
                        <!-- Tagline -->
                        <div class="text-right mb-12">
                            <span class="inline-block bg-white px-4 py-2 rounded-full text-sm text-[#5F7D9C] mb-4 shadow-sm">
                                #santaiAja
                            </span>
                            <p class="text-4xl text-[#1E3A5F] font-medium leading-tight">catat piutang warung,</p>
                            <p class="text-4xl text-[#1E3A5F] font-medium leading-tight">santai aja.</p>
                            <div class="flex items-center justify-end gap-3 mt-4">
                                <span class="text-sm bg-white px-4 py-2 rounded-full text-[#5F7D9C] shadow-sm">⏰ gak bakal lupa</span>
                                <span class="text-sm bg-white px-4 py-2 rounded-full text-[#5F7D9C] shadow-sm">✨ gratis selamanya</span>
                            </div>
                        </div>
                        
                        <!-- Buttons -->
                        <div class="w-full max-w-lg ml-auto mb-12">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="block w-full bg-[#1E3A5F] text-white text-center py-5 rounded-xl font-semibold text-xl shadow-lg">
                                    <span class="flex items-center justify-center gap-3">
                                        <span>📋</span> Buka Dashboard
                                    </span>
                                </a>
                            @else
                                <div class="space-y-4">
                                    <a href="{{ route('login') }}" class="block w-full bg-[#1E3A5F] text-white text-center py-5 rounded-xl font-semibold text-xl shadow-lg">
                                        <span class="flex items-center justify-center gap-3">
                                            <span>🔐</span> Masuk / Login
                                        </span>
                                    </a>
                                    <a href="{{ route('register') }}" class="block w-full bg-white text-[#1E3A5F] text-center py-5 rounded-xl font-semibold text-xl border-2 border-[#B8D1E5]">
                                        <span class="flex items-center justify-center gap-3">
                                            <span>✨</span> Daftar Akun Baru
                                        </span>
                                    </a>
                                </div>
                            @endauth
                        </div>
                        
                        <!-- Cara kerja -->
                        <div class="bg-white rounded-2xl p-6 border border-[#D4E0E8]">
                            <h3 class="text-lg font-semibold text-[#1E3A5F] mb-4 flex items-center gap-2">
                                <span>📌</span> Gampang kok:
                            </h3>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center">
                                    <div class="w-10 h-10 bg-[#F0F5FA] rounded-full flex items-center justify-center text-xl mx-auto mb-2">1</div>
                                    <p class="text-sm text-[#1E3A5F] font-medium">Catat</p>
                                    <p class="text-xs text-[#5F7D9C]">utang pelanggan</p>
                                </div>
                                <div class="text-center">
                                    <div class="w-10 h-10 bg-[#F0F5FA] rounded-full flex items-center justify-center text-xl mx-auto mb-2">2</div>
                                    <p class="text-sm text-[#1E3A5F] font-medium">Ingetin</p>
                                    <p class="text-xs text-[#5F7D9C]">dapet notif</p>
                                </div>
                                <div class="text-center">
                                    <div class="w-10 h-10 bg-[#F0F5FA] rounded-full flex items-center justify-center text-xl mx-auto mb-2">3</div>
                                    <p class="text-sm text-[#1E3A5F] font-medium">Beres</p>
                                    <p class="text-xs text-[#5F7D9C]">pelanggan bayar</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Footer kanan -->
                        <div class="mt-8 text-right">
                            <p class="text-sm text-[#5F7D9C]">
                                siap bantu warung & umkm Indonesia
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blade directives -->
    <!-- @auth @else @endauth {{ url('/dashboard') }} {{ route('login') }} {{ route('register') }} -->
</body>
</html>