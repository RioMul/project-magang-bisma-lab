<div class="grid grid-cols-2 gap-4 xl:grid-cols-4">

    <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">

        <div class="flex items-center justify-between">

            <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400">
                Total Websites
            </span>

            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-sky-50 text-sky-600">

                <svg
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <rect
                        x="3"
                        y="4"
                        width="18"
                        height="16"
                        rx="2"
                    />

                    <path
                        stroke-linecap="round"
                        d="M3 9h18"
                    />

                </svg>

            </div>

        </div>

        <div class="mt-4 text-2xl font-bold text-slate-800">
            {{ number_format($totalWebsites) }}
        </div>

        <p class="mt-1 text-[9px] text-slate-400">
            All registered websites
        </p>

    </div>

    <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">

        <div class="flex items-center justify-between">

            <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400">
                Active
            </span>

            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                <svg
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 13l4 4L19 7"
                    />
                </svg>

            </div>

        </div>

        <div class="mt-4 text-2xl font-bold text-slate-800">
            {{ number_format($activeWebsites) }}
        </div>

        <p class="mt-1 text-[9px] text-emerald-500">
            Active and published
        </p>

    </div>

    <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">

        <div class="flex items-center justify-between">

            <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400">
                Building
            </span>

            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-50 text-amber-600">

                <svg
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <circle
                        cx="12"
                        cy="12"
                        r="8"
                    />

                    <path
                        stroke-linecap="round"
                        d="M12 8v4l3 2"
                    />

                </svg>

            </div>

        </div>

        <div class="mt-4 text-2xl font-bold text-slate-800">
            {{ number_format($buildingWebsites) }}
        </div>

        <p class="mt-1 text-[9px] text-amber-500">
            Currently being prepared
        </p>

    </div>

    <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">

        <div class="flex items-center justify-between">

            <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400">
                Expired
            </span>

            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 text-red-500">

                <svg
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <rect
                        x="4"
                        y="4"
                        width="16"
                        height="16"
                        rx="2"
                    />

                    <path
                        stroke-linecap="round"
                        d="M8 12h8"
                    />

                </svg>

            </div>

        </div>

        <div class="mt-4 text-2xl font-bold text-slate-800">
            {{ number_format($expiredWebsites) }}
        </div>

        <p class="mt-1 text-[9px] text-red-500">
            Requires attention
        </p>

    </div>

</div>