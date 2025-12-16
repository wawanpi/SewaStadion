<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 fixed w-full z-20 top-0 left-0">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 flex-shrink-0">
            <x-application-logo class="h-8 w-auto text-green-600" />
            <span class="self-center text-lg md:text-xl font-semibold whitespace-nowrap dark:text-white leading-tight">
                Stadion Sultan Agung <br class="md:hidden"> <span class="hidden md:inline">-</span> Bantul
            </span>
        </a>

        <div class="hidden md:flex items-center space-x-8">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'text-amber-600 font-bold border-b-2 border-amber-600' : 'text-gray-800 dark:text-white hover:text-amber-600' }} text-sm py-1 transition duration-150">Dashboard</a>
            <a href="{{ route('penyewaan-stadion.create') }}" class="{{ request()->routeIs('penyewaan-stadion.create') ? 'text-amber-600 font-bold border-b-2 border-amber-600' : 'text-gray-800 dark:text-white hover:text-amber-600' }} text-sm py-1 transition duration-150">Pemesanan</a>
            <a href="{{ route('penyewaan.pembayaran') }}" class="{{ request()->routeIs('penyewaan.pembayaran') ? 'text-amber-600 font-bold border-b-2 border-amber-600' : 'text-gray-800 dark:text-white hover:text-amber-600' }} text-sm py-1 transition duration-150">Pembayaran</a>
            <a href="{{ route('penyewaan-stadion.my') }}" class="{{ request()->routeIs('penyewaan-stadion.my') ? 'text-amber-600 font-bold border-b-2 border-amber-600' : 'text-gray-800 dark:text-white hover:text-amber-600' }} text-sm py-1 transition duration-150">Riwayat</a>
        </div>

        <div class="hidden md:flex items-center space-x-4 flex-shrink-0" x-data="{ dropdownOpen: false }">
            
             <a href="{{ asset('storage/SuratPermohonan/contoh_surat_permohonan.pdf') }}" download class="p-2 text-gray-600 dark:text-white hover:text-amber-600 dark:hover:text-amber-500 focus:outline-none" title="Unduh Surat Permohonan PDF">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </a>

            <button id="theme-toggle" class="text-gray-600 dark:text-white hover:text-amber-600 dark:hover:text-amber-500 focus:outline-none">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zM4 11a1 1 0 100-2H3a1 1 0 000 2h1zm13 0a1 1 0 100-2h-1a1 1 0 100 2h1zm-6 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1z" />
                </svg>
            </button>

            <div class="relative">
                <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-2 focus:outline-none">
                    <div class="h-8 w-8 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center font-bold shadow-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span class="text-sm font-medium dark:text-white max-w-[100px] truncate">{{ Auth::user()->name }}</span>
                    <svg class="h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                
                <div x-show="dropdownOpen" @click.away="dropdownOpen = false" 
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50 border border-gray-100 dark:border-gray-700" style="display: none;">
                    
                    <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                        <div class="text-sm font-semibold text-gray-800 dark:text-white truncate">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</div>
                    </div>
                    
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">Profil</a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="md:hidden flex items-center space-x-4">
             <button id="theme-toggle-mobile" class="p-2 text-gray-600 dark:text-white hover:text-amber-600 dark:hover:text-amber-500 focus:outline-none">
                <svg id="theme-toggle-dark-icon-mobile" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
                <svg id="theme-toggle-light-icon-mobile" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zM4 11a1 1 0 100-2H3a1 1 0 000 2h1zm13 0a1 1 0 100-2h-1a1 1 0 100 2h1zm-6 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1z" />
                </svg>
            </button>
            <button @click="open = !open" class="p-2 rounded-lg text-gray-600 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-2 focus:ring-amber-600">
                <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" class="md:hidden border-t border-gray-200 dark:border-gray-700">
        <div class="px-4 pt-2 pb-4 space-y-1">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-amber-50 text-amber-600' : 'text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-800' }} block px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
            <a href="{{ route('penyewaan-stadion.create') }}" class="{{ request()->routeIs('penyewaan-stadion.create') ? 'bg-amber-50 text-amber-600' : 'text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-800' }} block px-3 py-2 rounded-md text-base font-medium">Pemesanan</a>
            <a href="{{ route('penyewaan.pembayaran') }}" class="{{ request()->routeIs('penyewaan.pembayaran') ? 'bg-amber-50 text-amber-600' : 'text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-800' }} block px-3 py-2 rounded-md text-base font-medium">Pembayaran</a>
            <a href="{{ route('penyewaan-stadion.my') }}" class="{{ request()->routeIs('penyewaan-stadion.my') ? 'bg-amber-50 text-amber-600' : 'text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-800' }} block px-3 py-2 rounded-md text-base font-medium">Riwayat</a>
            
             <a href="{{ asset('storage/SuratPermohonan/srt p.pdf') }}" download class="flex items-center px-3 py-2 text-base font-medium text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-800 rounded-md">
                <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Unduh Surat Permohonan
            </a>
        </div>
    </div>
</nav>

<script>
    function setupThemeToggle(themeToggleBtn, darkIcon, lightIcon) {
        if (
            localStorage.getItem('color-theme') === 'dark' ||
            (!('color-theme' in localStorage) &&
                window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark');
            lightIcon.classList.remove('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            darkIcon.classList.remove('hidden');
        }

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