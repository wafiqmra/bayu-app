<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAYU - Bayar, Yuk! - Catat Piutang Warung</title>
    
    <!-- Favicon - logo di tab browser -->
    <link rel="icon" type="image/png" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ctext x='50' y='90' font-size='90' text-anchor='middle' fill='%235C4E42'%3E💰%3C/text%3E%3C/svg%3E">
    <link rel="apple-touch-icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ctext x='50' y='90' font-size='90' text-anchor='middle' fill='%235C4E42'%3E💰%3C/text%3E%3C/svg%3E">
    
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
        
        a, button {
            transition: all 0.2s ease;
        }
    </style>
</head>
<body class="bg-[#F5F0E9] min-h-screen">
    
    <!-- Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-[#E8E0D5] rounded-full opacity-20 blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-[500px] h-[500px] bg-[#D9D0C2] rounded-full opacity-20 blur-3xl"></div>
    </div>

    <!-- ========== MOBILE VERSION (PORTRAIT) ========== -->
    <div class="block md:hidden min-h-screen relative z-10">
        <div class="min-h-screen flex items-center justify-center px-4 py-6">
            <div class="w-full max-w-[400px] mx-auto">
                
                <!-- Card -->
                <div class="bg-[#FDF9F5] rounded-3xl shadow-xl border border-[#E0D5C8] overflow-hidden">
                    <div class="p-8">
                        
                        <!-- Logo section -->
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center mb-3">
                                <span class="text-7xl drop-shadow-lg">💰</span>
                            </div>
                            
                            <h1 class="text-6xl font-bold text-[#5C4E42] tracking-tight leading-none">
                                BAYU
                            </h1>
                            
                            <!-- Tagline Bayar, Yuk! -->
                            <div class="bg-[#E8DED3] inline-block px-4 py-1 rounded-full mt-2">
                                <span class="text-sm font-medium text-[#4A3E34]">Bayar, Yuk!</span>
                            </div>
                            
                            <div class="flex justify-center my-4">
                                <div class="w-16 h-1 bg-[#CBB9A8] rounded-full"></div>
                            </div>
                            
                            <p class="text-[#5C4E42] text-lg max-w-xs mx-auto font-medium">
                                catat piutang warung,<br>santai aja.
                            </p>
                            
                            <p class="text-[#8B7E6F] text-xs mt-2">
                                gak bakal lupa nagih • gratis
                            </p>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-8 space-y-3">
                            @auth
                                <a href="{{ url('/dashboard') }}" 
                                   class="block w-full bg-[#5C4E42] hover:bg-[#4A3E34] text-white text-center px-6 py-4 rounded-xl font-semibold text-base shadow-lg">
                                    <span class="flex items-center justify-center gap-2">
                                        <span>📋</span>
                                        <span>Buka Dashboard</span>
                                        <span>→</span>
                                    </span>
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="block w-full bg-[#5C4E42] hover:bg-[#4A3E34] text-white text-center px-6 py-4 rounded-xl font-semibold text-base shadow-lg">
                                    <span class="flex items-center justify-center gap-2">
                                        <span>🔐</span>
                                        <span>Masuk / Login</span>
                                    </span>
                                </a>
                                
                                <a href="{{ route('register') }}" 
                                   class="block w-full bg-[#E8DED3] hover:bg-[#D9CBBE] text-[#4A3E34] text-center px-6 py-4 rounded-xl font-semibold text-base border-2 border-[#CBB9A8]">
                                    <span class="flex items-center justify-center gap-2">
                                        <span>✨</span>
                                        <span>Daftar Akun Baru</span>
                                    </span>
                                </a>
                            @endauth
                        </div>

                        <!-- Features -->
                        <div class="mt-8 grid grid-cols-2 gap-3">
                            <div class="bg-[#F5F0E9] rounded-xl py-4 text-center border border-[#D9CBBE]">
                                <div class="text-3xl text-[#5C4E42] mb-1">📝</div>
                                <div class="font-semibold text-[#5C4E42] text-sm">Catat</div>
                                <div class="text-xs text-[#8B7E6F]">utang</div>
                            </div>
                            
                            <div class="bg-[#F5F0E9] rounded-xl py-4 text-center border border-[#D9CBBE]">
                                <div class="text-3xl text-[#5C4E42] mb-1">⏰</div>
                                <div class="font-semibold text-[#5C4E42] text-sm">Ingetin</div>
                                <div class="text-xs text-[#8B7E6F]">nagih</div>
                            </div>
                            
                            <div class="bg-[#F5F0E9] rounded-xl py-4 text-center border border-[#D9CBBE] col-span-2">
                                <div class="text-3xl text-[#5C4E42] mb-1">🔒</div>
                                <div class="font-semibold text-[#5C4E42] text-sm">Aman</div>
                                <div class="text-xs text-[#8B7E6F]">data terjaga</div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="mt-6 text-center">
                            <p class="text-xs text-[#8B7E6F]">khusus pemilik warung & umkm</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== DESKTOP VERSION (LANDSCAPE) ========== -->
    <div class="hidden md:block min-h-screen relative z-10">
        <div class="min-h-screen flex items-center justify-center px-8 py-8">
            <div class="w-full max-w-5xl mx-auto">
                
                <!-- Card landscape -->
                <div class="bg-[#FDF9F5] rounded-3xl shadow-xl border border-[#E0D5C8] overflow-hidden">
                    <div class="flex flex-row">
                        
                        <!-- LEFT SIDE -->
                        <div class="w-2/5 p-12 flex flex-col justify-center bg-[#F5F0E9]/30">
                            <div class="text-center md:text-left">
                                <span class="text-8xl drop-shadow-lg block mb-4">💰</span>
                                
                                <h1 class="text-7xl font-bold text-[#5C4E42] tracking-tight leading-none mb-2">
                                    BAYU
                                </h1>
                                
                                <!-- Tagline Bayar, Yuk! -->
                                <div class="bg-[#E8DED3] inline-block px-5 py-2 rounded-full mb-4">
                                    <span class="text-lg font-medium text-[#4A3E34]">Bayar, Yuk!</span>
                                </div>
                                
                                <div class="w-20 h-1 bg-[#CBB9A8] rounded-full mb-5"></div>
                                
                                <p class="text-[#5C4E42] text-2xl font-medium mb-2">
                                    catat piutang warung,<br>santai aja.
                                </p>
                                
                                <p class="text-[#8B7E6F] text-base">
                                    gak bakal lupa nagih • gratis selamanya
                                </p>
                                
                                <!-- Testimonial -->
                                <div class="mt-8 bg-white/50 rounded-xl p-4 border border-[#D9CBBE]">
                                    <p class="text-[#5C4E42] text-sm italic">
                                        "Buat warung kecil kayak aku, BAYU ngebantu banget."
                                    </p>
                                    <p class="text-[#8B7E6F] text-xs mt-1 font-medium">
                                        — Bu Sari, Warung Sari
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- RIGHT SIDE -->
                        <div class="w-3/5 p-12">
                            <!-- Buttons -->
                            <div class="mb-10">
                                @auth
                                    <a href="{{ url('/dashboard') }}" 
                                       class="inline-block w-full bg-[#5C4E42] hover:bg-[#4A3E34] text-white text-center px-8 py-5 rounded-xl font-bold text-lg shadow-xl">
                                        <span class="flex items-center justify-center gap-3">
                                            <span class="text-2xl">📋</span>
                                            <span>Buka Dashboard</span>
                                            <span class="text-2xl">→</span>
                                        </span>
                                    </a>
                                @else
                                    <div class="flex flex-row gap-4">
                                        <a href="{{ route('login') }}" 
                                           class="flex-1 bg-[#5C4E42] hover:bg-[#4A3E34] text-white text-center px-6 py-5 rounded-xl font-bold text-lg shadow-xl">
                                            <span class="flex items-center justify-center gap-2">
                                                <span class="text-2xl">🔐</span>
                                                <span>Login</span>
                                            </span>
                                        </a>
                                        
                                        <a href="{{ route('register') }}" 
                                           class="flex-1 bg-[#E8DED3] hover:bg-[#D9CBBE] text-[#4A3E34] text-center px-6 py-5 rounded-xl font-bold text-lg border-2 border-[#CBB9A8]">
                                            <span class="flex items-center justify-center gap-2">
                                                <span class="text-2xl">✨</span>
                                                <span>Daftar</span>
                                            </span>
                                        </a>
                                    </div>
                                @endauth
                            </div>

                            <!-- Features -->
                            <div class="grid grid-cols-3 gap-4 mb-8">
                                <div class="bg-[#F5F0E9] rounded-xl py-5 text-center border border-[#D9CBBE] hover:shadow-md">
                                    <div class="text-4xl text-[#5C4E42] mb-2">📝</div>
                                    <div class="font-semibold text-[#5C4E42] text-base">Catat</div>
                                    <div class="text-sm text-[#8B7E6F]">utang piutang</div>
                                </div>
                                
                                <div class="bg-[#F5F0E9] rounded-xl py-5 text-center border border-[#D9CBBE] hover:shadow-md">
                                    <div class="text-4xl text-[#5C4E42] mb-2">⏰</div>
                                    <div class="font-semibold text-[#5C4E42] text-base">Ingetin</div>
                                    <div class="text-sm text-[#8B7E6F]">waktu nagih</div>
                                </div>
                                
                                <div class="bg-[#F5F0E9] rounded-xl py-5 text-center border border-[#D9CBBE] hover:shadow-md">
                                    <div class="text-4xl text-[#5C4E42] mb-2">🔒</div>
                                    <div class="font-semibold text-[#5C4E42] text-base">Aman</div>
                                    <div class="text-sm text-[#8B7E6F]">data terjaga</div>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="flex items-center justify-between text-sm text-[#8B7E6F] pt-4 border-t border-[#E0D5C8]">
                                <span>🌿 gratis</span>
                                <span>•</span>
                                <span>🌿 gampang</span>
                                <span>•</span>
                                <span>🌿 ga ribet</span>
                            </div>
                            
                            <div class="text-right text-xs text-[#8B7E6F] mt-3">
                                khusus pemilik warung & umkm
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Version badge -->
                <div class="mt-4 text-right">
                    <span class="inline-block text-xs text-[#8B7E6F] bg-[#FDF9F5] px-4 py-2 rounded-full border border-[#D9CBBE] font-medium">
                        ⚡ BAYU = Bayar, Yuk!
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Blade directives -->
    <!-- @auth @else @endauth {{ url('/dashboard') }} {{ route('login') }} {{ route('register') }} -->
</body>
</html>