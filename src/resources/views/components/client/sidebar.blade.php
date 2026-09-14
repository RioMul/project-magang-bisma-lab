<aside
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 flex flex-col transform transition-transform duration-300 lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

    <div class="h-[72px] px-6 flex items-center border-b border-slate-100 shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-[#0396c7] flex items-center justify-center">
                <span class="text-white font-bold text-lg">B</span>
            </div>

            <div>
                <p class="text-sm font-bold text-slate-900 leading-tight">
                    Bisma Labs
                </p>

                <p class="text-[9px] text-slate-400 uppercase tracking-wider">
                    Client Area
                </p>
            </div>
        </a>

        <button
            @click="sidebarOpen = false"
            class="ml-auto lg:hidden p-2 rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition">

            <svg
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"/>
            </svg>

        </button>
    </div>

    <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto">

        <a
            href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition
            {{ request()->routeIs('dashboard') ? 'bg-slate-100 text-slate-900 font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">

            <svg
                class="w-[18px] h-[18px] shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">

                <rect
                    x="3"
                    y="3"
                    width="7"
                    height="7"
                    rx="1"/>

                <rect
                    x="14"
                    y="3"
                    width="7"
                    height="7"
                    rx="1"/>

                <rect
                    x="3"
                    y="14"
                    width="7"
                    height="7"
                    rx="1"/>

                <rect
                    x="14"
                    y="14"
                    width="7"
                    height="7"
                    rx="1"/>

            </svg>

            <span>Dashboard</span>
        </a>

        <a
            href="{{ route('client.website.edit') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition
            {{ request()->routeIs('client.website.*') ? 'bg-slate-100 text-slate-900 font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">

            <svg
                class="w-[18px] h-[18px] shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 20h9"/>

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/>

            </svg>

            <span>Edit Website</span>
        </a>

        <a
            href="{{ route('client.pages.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition
            {{ request()->routeIs('client.pages.*') ? 'bg-slate-100 text-slate-900 font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">

            <svg
                class="w-[18px] h-[18px] shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 4h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2z"/>

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M8 8h8M8 12h8M8 16h5"/>

            </svg>

            <span>Halaman</span>
        </a>

        <a
            href="{{ route('client.statistics.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition
            {{ request()->routeIs('client.statistics.*') ? 'bg-slate-100 text-[#0396c7] font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">

            <svg
                class="w-[18px] h-[18px] shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4 19V9"/>

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 19V5"/>

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M14 19v-7"/>

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M19 19V3"/>

            </svg>

            <span>Statistik</span>
        </a>

        <a
            href="{{ route('client.billing.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition
            {{ request()->routeIs('client.billing.*') ? 'bg-slate-100 text-[#0396c7] font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">

            <svg
                class="w-[18px] h-[18px] shrink-0"
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
                    stroke-linejoin="round"
                    d="M3 10h18"/>

            </svg>

            <span>Billing</span>
        </a>

    </nav>

    <div class="px-4 pb-5 space-y-1 border-t border-slate-100 pt-4 shrink-0">

        <a
            href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-slate-500 hover:bg-slate-50 hover:text-slate-800 transition">

            <svg
                class="w-[18px] h-[18px]"
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
                    stroke-linejoin="round"
                    d="M9.5 9a2.5 2.5 0 115 0c0 1.7-2.5 2-2.5 3.5M12 16.5h.01"/>

            </svg>

            <span>Support</span>
        </a>

        <form
            method="POST"
            action="{{ route('logout') }}">

            @csrf

            <button
                type="submit"
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-red-500 hover:bg-red-50 transition text-left">

                <svg
                    class="w-[18px] h-[18px]"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10 17l5-5-5-5"/>

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 12H3"/>

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 19V5a2 2 0 00-2-2h-6"/>

                </svg>

                <span>Logout</span>
            </button>

        </form>

    </div>

</aside>