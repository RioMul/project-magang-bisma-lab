<header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-5 sm:px-7 lg:px-8">

    <div class="flex-1 max-w-xl">

        <div class="relative">

            <svg
                class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8">

                <circle cx="11" cy="11" r="6"/>
                <path stroke-linecap="round" d="M16 16l4 4"/>

            </svg>

            <input
                type="text"
                placeholder="Search for users or websites..."
                class="w-full max-w-md pl-9 pr-4 py-2 rounded-lg bg-[#f2f5fa] border-0 text-xs text-slate-700 placeholder:text-slate-400 focus:ring-2 focus:ring-cyan-100">
        </div>

    </div>

    <div class="flex items-center gap-5">

        <button class="text-slate-500 hover:text-slate-800">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" d="M18 8a6 6 0 00-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                <path stroke-linecap="round" d="M10 21h4"/>
            </svg>
        </button>

        <button class="text-slate-500 hover:text-slate-800">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <circle cx="12" cy="12" r="3"/>
                <path stroke-linecap="round" d="M19.4 15a1.7 1.7 0 000-6l-1-1.7a1.7 1.7 0 00-2.4-.6L14 6a7 7 0 00-4 0L8 6.7a1.7 1.7 0 00-2.4.6l-1 1.7a1.7 1.7 0 000 6l1 1.7a1.7 1.7 0 002.4.6L10 18a7 7 0 004 0l2 1.3a1.7 1.7 0 002.4-.6l1-1.7z"/>
            </svg>
        </button>

        <div class="flex items-center gap-2.5">

            <div class="text-right hidden sm:block">

                <div class="text-xs font-semibold text-slate-800">
                    {{ auth()->user()->name }}
                </div>

                <div class="text-[8px] font-bold uppercase tracking-wider text-[#0879b9]">
                    Super Admin
                </div>

            </div>

            <div class="w-9 h-9 rounded-lg bg-[#e3f3fa] flex items-center justify-center text-xs font-bold text-[#0879b9]">
                AR
            </div>

        </div>

    </div>

</header>