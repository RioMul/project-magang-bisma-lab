<nav id="smartNavbar" 
     class="fixed top-0 left-0 right-0 z-50 px-4 sm:px-8 py-4 bg-white shadow-md border-b border-gray-200 transition-transform duration-300 ease-in-out transform translate-y-0">
    
    {{-- KONTEN NAVBAR (FULL LEBAR) --}}
    <div class="w-full max-w-[1400px] mx-auto flex items-center justify-between relative z-10">
        
        {{-- SISI KIRI: LOGO UTAMA --}}
        <div class="flex items-center gap-6">
            <a href="{{ route('home') }}" class="flex items-center group shrink-0">
                <img src="{{ asset('logo.png') }}" alt="BismaLabs Logo" class="h-11 sm:h-12 w-auto object-contain drop-shadow-sm group-hover:scale-105 transition duration-200"
                     onerror="this.onerror=null; this.src='https://placehold.co/150x45/0396c7/ffffff?text=BismaLabs';">
            </a>
        </div>

        {{-- MENU TENGAH --}}
        <div class="hidden lg:flex items-center gap-10 text-base sm:text-lg font-semibold text-gray-700 tracking-wide">
            <a href="{{ route('home') }}#solusi" class="hover:text-[#0396c7] transition">Solusi</a>
            <a href="{{ route('order.template') }}" class="hover:text-[#0396c7] transition {{ request()->routeIs('order.template') ? 'text-[#0396c7] underline underline-offset-4 font-bold' : '' }}">Template</a>
            <a href="{{ route('order.package') }}" class="hover:text-[#0396c7] transition {{ request()->routeIs('order.package') ? 'text-[#0396c7] underline underline-offset-4 font-bold' : '' }}">Harga</a>
            <a href="{{ route('order.domain') }}" class="hover:text-[#0396c7] transition {{ request()->routeIs('order.domain') ? 'text-[#0396c7] underline underline-offset-4 font-bold' : '' }}">Domain</a>
        </div>

        {{-- SISI KANAN: TOMBOL LOGIN & "BUAT WEBSITE" / FOTO PROFIL USER --}}
        <div class="flex items-center gap-3 shrink-0">
            @auth
                <!-- Jika Sudah Login: Tampilkan Nama & Foto Profil (PP) + Dropdown -->
                <div class="relative" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-3 text-sm font-semibold text-gray-700 hover:text-gray-900 focus:outline-none transition bg-gray-50 hover:bg-gray-100 border border-gray-200 px-3 py-1.5 rounded-full shadow-sm">
                        <!-- Foto Profil / Inisial User -->
                        <div class="w-9 h-9 rounded-full bg-[#0396c7] text-white flex items-center justify-center font-bold text-sm shadow overflow-hidden">
                            @if(Auth::user()->avatar ?? false)
                                <img src="{{ Auth::user()->avatar }}" alt="PP" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            @endif
                        </div>
                        <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                        <svg class="h-4 w-4 text-gray-500 transition-transform duration-200" :class="{'rotate-180': dropdownOpen}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="dropdownOpen" 
                         @click.away="dropdownOpen = false" 
                         x-transition.origin.top.right
                         class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-xl py-2 border border-gray-100 z-50" 
                         style="display: none;">
                        
                        <div class="px-4 py-2 border-b border-gray-100 mb-1">
                            <p class="text-xs text-gray-400">Masuk sebagai</p>
                            <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-cyan-50 hover:text-[#0396c7] transition">
                            📊 Dashboard
                        </a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-cyan-50 hover:text-[#0396c7] transition">
                            ⚙️ Settings
                        </a>
                        
                        <div class="border-t border-gray-100 my-1"></div>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition font-medium">
                                🚪 Keluar
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Jika Belum Login: Tombol Log In bersanding dengan Buat Website -->
                <a href="{{ route('login') }}" class="text-sm sm:text-base font-bold text-gray-700 hover:text-[#0396c7] px-4 py-2 transition">
                    Log In
                </a>
                <a href="{{ route('order.template') }}" class="text-sm sm:text-base font-bold text-white bg-[#0396c7] hover:bg-[#027ea8] px-5 py-2.5 rounded-xl shadow transition transform hover:-translate-y-0.5">
                    Buat Website!
                </a>
            @endauth
        </div>
    </div>
</nav>

{{-- SCRIPT: SMART HIDE-ON-SCROLL & REVEAL-ON-UP (Sangat Sensitif/Cepat Muncul Saat Scroll Ke Atas Sedikit) --}}
<script>
    (function () {
        let lastScrollTop = 0;
        const navbar = document.getElementById('smartNavbar');
        const threshold = 5; // Dibuat kecil agar baru digulir sedikit ke atas langsung muncul

        window.addEventListener('scroll', function () {
            let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScroll <= 10) {
                navbar.classList.remove('-translate-y-full');
                lastScrollTop = currentScroll;
                return;
            }

            if (Math.abs(currentScroll - lastScrollTop) > threshold) {
                if (currentScroll > lastScrollTop) {
                    // Scroll ke Bawah -> Sembunyikan Navbar
                    navbar.classList.add('-translate-y-full');
                } else {
                    // Scroll ke Atas (walau sedikit) -> Tampilkan Kembali Navbar
                    navbar.classList.remove('-translate-y-full');
                }
                lastScrollTop = currentScroll;
            }
        }, { passive: true });
    })();
</script>