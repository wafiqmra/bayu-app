<nav x-data="{ open: false }" class="bg-white border-b border-[#D4E0E8] sticky top-0 z-50 backdrop-blur-sm bg-white/90">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <span class="text-2xl transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">💰</span>
                        <span class="font-bold text-[#1E3A5F] text-xl tracking-tight font-['Poppins']">BAYU</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition-all duration-300 ease-in-out focus:outline-none font-['Poppins']
                       {{ request()->routeIs('dashboard') 
                          ? 'border-[#1E3A5F] text-[#1E3A5F]' 
                          : 'border-transparent text-[#5F7D9C] hover:text-[#1E3A5F] hover:border-[#1E3A5F] hover:scale-105' }}">
                        {{ __('Dashboard') }}
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-[#D4E0E8] text-sm leading-4 font-medium rounded-lg text-[#1E3A5F] bg-white hover:bg-[#F0F5FA] hover:border-[#B8D1E5] focus:outline-none transition-all duration-300 ease-in-out hover:scale-105 active:scale-95 font-['Poppins']">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1 transition-transform duration-300 group-hover:rotate-180">
                                <svg class="fill-current h-4 w-4 text-[#5F7D9C]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-white rounded-lg shadow-lg border border-[#D4E0E8] overflow-hidden transform transition-all duration-200 ease-out origin-top">
                            <a href="{{ route('profile.edit') }}" 
                               class="block px-4 py-2 text-sm text-[#1E3A5F] hover:bg-[#F0F5FA] transition-all duration-200 hover:pl-6 font-['Poppins']">
                                <div class="flex items-center gap-2">
                                    <span>👤</span> {{ __('Profile') }}
                                </div>
                            </a>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-[#1E3A5F] hover:bg-[#F0F5FA] transition-all duration-200 hover:pl-6 border-t border-[#D4E0E8] font-['Poppins']">
                                    <div class="flex items-center gap-2">
                                        <span>🚪</span> {{ __('Log Out') }}
                                    </div>
                                </button>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" 
                        class="inline-flex items-center justify-center p-2 rounded-lg text-[#5F7D9C] hover:text-[#1E3A5F] hover:bg-[#F0F5FA] focus:outline-none transition-all duration-300 ease-in-out hover:scale-110 active:scale-90">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div x-show="open" 
         x-transition:enter="transition-all duration-300 ease-out"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition-all duration-200 ease-in"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="sm:hidden bg-white border-t border-[#D4E0E8]">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" 
               class="block px-4 py-2 text-sm transition-all duration-200 font-['Poppins'] {{ request()->routeIs('dashboard') ? 'text-[#1E3A5F] bg-[#F0F5FA]' : 'text-[#5F7D9C] hover:text-[#1E3A5F] hover:bg-[#F0F5FA] hover:pl-6' }}">
                <div class="flex items-center gap-2">
                    <span>📊</span> {{ __('Dashboard') }}
                </div>
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-[#D4E0E8]">
            <div class="px-4">
                <div class="font-medium text-base text-[#1E3A5F] font-['Poppins']">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-[#5F7D9C] font-['Poppins']">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" 
                   class="block px-4 py-2 text-sm text-[#1E3A5F] hover:bg-[#F0F5FA] transition-all duration-200 hover:pl-6 font-['Poppins']">
                    <div class="flex items-center gap-2">
                        <span>👤</span> {{ __('Profile') }}
                    </div>
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm text-[#1E3A5F] hover:bg-[#F0F5FA] transition-all duration-200 hover:pl-6 font-['Poppins']">
                        <div class="flex items-center gap-2">
                            <span>🚪</span> {{ __('Log Out') }}
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>