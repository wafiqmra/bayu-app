<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            50% { transform: translateY(-10px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        .animate-shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            background-size: 1000px 100%;
            animation: shimmer 8s infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 min-h-screen relative overflow-x-hidden">
    
    <!-- Animated background decorations -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <!-- Large blur circles -->
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-float" style="animation-delay: 4s;"></div>
        
        <!-- Grid pattern overlay -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%239C92AC" fill-opacity="0.03"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
    </div>

    <!-- Main content -->
    <div class="max-w-4xl mx-auto pt-16 px-4 relative z-10">
        <!-- Floating card container -->
        <div class="bg-white/40 backdrop-blur-sm rounded-3xl shadow-2xl shadow-blue-200/30 p-8 md:p-12 border border-white/50">
            
            <!-- Logo section with enhanced design -->
            <div class="text-center">
                <div class="inline-block relative">
                    <!-- Glow effect behind logo -->
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-400 blur-2xl opacity-30 rounded-full"></div>
                    
                    <!-- Main logo -->
                    <h1 class="relative text-8xl md:text-9xl font-black mb-4">
                        <span class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent tracking-tighter drop-shadow-lg">
                            💰BAYU
                        </span>
                    </h1>
                    
                    <!-- Decorative sparkles -->
                    <div class="absolute -top-6 -right-6 text-4xl animate-pulse">✨</div>
                    <div class="absolute -bottom-4 -left-6 text-4xl animate-pulse" style="animation-delay: 1s;">💫</div>
                </div>

                <!-- Tagline with improved styling -->
                <div class="mt-6 space-y-2">
                    <p class="text-slate-600 text-xl md:text-2xl font-medium leading-relaxed max-w-lg mx-auto">
                        Catat piutangmu biar gak lupa nagih.
                    </p>
                    
                    <!-- Animated highlight -->
                    <div class="flex justify-center gap-2 text-sm text-slate-500">
                        <span class="w-2 h-2 bg-blue-400 rounded-full animate-ping"></span>
                        <span>Gampang & Gratis</span>
                        <span class="w-2 h-2 bg-indigo-400 rounded-full animate-ping" style="animation-delay: 0.3s;"></span>
                    </div>
                </div>

                <!-- Decorative line with gradient -->
                <div class="mt-8 flex justify-center">
                    <div class="relative">
                        <div class="w-32 h-1 bg-gradient-to-r from-transparent via-blue-400 to-transparent rounded-full"></div>
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-16 h-1 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-full blur-sm"></div>
                    </div>
                </div>
            </div>

            <!-- CTA Buttons with enhanced design -->
            <div class="mt-12 flex flex-col sm:flex-row justify-center gap-4 md:gap-6">
                @auth
                    <a href="{{ url('/dashboard') }}" 
                       class="group relative overflow-hidden bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-10 py-5 rounded-2xl font-bold text-lg shadow-xl shadow-blue-200/50 hover:shadow-2xl hover:shadow-blue-300/50 transition-all duration-300 hover:-translate-y-1">
                        <!-- Shimmer effect -->
                        <div class="absolute inset-0 animate-shimmer"></div>
                        
                        <!-- Button content -->
                        <span class="relative flex items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Buka Dashboard
                            <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </span>
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="group relative overflow-hidden bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-10 py-5 rounded-2xl font-bold text-lg shadow-xl shadow-blue-200/50 hover:shadow-2xl hover:shadow-blue-300/50 transition-all duration-300 hover:-translate-y-1">
                        <!-- Shimmer effect -->
                        <div class="absolute inset-0 animate-shimmer"></div>
                        
                        <!-- Button content -->
                        <span class="relative flex items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Masuk / Login
                            <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </span>
                    </a>

                    <a href="{{ route('register') }}" 
                       class="group relative overflow-hidden bg-white/90 backdrop-blur-sm border-2 border-slate-200 text-slate-700 px-10 py-5 rounded-2xl font-bold text-lg hover:bg-white hover:border-blue-200 hover:text-blue-600 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <!-- Button content -->
                        <span class="relative flex items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            Daftar Sekarang
                            <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </span>
                    </a>
                @endauth
            </div>

            <!-- Feature highlights -->
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div class="flex items-center justify-center gap-2 text-slate-500 bg-white/30 backdrop-blur-sm py-3 px-4 rounded-xl">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Gampang Dicatat</span>
                </div>
                <div class="flex items-center justify-center gap-2 text-slate-500 bg-white/30 backdrop-blur-sm py-3 px-4 rounded-xl">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Ingetin Nagih</span>
                </div>
                <div class="flex items-center justify-center gap-2 text-slate-500 bg-white/30 backdrop-blur-sm py-3 px-4 rounded-xl">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <span>Aman & Privat</span>
                </div>
            </div>

            <!-- Footer note -->
            <div class="mt-12 text-sm text-slate-400 text-center">
                <span class="inline-flex items-center gap-3 bg-white/20 backdrop-blur-sm px-6 py-2 rounded-full">
                    <span class="w-1.5 h-1.5 bg-blue-300 rounded-full"></span>
                    Kelola piutang dengan mudah & gratis
                    <span class="w-1.5 h-1.5 bg-indigo-300 rounded-full"></span>
                </span>
            </div>
        </div>

        <!-- Version badge -->
        <div class="mt-6 text-center text-xs text-slate-400">
            <span class="bg-white/30 backdrop-blur-sm px-3 py-1 rounded-full">v2.0 • Lebih kece & responsif</span>
        </div>
    </div>
</body>
</html>