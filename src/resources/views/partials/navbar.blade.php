<nav id="smartNavbar" class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-200 shadow-sm transition-transform duration-300 ease-in-out">
    <div class="w-full max-w-[1400px] mx-auto px-4 sm:px-8 py-3 sm:py-4 flex items-center justify-between">
        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="flex items-center shrink-0">
            <img src="{{ asset('logo.png') }}"
                 alt="BismaLabs Logo"
                 class="h-10 sm:h-12 w-auto object-contain transition duration-200 hover:scale-105"
                 onerror="this.onerror=null;this.src='https://placehold.co/150x45/0396c7/ffffff?text=BismaLabs';">
        </a>

        {{-- MENU DESKTOP --}}
        <div class="hidden lg:flex items-center gap-8 xl:gap-10 text-base font-semibold text-gray-700">
            <a href="{{ route('home') }}#solusi" class="hover:text-[#0396c7] transition">Solusi</a>
            <a href="{{ route('order.template') }}" class="hover:text-[#0396c7] transition {{ request()->routeIs('order.template') ? 'text-[#0396c7] font-bold' : '' }}">
                Template
            </a>
            <a href="{{ route('order.domain') }}" class="hover:text-[#0396c7] transition {{ request()->routeIs('order.domain') ? 'text-[#0396c7] font-bold' : '' }}">
                Domain
            </a>
            <a href="{{ route('order.package') }}" class="hover:text-[#0396c7] transition {{ request()->routeIs('order.package') ? 'text-[#0396c7] font-bold' : '' }}">
                Harga
            </a>
        </div>

        {{-- BAGIAN KANAN --}}
        <div class="flex items-center gap-2 sm:gap-3 shrink-0">
            @auth
                <div class="relative hidden sm:block" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-3 text-sm font-semibold text-gray-700 bg-gray-50 hover:bg-gray-100 border border-gray-200 px-3 py-1.5 rounded-full transition">
                        <div class="w-9 h-9 rounded-full bg-[#0396c7] text-white flex items-center justify-center font-bold text-sm overflow-hidden">
                            @if(Auth::user()->avatar ?? false)
                                <img src="{{ Auth::user()->avatar }}" alt="Foto Profil" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            @endif
                        </div>
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="h-4 w-4 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': dropdownOpen }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition.origin.top.right class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-xl py-2 border border-gray-100" style="display:none;">
                        <div class="px-4 py-2 border-b border-gray-100 mb-1">
                            <p class="text-xs text-gray-400">Masuk sebagai</p>
                            <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-cyan-50 hover:text-[#0396c7] transition">Dashboard</a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-cyan-50 hover:text-[#0396c7] transition">Settings</a>
                        <div class="border-t border-gray-100 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition font-medium">Keluar</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="hidden sm:flex items-center gap-2">
                    <a href="{{ route('login') }}" class="text-sm sm:text-base font-bold text-gray-700 hover:text-[#0396c7] px-3 py-2 transition">Log In</a>
                    <a href="{{ route('order.template') }}" class="text-sm sm:text-base font-bold text-white bg-[#0396c7] hover:bg-[#027ea8] px-4 sm:px-5 py-2.5 rounded-xl shadow transition">Buat Website!</a>
                </div>
            @endauth

            {{-- HAMBURGER MOBILE --}}
            <button id="mobileMenuButton" type="button" aria-expanded="false" class="lg:hidden w-11 h-11 flex items-center justify-center rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-100 transition">
                <svg id="hamburgerIcon" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    {{-- MENU MOBILE --}}
    <div id="mobileMenu" class="lg:hidden max-h-0 overflow-hidden opacity-0 border-t border-transparent transition-all duration-300 ease-in-out">
        <div class="px-4 sm:px-8 py-4 space-y-1">
            <a href="{{ route('home') }}#solusi" class="mobile-link block px-4 py-3 rounded-xl font-semibold text-gray-700 hover:bg-cyan-50 hover:text-[#0396c7] transition">Solusi</a>
            <a href="{{ route('order.template') }}" class="mobile-link block px-4 py-3 rounded-xl font-semibold text-gray-700 hover:bg-cyan-50 hover:text-[#0396c7] transition">Template</a>
            <a href="{{ route('order.domain') }}" class="mobile-link block px-4 py-3 rounded-xl font-semibold text-gray-700 hover:bg-cyan-50 hover:text-[#0396c7] transition">Domain</a>
            <a href="{{ route('order.package') }}" class="mobile-link block px-4 py-3 rounded-xl font-semibold text-gray-700 hover:bg-cyan-50 hover:text-[#0396c7] transition">Harga</a>

            <div class="border-t border-gray-200 my-3"></div>

            @auth
                <div class="px-4 py-3">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-[#0396c7] text-white flex items-center justify-center font-bold overflow-hidden">
                            @if(Auth::user()->avatar ?? false)
                                <img src="{{ Auth::user()->avatar }}" alt="Foto Profil" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="min-w-0">
                            <p class="font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <a href="{{ route('dashboard') }}" class="block px-4 py-3 mb-1 rounded-xl font-semibold text-gray-700 hover:bg-cyan-50 hover:text-[#0396c7] transition">Dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-3 mb-1 rounded-xl font-semibold text-gray-700 hover:bg-cyan-50 hover:text-[#0396c7] transition">Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 rounded-xl font-semibold text-red-600 hover:bg-red-50 transition">Keluar</button>
                    </form>
                </div>
            @else
                <div class="px-4 pb-4 grid grid-cols-2 gap-3">
                    <a href="{{ route('login') }}" class="text-center py-3 rounded-xl border border-gray-300 font-bold text-gray-700 hover:bg-gray-100 transition">Log In</a>
                    <a href="{{ route('order.template') }}" class="text-center py-3 rounded-xl bg-[#0396c7] hover:bg-[#027ea8] text-white font-bold transition">Buat Website</a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementById('smartNavbar');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileButton = document.getElementById('mobileMenuButton');
    const hamburgerIcon = document.getElementById('hamburgerIcon');
    const closeIcon = document.getElementById('closeIcon');
    if (!navbar || !mobileMenu || !mobileButton) return;
    let lastScrollY = window.scrollY;
    let ticking = false;
    const threshold = 8;
    function openMobileMenu() {
        mobileMenu.classList.remove('max-h-0', 'opacity-0', 'border-transparent');
        mobileMenu.classList.add('max-h-[650px]', 'opacity-100', 'border-gray-200');
        hamburgerIcon.classList.add('hidden');
        closeIcon.classList.remove('hidden');
        mobileButton.setAttribute('aria-expanded', 'true');
        navbar.classList.remove('-translate-y-full');
    }
    function closeMobileMenu() {
        mobileMenu.classList.add('max-h-0', 'opacity-0', 'border-transparent');
        mobileMenu.classList.remove('max-h-[650px]', 'opacity-100', 'border-gray-200');
        hamburgerIcon.classList.remove('hidden');
        closeIcon.classList.add('hidden');
        mobileButton.setAttribute('aria-expanded', 'false');
    }
    mobileButton.addEventListener('click', function () {
        if (mobileButton.getAttribute('aria-expanded') === 'true') closeMobileMenu();
        else openMobileMenu();
    });
    document.querySelectorAll('.mobile-link').forEach(link => link.addEventListener('click', closeMobileMenu));
    window.addEventListener('scroll', function () {
        if (!ticking) {
            window.requestAnimationFrame(function () {
                const currentScrollY = window.scrollY;
                const difference = currentScrollY - lastScrollY;
                const menuOpen = mobileButton.getAttribute('aria-expanded') === 'true';
                if (currentScrollY <= 10) navbar.classList.remove('-translate-y-full');
                else if (!menuOpen && Math.abs(difference) > threshold) {
                    if (difference > 0) navbar.classList.add('-translate-y-full');
                    else navbar.classList.remove('-translate-y-full');
                }
                lastScrollY = currentScrollY;
                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });
    window.addEventListener('resize', function () { if (window.innerWidth >= 1024) closeMobileMenu(); });
});
</script>