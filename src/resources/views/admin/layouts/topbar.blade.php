<header class="h-20 bg-white border-b border-slate-100 flex items-center justify-between px-5 sm:px-7 lg:px-8">

    {{-- KIRI: SEARCH BAR --}}
    <div class="flex-1 max-w-2xl">
        <div class="relative w-full max-w-lg">
            <svg
                class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">
                <circle cx="11" cy="11" r="7"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/>
            </svg>

            <input
                type="text"
                placeholder="Search for users or websites..."
                class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-50 border-0 text-xs sm:text-sm text-slate-700 placeholder:text-slate-400 focus:ring-2 focus:ring-sky-100 transition shadow-sm">
        </div>
    </div>

    {{-- KANAN: ICONS & PROFILE --}}
    <div class="flex items-center gap-6 shrink-0">

        {{-- Ikon Notifikasi & Pengaturan --}}
        <div class="flex items-center gap-4 text-slate-400">
            <button class="hover:text-slate-700 transition relative">
                <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <span class="absolute top-0 right-0.5 w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
            </button>

            <button class="hover:text-slate-700 transition">
                <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </button>
        </div>

        <div class="h-6 w-px bg-slate-200 hidden sm:block"></div>

        {{-- Profil --}}
        <div class="flex items-center gap-3">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-bold text-slate-800">
                    {{ auth()->user()->name ?? 'Alex Rivera' }}
                </div>
                <div class="text-[9px] font-bold uppercase tracking-wider text-[#0369a1] mt-0.5">
                    Super Admin
                </div>
            </div>

            <a href="{{ route('profile.edit') }}" class="w-10 h-10 rounded-full overflow-hidden border-2 border-slate-100 bg-slate-800 hover:border-sky-200 transition shrink-0">
                @if(auth()->user()->avatar ?? false)
                    <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="w-full h-full object-cover">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Alex Rivera') }}&background=1e293b&color=fff" alt="Avatar" class="w-full h-full object-cover">
                @endif
            </a>
        </div>

    </div>

</header>