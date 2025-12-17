<nav class="fixed w-full z-50 top-0 left-0 transition-all duration-300 bg-white/90 backdrop-blur-md border-b border-gray-100 dark:bg-gray-900/90 dark:border-gray-800">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-4 py-3">
        
        <a href="/" class="flex items-center gap-3 group">
            <div class="relative w-10 h-10 overflow-hidden rounded-full ring-2 ring-gray-100 dark:ring-gray-700 group-hover:ring-emerald-500 transition-all">
                <img src="{{ asset('storage/image/logo.jpg') }}" class="object-cover w-full h-full" alt="Logo Dikpora">
            </div>
            <div class="flex flex-col">
                <span class="self-center text-lg font-bold whitespace-nowrap text-gray-900 dark:text-white leading-tight">
                    Dikpora Bantul
                </span>
                <span class="text-[10px] font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                    Official Facility Booking
                </span>
            </div>
        </a>

        <div class="flex items-center gap-3 md:order-2">
            
            <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-full text-sm p-2 transition-colors">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path>
                </svg>
            </button>

            @if (Route::has('login'))
                <div class="flex items-center gap-2">
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-emerald-600 dark:text-gray-300 dark:hover:text-white px-3 py-2 transition-colors">
                        Masuk
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-white bg-gray-900 hover:bg-gray-800 dark:bg-emerald-600 dark:hover:bg-emerald-700 font-medium rounded-lg text-sm px-4 py-2 transition-all shadow-sm hover:shadow-md">
                            Daftar Sekarang
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</nav>

<script>
    // Logic Dark Mode (Tetap dipertahankan, hanya styling yang berubah)
    const themeToggleBtn = document.getElementById('theme-toggle');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');

    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
        lightIcon.classList.remove('hidden');
    } else {
        document.documentElement.classList.remove('dark');
        darkIcon.classList.remove('hidden');
    }

    themeToggleBtn.addEventListener('click', function() {
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
</script>