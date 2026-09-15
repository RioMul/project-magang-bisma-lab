<aside
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 transform transition-transform duration-200 lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

    <div class="h-24 px-6 border-b border-slate-100 flex flex-col items-center justify-center">

        <a
            href="{{ route('home') }}"
            class="flex flex-col items-center justify-center group">

            <img
                src="{{ asset('logo.png') }}"
                alt="BismaLabs"
                class="w-32 h-auto object-contain">

            <span class="mt-1 text-[9px] font-medium tracking-[0.18em] text-slate-400 uppercase">
                Client Area
            </span>

        </a>

    </div>

    <div class="flex flex-col h-[calc(100vh-6rem)]">

        <nav class="flex-1 px-4 py-6 space-y-1">

            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-semibold transition
                {{ request()->routeIs('dashboard') ? 'bg-slate-100 text-slate-900' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">

                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">

                    <rect x="4" y="4" width="6" height="6" rx="1"/>
                    <rect x="14" y="4" width="6" height="6" rx="1"/>
                    <rect x="4" y="14" width="6" height="6" rx="1"/>
                    <rect x="14" y="14" width="6" height="6" rx="1"/>

                </svg>

                <span>Dashboard</span>

            </a>

            @if($canManageWebsite)

                <a
                    href="{{ route('client.website.edit') }}"
                    class="flex items-center gap-4 px-4 py-3 rounded-xl text-sm transition
                    {{ request()->routeIs('client.website.edit') ? 'bg-slate-100 text-slate-900 font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">

                    <svg
                        class="w-5 h-5 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.232 5.232l3.536 3.536M4 20h4l10.768-10.768a2.5 2.5 0 10-3.536-3.536L4.464 16.464A2 2 0 004 17.879V20z"/>

                    </svg>

                    <span>Edit Website</span>

                </a>

                <a
                    href="{{ route('client.pages.index') }}"
                    class="flex items-center gap-4 px-4 py-3 rounded-xl text-sm transition
                    {{ request()->routeIs('client.pages.*') ? 'bg-slate-100 text-slate-900 font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">

                    <svg
                        class="w-5 h-5 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">

                        <rect x="5" y="4" width="14" height="16" rx="2"/>

                        <path
                            stroke-linecap="round"
                            d="M9 8h6M9 12h6M9 16h4"/>

                    </svg>

                    <span>Halaman</span>

                </a>

                <a
                    href="{{ route('client.statistics.index') }}"
                    class="flex items-center gap-4 px-4 py-3 rounded-xl text-sm transition
                    {{ request()->routeIs('client.statistics.*') ? 'bg-slate-100 text-slate-900 font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">

                    <svg
                        class="w-5 h-5 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 20V10M12 20V4M19 20V7"/>

                    </svg>

                    <span>Statistik</span>

                </a>

            @else

                <div class="flex items-center gap-4 px-4 py-3 text-sm text-slate-400 cursor-not-allowed">

                    <svg
                        class="w-5 h-5 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.232 5.232l3.536 3.536M4 20h4l10.768-10.768a2.5 2.5 0 10-3.536-3.536L4.464 16.464A2 2 0 004 17.879V20z"/>

                    </svg>

                    <span class="flex-1">
                        Edit Website
                    </span>

                    <svg
                        class="w-4 h-4 text-slate-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">

                        <rect
                            x="5"
                            y="11"
                            width="14"
                            height="9"
                            rx="2"/>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 11V8a4 4 0 018 0v3"/>

                    </svg>

                </div>

                <div class="flex items-center gap-4 px-4 py-3 text-sm text-slate-400 cursor-not-allowed">

                    <svg
                        class="w-5 h-5 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">

                        <rect x="5" y="4" width="14" height="16" rx="2"/>

                        <path
                            stroke-linecap="round"
                            d="M9 8h6M9 12h6M9 16h4"/>

                    </svg>

                    <span class="flex-1">
                        Halaman
                    </span>

                    <svg
                        class="w-4 h-4 text-slate-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">

                        <rect
                            x="5"
                            y="11"
                            width="14"
                            height="9"
                            rx="2"/>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 11V8a4 4 0 018 0v3"/>

                    </svg>

                </div>

                <div class="flex items-center gap-4 px-4 py-3 text-sm text-slate-400 cursor-not-allowed">

                    <svg
                        class="w-5 h-5 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 20V10M12 20V4M19 20V7"/>

                    </svg>

                    <span class="flex-1">
                        Statistik
                    </span>

                    <svg
                        class="w-4 h-4 text-slate-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">

                        <rect
                            x="5"
                            y="11"
                            width="14"
                            height="9"
                            rx="2"/>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 11V8a4 4 0 018 0v3"/>

                    </svg>

                </div>

            @endif

            <a
                href="{{ route('client.billing.index') }}"
                class="flex items-center gap-4 px-4 py-3 rounded-xl text-sm transition
                {{ request()->routeIs('client.billing.*') ? 'bg-slate-100 text-slate-900 font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">

                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">

                    <rect
                        x="3"
                        y="5"
                        width="18"
                        height="14"
                        rx="2"/>

                    <path
                        stroke-linecap="round"
                        d="M3 10h18"/>

                </svg>

                <span>Billing</span>

            </a>

        </nav>

        <div class="border-t border-slate-100 px-4 py-5 space-y-1">

            <a
                href="#"
                class="flex items-center gap-4 px-4 py-3 rounded-xl text-sm text-slate-500 hover:bg-slate-50 hover:text-slate-800 transition">

                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">

                    <circle
                        cx="12"
                        cy="12"
                        r="9"/>

                    <path
                        stroke-linecap="round"
                        d="M9.5 9a2.5 2.5 0 115 0c0 1.5-2.5 1.75-2.5 3.5M12 16.5h.01"/>

                </svg>

                <span>Support</span>

            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-xl text-sm text-red-500 hover:bg-red-50 transition">

                    <svg
                        class="w-5 h-5 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10 17l5-5-5-5M15 12H3"/>

                        <path
                            stroke-linecap="round"
                            d="M21 4v16"/>

                    </svg>

                    <span>Logout</span>

                </button>

            </form>

        </div>

    </div>

</aside>