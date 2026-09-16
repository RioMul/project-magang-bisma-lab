<aside class="fixed inset-y-0 left-0 z-40 hidden w-64 border-r border-slate-200 bg-[#f1f5fb] lg:block">

    <div class="h-full flex flex-col">

        <div class="h-20 px-5 border-b border-slate-200 flex items-center gap-3">

            <a href="{{ route('home') }}" class="flex items-center gap-3">

                <div class="w-9 h-9 rounded-lg bg-[#0879b9] flex items-center justify-center shadow-sm">
                    <span class="text-white text-lg font-bold">
                        B
                    </span>
                </div>

                <div>
                    <div class="text-sm font-bold text-slate-800">
                        Bisma Labs
                    </div>

                    <div class="text-[8px] tracking-[0.16em] text-slate-400 uppercase">
                        Superadmin Panel
                    </div>
                </div>

            </a>

        </div>

        <nav class="flex-1 px-3 py-5 space-y-1">

            <a
                href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition
                {{ request()->routeIs('admin.dashboard')
                    ? 'bg-white text-[#0879b9] shadow-sm border-r-2 border-[#0879b9]'
                    : 'text-slate-600 hover:bg-white/70' }}">

                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <rect x="4" y="4" width="6" height="6" rx="1"/>
                    <rect x="14" y="4" width="6" height="6" rx="1"/>
                    <rect x="4" y="14" width="6" height="6" rx="1"/>
                    <rect x="14" y="14" width="6" height="6" rx="1"/>
                </svg>

                Dashboard
            </a>

            <a
                href="{{ route('admin.analytics') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition
                {{ request()->routeIs('admin.analytics')
                    ? 'bg-white text-[#0879b9] shadow-sm border-r-2 border-[#0879b9]'
                    : 'text-slate-600 hover:bg-white/70' }}">

                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" d="M5 19V9M12 19V5M19 19v-7"/>
                </svg>

                Analytics
            </a>

            <a
                href="{{ route('admin.users.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition
                {{ request()->routeIs('admin.users.*')
                    ? 'bg-white text-[#0879b9] shadow-sm border-r-2 border-[#0879b9]'
                    : 'text-slate-600 hover:bg-white/70' }}">

                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" d="M16 20v-1.5a4.5 4.5 0 00-4.5-4.5h-3A4.5 4.5 0 004 18.5V20"/>
                    <circle cx="10" cy="7" r="3"/>
                    <path stroke-linecap="round" d="M16 6.5a3 3 0 010 5.8"/>
                    <path stroke-linecap="round" d="M19 18.5a4 4 0 00-2.5-3.7"/>
                </svg>

                Users
            </a>

            <a
                href="{{ route('admin.billing.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition
                {{ request()->routeIs('admin.billing.*')
                    ? 'bg-white text-[#0879b9] shadow-sm border-r-2 border-[#0879b9]'
                    : 'text-slate-600 hover:bg-white/70' }}">

                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                    <path stroke-linecap="round" d="M3 10h18"/>
                </svg>

                Billing
            </a>

            <a
                href="{{ route('admin.websites.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition
                {{ request()->routeIs('admin.websites.*')
                    ? 'bg-white text-[#0879b9] shadow-sm border-r-2 border-[#0879b9]'
                    : 'text-slate-600 hover:bg-white/70' }}">

                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="4" width="18" height="16" rx="2"/>
                    <path stroke-linecap="round" d="M3 9h18"/>
                    <path stroke-linecap="round" d="M8 6.5h.01M11 6.5h.01"/>
                </svg>

                Websites
            </a>

            <a
                href="{{ route('admin.templates.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition
                {{ request()->routeIs('admin.templates.*')
                    ? 'bg-white text-[#0879b9] shadow-sm border-r-2 border-[#0879b9]'
                    : 'text-slate-600 hover:bg-white/70' }}">

                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <rect x="4" y="4" width="16" height="16" rx="2"/>
                    <path stroke-linecap="round" d="M8 8h8M8 12h8M8 16h5"/>
                </svg>

                Templates
            </a>

        </nav>

        <div class="px-3 pb-4 border-t border-slate-200 pt-4">

            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-sm text-slate-600">
                <span>?</span>
                Support
            </a>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2.5 text-sm text-red-600 hover:bg-red-50 rounded-lg">

                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" d="M10 17l5-5-5-5M15 12H3"/>
                        <path stroke-linecap="round" d="M21 4v16"/>
                    </svg>

                    Logout
                </button>
            </form>

        </div>

    </div>

</aside>