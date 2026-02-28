<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>BAYU - Catat Piutangmu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes pulse-slow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.9; }
        }
        .animate-pulse-slow {
            animation: pulse-slow 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        .animate-shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            background-size: 1000px 100%;
            animation: shimmer 8s infinite;
        }

        /* Mobile touch optimizations */
        * {
            -webkit-tap-highlight-color: transparent;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Better button touch targets for mobile */
        @media (max-width: 640px) {
            a, button {
                min-height: 48px;
                min-width: 48px;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-[#F8E6A0] via-[#FFA62B] to-[#86C5FF] min-h-screen relative overflow-x-hidden">
    
    <!-- Animated background decorations with new palette -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <!-- Large blur circles with new colors -->
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-[#FFA62B] rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float"></div>
        <div class="absolute -bottom-40 -left-40 w-[500px] h-[500px] bg-[#86C5FF] rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[#2E5AA7] rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-float" style="animation-delay: 4s;"></div>
        
        <!-- Subtle pattern overlay -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23FFA62B" fill-opacity="0.05"%3E%3Ccircle cx="20" cy="20" r="2"/%3E%3C/g%3E%3C/svg%3E')]"></div>
    </div>

    <!-- Main content - fully responsive -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 md:py-12 lg:py-16 relative z-10 min-h-screen flex items-center">
        
        <!-- Floating card container - responsive padding -->
        <div class="w-full bg-white/30 backdrop-blur-md rounded-2xl sm:rounded-3xl shadow-2xl shadow-[#2E5AA7]/20 p-4 sm:p-6 md:p-8 lg:p-12 border border-white/40">
            
            <!-- Logo section - responsive text sizes -->
            <div class="text-center">
                <div class="inline-block relative">
                    <!-- Glow effect with new colors -->
                    <div class="absolute inset-0 bg-gradient-to-r from-[#FFA62B] to-[#86C5FF] blur-2xl opacity-30 rounded-full scale-150"></div>
                    
                    <!-- Main logo - responsive font sizes -->
                    <h1 class="relative text-5xl xs:text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-black mb-2 sm:mb-4">
                        <span class="bg-gradient-to-r from-[#FFA62B] via-[#86C5FF] to-[#2E5AA7] bg-clip-text text-transparent tracking-tighter drop-shadow-lg">
                            💰BAYU
                        </span>
                    </h1>
                    
                    <!-- Decorative sparkles - hidden on very small screens -->
                    <div class="absolute -top-4 sm:-top-6 -right-4 sm:-right-6 text-2xl sm:text-4xl animate-pulse hidden xs:block">✨</div>
                    <div class="absolute -bottom-2 sm:-bottom-4 -left-4 sm:-left-6 text-2xl sm:text-4xl animate-pulse hidden xs:block" style="animation-delay: 1s;">💫</div>
                </div>

                <!-- Tagline - responsive text -->
                <div class="mt-4 sm:mt-6 space-y-1 sm:space-y-2">
                    <p class="text-[#2E5AA7] text-base sm:text-lg md:text-xl lg:text-2xl font-medium leading-relaxed max-w-lg mx-auto px-2">
                        Catat piutangmu biar gak lupa nagih.
                    </p>
                    
                    <!-- Animated highlight - responsive sizing -->
                    <div class="flex justify-center items-center gap-1 sm:gap-2 text-xs sm:text-sm text-[#2E5AA7]/70">
                        <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-[#FFA62B] rounded-full animate-ping"></span>
                        <span class="font-medium">Gampang & Gratis</span>
                        <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-[#86C5FF] rounded-full animate-ping" style="animation-delay: 0.3s;"></span>
                    </div>
                </div>

                <!-- Decorative line with new gradient -->
                <div class="mt-6 sm:mt-8 flex justify-center">
                    <div class="relative w-full max-w-[200px] sm:max-w-[250px]">
                        <div class="w-full h-1 bg-gradient-to-r from-transparent via-[#FFA62B] to-transparent rounded-full"></div>
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 h-1 bg-gradient-to-r from-[#86C5FF] to-[#2E5AA7] rounded-full blur-[2px]"></div>
                    </div>
                </div>
            </div>

            <!-- CTA Buttons - fully responsive with better mobile touch targets -->
            <div class="mt-8 sm:mt-10 md:mt-12 flex flex-col sm:flex-row justify-center gap-3 sm:gap-4 md:gap-6">
                @auth
                    <a href="{{ url('/dashboard') }}" 
                       class="group relative overflow-hidden bg-gradient-to-r from-[#FFA62B] to-[#86C5FF] text-[#2E5AA7] px-6 sm:px-8 md:px-10 py-4 sm:py-5 rounded-xl sm:rounded-2xl font-bold text-sm sm:text-base md:text-lg shadow-xl shadow-[#2E5AA7]/20 hover:shadow-2xl hover:shadow-[#2E5AA7]/30 transition-all duration-300 active:scale-95 hover:-translate-y-1 w-full sm:w-auto text-center">
                        <!-- Shimmer effect -->
                        <div class="absolute inset-0 animate-shimmer"></div>
                        
                        <!-- Button content -->
                        <span class="relative flex items-center justify-center gap-2 sm:gap-3">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <span class="whitespace-nowrap">Buka Dashboard</span>
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </span>
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="group relative overflow-hidden bg-gradient-to-r from-[#FFA62B] to-[#86C5FF] text-[#2E5AA7] px-6 sm:px-8 md:px-10 py-4 sm:py-5 rounded-xl sm:rounded-2xl font-bold text-sm sm:text-base md:text-lg shadow-xl shadow-[#2E5AA7]/20 hover:shadow-2xl hover:shadow-[#2E5AA7]/30 transition-all duration-300 active:scale-95 hover:-translate-y-1 w-full sm:w-auto text-center">
                        <!-- Shimmer effect -->
                        <div class="absolute inset-0 animate-shimmer"></div>
                        
                        <!-- Button content -->
                        <span class="relative flex items-center justify-center gap-2 sm:gap-3">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            <span class="whitespace-nowrap">Masuk / Login</span>
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </span>
                    </a>

                    <a href="{{ route('register') }}" 
                       class="group relative overflow-hidden bg-white/90 backdrop-blur-sm border-2 border-[#86C5FF] text-[#2E5AA7] px-6 sm:px-8 md:px-10 py-4 sm:py-5 rounded-xl sm:rounded-2xl font-bold text-sm sm:text-base md:text-lg hover:bg-white hover:border-[#FFA62B] shadow-lg hover:shadow-xl transition-all duration-300 active:scale-95 hover:-translate-y-1 w-full sm:w-auto text-center">
                        <!-- Button content -->
                        <span class="relative flex items-center justify-center gap-2 sm:gap-3">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            <span class="whitespace-nowrap">Daftar Sekarang</span>
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </span>
                    </a>
                @endauth
            </div>

            <!-- Feature highlights - responsive grid -->
            <div class="mt-10 sm:mt-12 md:mt-16 grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 gap-2 sm:gap-3 md:gap-4 text-xs sm:text-sm">
                <div class="flex items-center justify-center gap-1.5 sm:gap-2 text-[#2E5AA7] bg-white/40 backdrop-blur-sm py-2.5 sm:py-3 px-2 sm:px-3 rounded-lg sm:rounded-xl">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#FFA62B] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="truncate">Gampang Dicatat</span>
                </div>
                <div class="flex items-center justify-center gap-1.5 sm:gap-2 text-[#2E5AA7] bg-white/40 backdrop-blur-sm py-2.5 sm:py-3 px-2 sm:px-3 rounded-lg sm:rounded-xl">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#86C5FF] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="truncate">Ingetin Nagih</span>
                </div>
                <div class="flex items-center justify-center gap-1.5 sm:gap-2 text-[#2E5AA7] bg-white/40 backdrop-blur-sm py-2.5 sm:py-3 px-2 sm:px-3 rounded-lg sm:rounded-xl col-span-1 xs:col-span-2 sm:col-span-1">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#2E5AA7] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <span class="truncate">Aman & Privat</span>
                </div>
            </div>

            <!-- Footer note - responsive -->
            <div class="mt-8 sm:mt-10 md:mt-12 text-xs sm:text-sm text-[#2E5AA7]/60 text-center">
                <span class="inline-flex items-center gap-2 sm:gap-3 bg-white/30 backdrop-blur-sm px-4 sm:px-6 py-2 sm:py-2.5 rounded-full">
                    <span class="w-1 h-1 sm:w-1.5 sm:h-1.5 bg-[#FFA62B] rounded-full"></span>
                    <span class="whitespace-nowrap">Kelola piutang dengan mudah & gratis</span>
                    <span class="w-1 h-1 sm:w-1.5 sm:h-1.5 bg-[#86C5FF] rounded-full"></span>
                </span>
            </div>
        </div>
    </div>

    <!-- Version badge - responsive -->
    <div class="fixed bottom-2 sm:bottom-4 right-2 sm:right-4 text-[10px] sm:text-xs text-[#2E5AA7]/50 z-20">
        <span class="bg-white/40 backdrop-blur-sm px-2 sm:px-3 py-1 rounded-full">v2.0 • Mobile friendly</span>
    </div>

    <!-- Custom breakpoint for extra small devices -->
    <style>
        @media (min-width: 380px) {
            .xs\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
            .xs\:col-span-2 {
                grid-column: span 2 / span 2;
            }
            .xs\:block {
                display: block;
            }
            .text-5xl {
                font-size: 3rem;
                line-height: 1;
            }
        }
        
        /* Better touch feedback */
        a:active, button:active {
            opacity: 0.8;
        }
        
        /* Prevent text overflow */
        .truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</body>
</html>