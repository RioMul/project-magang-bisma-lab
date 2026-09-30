<aside class="bg-white border border-slate-100 rounded-2xl shadow-sm p-3 h-fit lg:sticky lg:top-5">

    <div class="px-3 pt-2 pb-3">

        <p class="text-[9px] font-bold uppercase tracking-[0.18em] text-slate-400">
            Template Editor
        </p>

        <p class="mt-1 text-xs text-slate-500">
            Manage template sections
        </p>

    </div>

    <nav class="space-y-1">

        <button
            type="button"
            @click="activeSection = 'general'"
            :class="activeSection === 'general'
                ? 'bg-sky-50 text-[#0369a1]'
                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'"
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-left transition"
        >
            <svg
                class="w-4 h-4 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 4v16m8-8H4"
                />
            </svg>

            General
        </button>

        <button
            type="button"
            @click="activeSection = 'header'"
            :class="activeSection === 'header'
                ? 'bg-sky-50 text-[#0369a1]'
                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'"
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-left transition"
        >
            <svg
                class="w-4 h-4 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3 10.5L12 3l9 7.5M5 9v11h14V9M9 20v-6h6v6"
                />
            </svg>

            Header
        </button>

        <button
            type="button"
            @click="activeSection = 'hero'"
            :class="activeSection === 'hero'
                ? 'bg-sky-50 text-[#0369a1]'
                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'"
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-left transition"
        >
            <svg
                class="w-4 h-4 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4 16l4.5-4.5a2 2 0 012.8 0L16 16l2.5-2.5a2 2 0 012.8 0L22 16M5 20h14a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v14a1 1 0 001 1z"
                />
            </svg>

            Hero
        </button>

        <button
            type="button"
            @click="activeSection = 'products'"
            :class="activeSection === 'products'
                ? 'bg-sky-50 text-[#0369a1]'
                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'"
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-left transition"
        >
            <svg
                class="w-4 h-4 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3 5h18M3 12h18M3 19h18"
                />
            </svg>

            Products
        </button>

        <button
            type="button"
            @click="activeSection = 'contact'"
            :class="activeSection === 'contact'
                ? 'bg-sky-50 text-[#0369a1]'
                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'"
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-left transition"
        >
            <svg
                class="w-4 h-4 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21 10.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"
                />
            </svg>

            Contact
        </button>

        <button
            type="button"
            @click="activeSection = 'footer'"
            :class="activeSection === 'footer'
                ? 'bg-sky-50 text-[#0369a1]'
                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'"
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-left transition"
        >
            <svg
                class="w-4 h-4 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4 19h16M4 5h16M7 9h10M7 15h10"
                />
            </svg>

            Footer
        </button>

        <button
            type="button"
            @click="activeSection = 'seo'"
            :class="activeSection === 'seo'
                ? 'bg-sky-50 text-[#0369a1]'
                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'"
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-left transition"
        >
            <svg
                class="w-4 h-4 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M10.5 6a4.5 4.5 0 100 9 4.5 4.5 0 000-9zM14 14l4 4"
                />
            </svg>

            SEO
        </button>

        <button
            type="button"
            @click="activeSection = 'appearance'"
            :class="activeSection === 'appearance'
                ? 'bg-sky-50 text-[#0369a1]'
                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'"
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-left transition"
        >
            <svg
                class="w-4 h-4 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 3v18M3 12h18"
                />
            </svg>

            Appearance
        </button>

    </nav>

</aside>