<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed lg:static inset-y-0 left-0 z-50 w-[250px] bg-white border-r border-slate-200 flex flex-col justify-between transition-transform duration-300 lg:translate-x-0">

    <div>

        {{-- Logo --}}
        <div class="h-[72px] px-7 flex items-center border-b border-slate-100">
            <a href="{{ route('home') }}" class="flex items-center gap-3">

                <div class="w-9 h-9 rounded-xl bg-emerald-500 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c-4.5 0-8 3.1-8 7.5 0 5.8 5.2 9.2 8 10.5 2.8-1.3 8-4.7 8-10.5C20 6.1 16.5 3 12 3z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v8m0 0c-2-1-3-2.5-3-4.5M12 16c2-1 3-2.5 3-4.5"/>
                    </svg>
                </div>

                <div>
                    <p class="text-[15px] font-bold text-slate-800 leading-none">
                        Bisma Labs
                    </p>

                    <p class="text-[9px] text-slate-400 uppercase tracking-widest mt-1">
                        Client Area
                    </p>
                </div>

            </a>

            <button
                @click="sidebarOpen = false"
                class="ml-auto lg:hidden p-2 text-slate-400 hover:bg-slate-100 rounded-lg">

                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M6 18L18 6"/>
                </svg>

            </button>
        </div>

        {{-- Navbar --}}
        <nav class="px-4 py-6 space-y-1">

            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-100 text-slate-800 font-semibold text-sm">

                <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="4" y="4" width="6" height="6" rx="1"/>
                    <rect x="14" y="4" width="6" height="6" rx="1"/>
                    <rect x="4" y="14" width="6" height="6" rx="1"/>
                    <rect x="14" y="14" width="6" height="6" rx="1"/>
                </svg>

                Dashboard
            </a>

            <a
                href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-800 transition text-sm">

                <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 20h16M6 17l8.5-8.5a2.1 2.1 0 013 3L9 20H6v-3z"/>
                </svg>

                Edit Website
            </a>

            <a
                href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-800 transition text-sm">

                <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 4h9l3 3v13H6V4z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 11h6M9 15h6"/>
                </svg>

                Halaman
            </a>

            <a
                href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-800 transition text-sm">

                <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 19V9m5 10V5m5 14v-7m5 7V3"/>
                </svg>

                Statistik
            </a>

            <a
                href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-800 transition text-sm">

                <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18"/>
                </svg>

                Billing
            </a>

        </nav>
    </div>

    {{-- Footer --}}
    <div class="px-4 py-5 border-t border-slate-100">

        <a
            href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-800 transition text-sm">

            <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="9"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.5 9a2.5 2.5 0 115 1.8c-.8.5-1.5 1-1.5 2.2M12 16h.01"/>
            </svg>

            Support
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 transition text-sm">

                <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 17l5-5-5-5M15 12H3"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 5h3a2 2 0 012 2v10a2 2 0 01-2 2h-3"/>
                </svg>

                Logout
            </button>
        </form>

    </div>

</aside>