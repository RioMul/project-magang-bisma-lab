<nav id="smartNavbar" 
     class="fixed top-0 left-0 right-0 z-50 px-4 sm:px-8 py-4 shadow-lg border-b border-cyan-400/30 transition-transform duration-300 ease-in-out transform translate-y-0" 
     style="background-color: #0396c7;">
    
    {{-- AMBIENT RADIAL GLOW --}}
    <div class="absolute inset-0 pointer-events-none" 
         style="background: radial-gradient(circle 380px at 15% 50%, rgba(255, 255, 255, 0.32) 0%, rgba(255, 255, 255, 0.08) 55%, transparent 100%),
                    radial-gradient(circle 500px at 90% 50%, rgba(2, 114, 153, 0.4) 0%, transparent 80%);">
    </div>

    {{-- KONTEN NAVBAR (FULL LEBAR & LOGO MEPET KIRI) --}}
    <div class="w-full max-w-[1400px] mx-auto flex items-center justify-between relative z-10">
        
        {{-- LOGO POSISI PALING KIRI --}}
        <a href="{{ route('home') }}" class="flex items-center group shrink-0">
            <img src="{{ asset('logo.png') }}" alt="BismaLabs Logo" class="h-11 sm:h-12 w-auto object-contain drop-shadow-md group-hover:scale-105 transition duration-200"
                 onerror="this.onerror=null; this.src='https://placehold.co/150x45/0396c7/ffffff?text=BismaLabs';">
        </a>

        {{-- MENU TENGAH BESAR & JELAS --}}
        <div class="hidden lg:flex items-center gap-10 text-base sm:text-lg font-bold text-white tracking-wide">
            <a href="{{ route('home') }}#solusi" class="hover:text-cyan-100 transition">Solusi</a>
            <a href="{{ route('order.template') }}" class="hover:text-cyan-100 transition">Template</a>
            <a href="{{ route('home') }}#pricing-section" class="hover:text-cyan-100 transition">Harga</a>
            <a href="{{ route('order.domain') }}" class="hover:text-cyan-100 transition">Domain</a>
        </div>

        {{-- AUTH / ACTION BUTTONS --}}
        <div class="flex items-center gap-4 shrink-0">
            @auth
                <a href="{{ route('dashboard') }}" class="text-sm sm:text-base font-extrabold text-white bg-cyan-900/60 hover:bg-cyan-900 border border-cyan-300/40 px-5 py-2.5 rounded-xl transition shadow-md backdrop-blur-sm">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm sm:text-base font-bold text-white/90 hover:text-white px-3 py-2 transition">
                        Keluar
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm sm:text-base font-bold text-white hover:text-cyan-100 px-4 py-2 transition">
                    Log In
                </a>
                <a href="{{ route('order.template') }}" class="text-sm sm:text-base font-black text-[#0396c7] bg-white hover:bg-cyan-50 px-6 py-3 rounded-xl shadow-lg transition transform hover:-translate-y-0.5">
                    Buat Website!
                </a>
            @endauth
        </div>
    </div>
</nav>

{{-- SCRIPT: SMART HIDE-ON-SCROLL & REVEAL-ON-UP --}}
<script>
    (function () {
        let lastScrollTop = 0;
        const navbar = document.getElementById('smartNavbar');
        const threshold = 15;

        window.addEventListener('scroll', function () {
            let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScroll <= 10) {
                navbar.classList.remove('-translate-y-full');
                lastScrollTop = currentScroll;
                return;
            }

            if (Math.abs(currentScroll - lastScrollTop) > threshold) {
                if (currentScroll > lastScrollTop) {
                    navbar.classList.add('-translate-y-full');
                } else {
                    navbar.classList.remove('-translate-y-full');
                }
                lastScrollTop = currentScroll;
            }
        }, { passive: true });
    })();
</script>