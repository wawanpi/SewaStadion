<nav x-data="{ open: false, scrolled: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 20) ? true : false"
     :class="{ 'bg-white/90 dark:bg-gray-900/90 backdrop-blur-md shadow-md': scrolled, 'bg-white dark:bg-gray-900': !scrolled }"
     class="fixed w-full z-50 top-0 left-0 border-b border-gray-100 dark:border-gray-800 transition-all duration-300">
    
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-4 py-3">
        
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
            <div class="relative w-10 h-10 overflow-hidden rounded-full ring-2 ring-gray-100 dark:ring-gray-700 group-hover:ring-amber-500 transition-all">
                <img src="{{ asset('storage/image/logo.jpg') }}" class="object-cover w-full h-full" alt="Logo">
            </div>
            <div class="flex flex-col">
                <span class="self-center text-lg font-bold whitespace-nowrap text-gray-900 dark:text-white leading-tight">
                    Dikpora Bantul
                </span>
                <span class="text-[10px] font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                    Official User Dashboard
                </span>
            </div>
        </a>

        <div class="hidden md:flex items-center space-x-1">
            <a href="{{ route('dashboard') }}" 
               class="{{ request()->routeIs('dashboard') ? 'text-amber-600 bg-amber-50 dark:bg-amber-900/20 font-bold' : 'text-gray-600 dark:text-gray-300 hover:text-amber-600 hover:bg-gray-50 dark:hover:bg-gray-800' }} px-4 py-2 rounded-lg text-sm transition-all duration-200">
               Dashboard
            </a>
            <a href="{{ route('penyewaan-stadion.create') }}" 
               class="{{ request()->routeIs('penyewaan-stadion.create') ? 'text-amber-600 bg-amber-50 dark:bg-amber-900/20 font-bold' : 'text-gray-600 dark:text-gray-300 hover:text-amber-600 hover:bg-gray-50 dark:hover:bg-gray-800' }} px-4 py-2 rounded-lg text-sm transition-all duration-200">
               Booking
            </a>
            <a href="{{ route('penyewaan.pembayaran') }}" 
               class="{{ request()->routeIs('penyewaan.pembayaran') ? 'text-amber-600 bg-amber-50 dark:bg-amber-900/20 font-bold' : 'text-gray-600 dark:text-gray-300 hover:text-amber-600 hover:bg-gray-50 dark:hover:bg-gray-800' }} px-4 py-2 rounded-lg text-sm transition-all duration-200">
               Pembayaran
            </a>
            <a href="{{ route('penyewaan-stadion.my') }}" 
               class="{{ request()->routeIs('penyewaan-stadion.my') ? 'text-amber-600 bg-amber-50 dark:bg-amber-900/20 font-bold' : 'text-gray-600 dark:text-gray-300 hover:text-amber-600 hover:bg-gray-50 dark:hover:bg-gray-800' }} px-4 py-2 rounded-lg text-sm transition-all duration-200">
               Riwayat
            </a>
        </div>

        <div class="hidden md:flex items-center space-x-3" x-data="{ dropdownOpen: false }">
            
            <button id="theme-toggle" class="p-2 text-gray-500 hover:text-amber-600 dark:text-gray-400 dark:hover:text-amber-400 transition-colors focus:outline-none rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path>
                </svg>
            </button>

             <a href="{{ asset('storage/SuratPermohonan/contoh_surat_permohonan.pdf') }}" download 
                class="p-2 text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors tooltip hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg" title="Unduh Template Surat">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
            </a>

            <div class="h-6 w-px bg-gray-200 dark:bg-gray-700"></div>

            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-3 focus:outline-none group">
                <div class="text-right hidden lg:block">
                    <p class="text-sm font-bold text-gray-900 dark:text-white leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 mt-1">User Account</p>
                </div>
                <div class="h-9 w-9 bg-amber-100 text-amber-700 rounded-full flex items-center justify-center font-bold shadow-sm ring-2 ring-transparent group-hover:ring-amber-200 transition-all">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </button>
            
            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" 
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 class="absolute right-0 top-14 mt-2 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-xl py-2 z-50 border border-gray-100 dark:border-gray-700" style="display: none;">
                
                <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 lg:hidden">
                    <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                
                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-amber-600 transition-colors">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Edit Profil
                </a>
                
                <div class="border-t border-gray-100 dark:border-gray-700 my-1"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-gray-700 transition-colors">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Keluar Aplikasi
                    </button>
                </form>
            </div>
        </div>

        <div class="md:hidden flex items-center gap-2">
             <button id="theme-toggle-mobile" class="p-2 text-gray-600 dark:text-white hover:text-amber-600 dark:hover:text-amber-500 focus:outline-none">
                <svg id="theme-toggle-dark-icon-mobile" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
                <svg id="theme-toggle-light-icon-mobile" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zM4 11a1 1 0 100-2H3a1 1 0 000 2h1zm13 0a1 1 0 100-2h-1a1 1 0 100 2h1zm-6 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1z" />
                </svg>
            </button>

            <button @click="open = !open" class="p-2 text-gray-600 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg">
                <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                <svg x-show="open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    </div>

    <div x-show="open" class="md:hidden border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-lg">
        <div class="px-4 pt-4 pb-2 border-b border-gray-100 dark:border-gray-800">
            <div class="flex items-center gap-3 mb-3">
                <div class="h-10 w-10 bg-amber-100 text-amber-700 rounded-full flex items-center justify-center font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>
        
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-amber-50 text-amber-600' : 'text-gray-600 dark:text-white hover:bg-gray-50' }} block px-3 py-2.5 rounded-lg text-base font-medium">Dashboard</a>
            <a href="{{ route('penyewaan-stadion.create') }}" class="{{ request()->routeIs('penyewaan-stadion.create') ? 'bg-amber-50 text-amber-600' : 'text-gray-600 dark:text-white hover:bg-gray-50' }} block px-3 py-2.5 rounded-lg text-base font-medium">Booking Lapangan</a>
            <a href="{{ route('penyewaan.pembayaran') }}" class="{{ request()->routeIs('penyewaan.pembayaran') ? 'bg-amber-50 text-amber-600' : 'text-gray-600 dark:text-white hover:bg-gray-50' }} block px-3 py-2.5 rounded-lg text-base font-medium">Status Pembayaran</a>
            <a href="{{ route('penyewaan-stadion.my') }}" class="{{ request()->routeIs('penyewaan-stadion.my') ? 'bg-amber-50 text-amber-600' : 'text-gray-600 dark:text-white hover:bg-gray-50' }} block px-3 py-2.5 rounded-lg text-base font-medium">Riwayat Sewa</a>
        </div>

        <div class="px-2 pt-2 pb-4 border-t border-gray-100 dark:border-gray-800 space-y-1">
             <a href="{{ asset('storage/SuratPermohonan/contoh_surat_permohonan.pdf') }}" download class="flex items-center px-3 py-2.5 text-base font-medium text-gray-600 dark:text-white hover:bg-gray-50 rounded-lg">
                <svg class="w-5 h-5 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Unduh Template Surat
            </a>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-3 py-2.5 text-base font-medium text-red-600 hover:bg-red-50 rounded-lg">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Aplikasi
                </button>
            </form>
        </div>
    </div>
</nav>

{{-- Script Toggle Dark Mode --}}
<script>
    function setupThemeToggle(themeToggleBtn, darkIcon, lightIcon) {
        // Cek preferensi awal
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            lightIcon.classList.remove('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            darkIcon.classList.remove('hidden');
        }

        // Event listener klik
        themeToggleBtn.addEventListener('click', () => {
            darkIcon.classList.toggle('hidden');
            lightIcon.classList.toggle('hidden');

            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    }

    const themeToggleBtn = document.getElementById('theme-toggle');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');
    if(themeToggleBtn) setupThemeToggle(themeToggleBtn, darkIcon, lightIcon);

    const themeToggleMobileBtn = document.getElementById('theme-toggle-mobile');
    const darkIconMobile = document.getElementById('theme-toggle-dark-icon-mobile');
    const lightIconMobile = document.getElementById('theme-toggle-light-icon-mobile');
    if(themeToggleMobileBtn) setupThemeToggle(themeToggleMobileBtn, darkIconMobile, lightIconMobile);
</script>