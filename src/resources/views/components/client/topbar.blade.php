<header class="h-[72px] bg-white border-b border-slate-200 flex items-center px-5 sm:px-8 lg:px-10 sticky top-0 z-30">

    <button
        @click="sidebarOpen = true"
        class="lg:hidden mr-4 p-2 rounded-lg hover:bg-slate-100">

        <svg class="w-6 h-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>

    </button>

    <div class="relative w-full max-w-xl hidden sm:block">

        <svg
            class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2">

            <circle cx="11" cy="11" r="7"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M20 20l-4-4"/>

        </svg>

        <input
            type="text"
            placeholder="Cari halaman"
            class="w-full bg-slate-50 border border-transparent rounded-full pl-11 pr-5 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:bg-white focus:border-slate-200 transition">

    </div>

    <div class="ml-auto flex items-center gap-3">

        <div class="text-right hidden sm:block">

            <p class="text-sm font-semibold text-slate-800">
                {{ Auth::user()->name }}
            </p>

            <p class="text-[10px] text-slate-400">
                Client
            </p>

        </div>

        <a
            href="{{ route('profile.edit') }}"
            class="w-10 h-10 rounded-full overflow-hidden border border-slate-200 bg-slate-100 flex items-center justify-center hover:ring-2 hover:ring-slate-200 transition">

            @if(Auth::user()->avatar ?? false)

                <img
                    src="{{ Auth::user()->avatar }}"
                    alt="Foto profil"
                    class="w-full h-full object-cover">

            @else

                <span class="text-sm font-bold text-slate-600">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </span>

            @endif

        </a>

    </div>

</header>