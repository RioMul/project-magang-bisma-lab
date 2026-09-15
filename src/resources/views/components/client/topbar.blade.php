{{-- ALPINE JS SCROLL LOGIC --}}
<header 
    x-data="{ show: true, lastScroll: 0 }"
    x-init="
        $nextTick(() => {
            const scrollContainer = $el.closest('main');
            if (scrollContainer) {
                scrollContainer.addEventListener('scroll', () => {
                    let current = scrollContainer.scrollTop;
                    if (current > lastScroll && current > 88) {
                        show = false;
                    } else {
                        show = true;
                    }
                    lastScroll = current;
                });
            }
        })
    "
    :class="show ? 'translate-y-0' : '-translate-y-full'"
    class="shrink-0 h-[88px] bg-white border-b border-slate-200 flex items-center px-5 sm:px-8 lg:px-10 sticky top-0 z-30 transition-transform duration-300 w-full">
    {{-- shrink-0 di atas adalah kunci agar navbar tidak gepeng --}}

    <button
        @click="sidebarOpen = true"
        class="lg:hidden mr-4 p-2 rounded-lg hover:bg-slate-100 shrink-0">
        <svg class="w-6 h-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>

    {{-- SEARCH BAR (Padding atas bawah dikurangi menjadi py-2.5 agar box tidak membesar/kegemukan) --}}
    <div class="relative w-full max-w-2xl flex-1 mr-6 lg:mr-10 hidden sm:block">
        <svg
            class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2">
            <circle cx="11" cy="11" r="7"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/>
        </svg>

        <input
            type="text"
            placeholder="Search your atelier..."
            class="w-full bg-[#f8fafc] border border-transparent rounded-full pl-11 pr-5 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:bg-white focus:border-slate-200 transition">
    </div>

    {{-- PROFIL USER --}}
    <div class="ml-auto flex items-center gap-4 shrink-0">
        <div class="text-right hidden sm:block">
            <p class="text-sm font-bold text-slate-800">
                {{ Auth::user()->name }}
            </p>
            <p class="text-[11px] text-slate-500">
                Professional Plan
            </p>
        </div>

        <a
            href="{{ route('profile.edit') }}"
            class="w-10 h-10 rounded-full overflow-hidden border border-slate-200 bg-slate-800 flex items-center justify-center hover:ring-2 hover:ring-slate-200 transition shrink-0">
            
            @if(Auth::user()->avatar ?? false)
                <img
                    src="{{ Auth::user()->avatar }}"
                    alt="Foto profil"
                    class="w-full h-full object-cover">
            @else
                <img 
                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1e293b&color=fff" 
                    alt="Avatar" 
                    class="w-full h-full object-cover">
            @endif
        </a>
    </div>

</header>