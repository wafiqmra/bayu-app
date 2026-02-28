<body class="bg-slate-50">
    <div class="max-w-2xl mx-auto pt-20 px-4 text-center">
        <h1 class="text-6xl font-black text-blue-600 tracking-tighter">💰 BAYU</h1>
        <p class="mt-4 text-slate-600 text-xl font-medium">Catat piutangmu biar gak lupa nagih.</p>
        
        <div class="mt-10 flex justify-center gap-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-bold shadow-xl shadow-blue-200">Buka Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-bold shadow-xl shadow-blue-200">Masuk / Login</a>
                <a href="{{ route('register') }}" class="bg-white border border-slate-200 text-slate-600 px-8 py-4 rounded-2xl font-bold">Daftar</a>
            @endauth
        </div>
    </div>
</body>