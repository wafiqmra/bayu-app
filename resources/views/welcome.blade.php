<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>BAYU - Catat Piutang Warung</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyfloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }
        .animate-float {
            animation: float 4s ease-in-out infinite;
        }
        
        @keyframes soft-pulse {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }
        .animate-soft-pulse {
            animation: soft-pulse 3s ease-in-out infinite;
        }

        * {
            -webkit-tap-highlight-color: transparent;
        }

        @media (max-width: 640px) {
            a, button {
                min-height: 44px;
                min-width: 44px;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-b from-[#FFF9F0] via-[#FFF2E5] to-[#FFE5D9] min-h-screen relative overflow-x-hidden">
    
    <!-- Soft background decorations -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <!-- Very soft blur circles -->
        <div class="absolute top-0 -right-20 w-[400px] h-[400px] bg-[#FFD9B0] rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float"></div>
        <div class="absolute bottom-0 -left-20 w-[400px] h-[400px] bg-[#B5E5D4] rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/3 w-[300px] h-[300px] bg-[#FFB5B0] rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-float" style="animation-delay: 3s;"></div>
        
        <!-- Very subtle pattern -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23FFB5B0" fill-opacity="0.03"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/svg%3E')]"></div>
    </div>

    <!-- Main content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 md:py-8 lg:py-12 relative z-10 min-h-screen flex items-center">
        
        <!-- Soft card container -->
        <div class="w-full bg-white/70 backdrop-blur-sm rounded-3xl shadow-xl shadow-[#FFB5B0]/20 p-6 sm:p-8 md:p-10 lg:p-12 border border-white/60">
            
            <!-- Logo section -->
            <div class="text-center">
                <div class="inline-block relative mb-2">
                    <!-- Soft glow -->
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FFB5B0] to-[#B5E5D4] blur-2xl opacity-20 rounded-full scale-150"></div>
                    
                    <!-- Logo with soft gradient -->
                    <h1 class="relative text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-black mb-2">
                        <span class="bg-gradient-to-r from-[#FF8A7A] via-[#B5E5D4] to-[#FFB5B0] bg-clip-text text-transparent tracking-tighter drop-shadow-lg">
                            💰BAYU
                        </span>
                    </h1>
                    
                    <!-- Simple decoration -->
                    <div class="absolute -top-3 -right-3 text-2xl opacity-30">🫧</div>
                    <div class="absolute -bottom-3 -left-3 text-2xl opacity-30">🫧</div>
                </div>

                <!-- Friendly tagline -->
                <div class="mt-4 space-y-2">
                    <p class="text-[#7F8B8A] text-lg sm:text-xl md:text-2xl font-medium leading-relaxed max-w-lg mx-auto">
                        Catat piutang warungmu, 
                        <span class="text-[#FF8A7A] font-semibold">tenang</span> 
                        <span class="text-[#B5E5D4] font-semibold">hati</span>.
                    </p>
                    
                    <!-- Soft indicator -->
                    <div class="flex justify-center items-center gap-2 text-sm text-[#7F8B8A]/60">
                        <span class="w-1.5 h-1.5 bg-[#FFB5B0] rounded-full"></span>
                        <span>gampang & santai aja</span>
                        <span class="w-1.5 h-1.5 bg-[#B5E5D4] rounded-full"></span>
                    </div>
                </div>

                <!-- Soft divider -->
                <div class="mt-8 flex justify-center">
                    <div class="w-24 h-0.5 bg-gradient-to-r from-transparent via-[#FFB5B0] to-transparent rounded-full"></div>
                </div>
            </div>

            <!-- CTA Buttons - soft and friendly -->
            <div class="mt-8 sm:mt-10 flex flex-col sm:flex-row justify-center gap-3 sm:gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" 
                       class="bg-[#FFB5B0] hover:bg-[#FF8A7A] text-white px-8 sm:px-10 py-4 sm:py-5 rounded-2xl font-semibold text-base sm:text-lg shadow-lg shadow-[#FFB5B0]/30 hover:shadow-xl hover:shadow-[#FF8A7A]/40 transition-all duration-300 active:scale-95 w-full sm:w-auto text-center">
                        <span class="flex items-center justify-center gap-2">
                            <span>📋</span>
                            Buka Dashboard
                            <span class="text-lg">→</span>
                        </span>
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="bg-[#B5E5D4] hover:bg-[#9AD4C0] text-[#5C6D6B] px-8 sm:px-10 py-4 sm:py-5 rounded-2xl font-semibold text-base sm:text-lg shadow-lg shadow-[#B5E5D4]/30 hover:shadow-xl hover:shadow-[#9AD4C0]/40 transition-all duration-300 active:scale-95 w-full sm:w-auto text-center">
                        <span class="flex items-center justify-center gap-2">
                            <span>🔐</span>
                            Masuk / Login
                        </span>
                    </a>

                    <a href="{{ route('register') }}" 
                       class="bg-white/80 backdrop-blur-sm border-2 border-[#FFE5D9] text-[#7F8B8A] px-8 sm:px-10 py-4 sm:py-5 rounded-2xl font-semibold text-base sm:text-lg hover:bg-white hover:border-[#B5E5D4] hover:text-[#5C6D6B] shadow-lg hover:shadow-xl transition-all duration-300 active:scale-95 w-full sm:w-auto text-center">
                        <span class="flex items-center justify-center gap-2">
                            <span>✨</span>
                            Daftar
                        </span>
                    </a>
                @endauth
            </div>

            <!-- Simple features - soft and clear -->
            <div class="mt-10 sm:mt-12 grid grid-cols-2 sm:grid-cols-3 gap-2 sm:gap-3">
                <div class="bg-white/60 backdrop-blur-sm rounded-xl py-3 px-2 text-center">
                    <div class="text-2xl mb-1">📝</div>
                    <div class="text-xs sm:text-sm text-[#7F8B8A]">Catat utang</div>
                </div>
                <div class="bg-white/60 backdrop-blur-sm rounded-xl py-3 px-2 text-center">
                    <div class="text-2xl mb-1">⏰</div>
                    <div class="text-xs sm:text-sm text-[#7F8B8A]">Ingetin nagih</div>
                </div>
                <div class="bg-white/60 backdrop-blur-sm rounded-xl py-3 px-2 text-center col-span-2 sm:col-span-1">
                    <div class="text-2xl mb-1">🔒</div>
                    <div class="text-xs sm:text-sm text-[#7F8B8A]">Aman</div>
                </div>
            </div>

            <!-- Friendly footer note -->
            <div class="mt-8 sm:mt-10 text-center">
                <p class="text-sm text-[#7F8B8A]/50">
                    <span class="inline-flex items-center gap-2">
                        <span>🌿</span>
                        buat pemilik warung yang santai tapi teliti
                        <span>🌿</span>
                    </span>
                </p>
            </div>
        </div>
    </div>

    <!-- Very soft version badge -->
    <div class="fixed bottom-3 right-3 text-xs text-[#7F8B8A]/30 z-20">
        <span class="bg-white/40 backdrop-blur-sm px-3 py-1 rounded-full">versi warung • soft</span>
    </div>

    <!-- Additional softness for very small screens -->
    <style>
        @media (max-width: 380px) {
            .text-6xl {
                font-size: 3.5rem;
            }
        }
        
        /* Smooth transitions */
        a, button {
            transition: all 0.2s ease;
        }
        
        /* Soft focus state */
        a:focus, button:focus {
            outline: 2px solid #FFB5B0;
            outline-offset: 2px;
        }
    </style>
</body>
</html>