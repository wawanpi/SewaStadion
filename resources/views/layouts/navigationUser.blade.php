<nav x-data="{ open: false }" class="bg-white border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <x-application-logo class="h-8 w-auto text-green-600" />
                    <span class="text-lg font-bold text-gray-800">AYO Sewa</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex space-x-4">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-green-500 text-white' : 'text-gray-700 hover:bg-green-500 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium">
                    Dashboard
                </a>
                <a href="{{ route('penyewaan-stadion.create') }}" class="{{ request()->routeIs('penyewaan-stadion.create') ? 'bg-green-500 text-white' : 'text-gray-700 hover:bg-green-500 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium">
                    Pemesanan
                </a>
                <a href="{{ route('penyewaan.pembayaran') }}" class="{{ request()->routeIs('penyewaan.pembayaran') ? 'bg-green-500 text-white' : 'text-gray-700 hover:bg-green-500 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium">
                    Pembayaran
                </a>
                <a href="{{ route('penyewaan-stadion.my') }}" class="{{ request()->routeIs('penyewaan-stadion.my') ? 'bg-green-500 text-white' : 'text-gray-700 hover:bg-green-500 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium">
                    Riwayat Pesanan
                </a>
            </div>

            <!-- User Dropdown -->
            <div class="hidden md:flex items-center space-x-4 relative" x-data="{ dropdownOpen: false }">
                <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-2 focus:outline-none">
                    <div class="h-8 w-8 bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span class="text-sm text-gray-800 font-medium">{{ Auth::user()->name }}</span>
                    <svg class="h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
                    <div class="px-4 py-2 border-b text-sm">
                        <div class="font-medium">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button @click="open = !open" class="p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    <svg class="h-6 w-6 text-gray-600" x-show="!open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6 text-gray-600" x-show="open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div x-show="open" class="md:hidden px-4 pt-2 pb-3 space-y-1">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-green-500 text-white' : 'text-gray-700 hover:bg-green-500 hover:text-white' }} block px-4 py-2 rounded-md text-base font-medium">
            Dashboard
        </a>
        <a href="{{ route('penyewaan-stadion.create') }}" class="{{ request()->routeIs('penyewaan-stadion.create') ? 'bg-green-500 text-white' : 'text-gray-700 hover:bg-green-500 hover:text-white' }} block px-4 py-2 rounded-md text-base font-medium">
            Pemesanan
        </a>
        <a href="{{ route('penyewaan.pembayaran') }}" class="{{ request()->routeIs('penyewaan.pembayaran') ? 'bg-green-500 text-white' : 'text-gray-700 hover:bg-green-500 hover:text-white' }} block px-4 py-2 rounded-md text-base font-medium">
            Pembayaran
        </a>
        <a href="{{ route('penyewaan-stadion.my') }}" class="{{ request()->routeIs('penyewaan-stadion.my') ? 'bg-green-500 text-white' : 'text-gray-700 hover:bg-green-500 hover:text-white' }} block px-4 py-2 rounded-md text-base font-medium">
            Riwayat Pesanan
        </a>

        <div class="border-t mt-3 pt-3">
            <div class="flex items-center space-x-3">
                <div class="h-8 w-8 bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
