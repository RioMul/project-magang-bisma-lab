<div class="bg-white border border-slate-200 rounded-2xl shadow-sm mb-7">

    <div class="px-6 py-5 border-b border-slate-100">

        <div class="flex items-center justify-between gap-4">

            <div>
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    Website Management
                </p>

                <h2 class="text-lg font-bold text-slate-800 mt-1">
                    Kelola Website
                </h2>
            </div>

            @if($canManageWebsite)

                <span class="text-[10px] font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg">
                    Active
                </span>

            @else

                <span class="text-[10px] font-semibold text-slate-400 bg-slate-50 px-2.5 py-1 rounded-lg">
                    Locked
                </span>

            @endif

        </div>

    </div>

    <div class="p-6">

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            @if($canManageWebsite)

                <a
                    href="{{ route('client.website.edit') }}"
                    class="group border border-slate-200 rounded-xl p-5 hover:border-[#0369a1] hover:bg-slate-50 transition">

                    <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center mb-4">

                        <svg
                            class="w-5 h-5 text-slate-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.232 5.232l3.536 3.536M4 20h4l10.768-10.768a2.5 2.5 0 10-3.536-3.536L4.464 16.464A2 2 0 004 17.879V20z"/>

                        </svg>

                    </div>

                    <h3 class="text-sm font-bold text-slate-800">
                        Edit Website
                    </h3>

                    <p class="text-xs text-slate-400 mt-1">
                        Kelola tampilan website Anda.
                    </p>

                </a>

            @else

                <div class="border border-slate-200 rounded-xl p-5 opacity-50 cursor-not-allowed">

                    <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center mb-4">

                        <svg
                            class="w-5 h-5 text-slate-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.232 5.232l3.536 3.536M4 20h4l10.768-10.768a2.5 2.5 0 10-3.536-3.536L4.464 16.464A2 2 0 004 17.879V20z"/>

                        </svg>

                    </div>

                    <h3 class="text-sm font-bold text-slate-400">
                        Edit Website
                    </h3>

                    <p class="text-xs text-slate-400 mt-1">
                        Tersedia setelah pembayaran.
                    </p>

                </div>

            @endif

            @if($canManageWebsite)

                <a
                    href="{{ route('client.pages.index') }}"
                    class="group border border-slate-200 rounded-xl p-5 hover:border-[#0369a1] hover:bg-slate-50 transition">

                    <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center mb-4">

                        <svg
                            class="w-5 h-5 text-slate-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <rect
                                x="5"
                                y="4"
                                width="14"
                                height="16"
                                rx="2"/>

                            <path
                                stroke-linecap="round"
                                d="M9 8h6M9 12h6M9 16h4"/>

                        </svg>

                    </div>

                    <h3 class="text-sm font-bold text-slate-800">
                        Halaman
                    </h3>

                    <p class="text-xs text-slate-400 mt-1">
                        Kelola halaman website Anda.
                    </p>

                </a>

            @else

                <div class="border border-slate-200 rounded-xl p-5 opacity-50 cursor-not-allowed">

                    <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center mb-4">

                        <svg
                            class="w-5 h-5 text-slate-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <rect
                                x="5"
                                y="4"
                                width="14"
                                height="16"
                                rx="2"/>

                            <path
                                stroke-linecap="round"
                                d="M9 8h6M9 12h6M9 16h4"/>

                        </svg>

                    </div>

                    <h3 class="text-sm font-bold text-slate-400">
                        Halaman
                    </h3>

                    <p class="text-xs text-slate-400 mt-1">
                        Tersedia setelah pembayaran.
                    </p>

                </div>

            @endif

            @if($canManageWebsite)

                <a
                    href="{{ route('client.statistics.index') }}"
                    class="group border border-slate-200 rounded-xl p-5 hover:border-[#0369a1] hover:bg-slate-50 transition">

                    <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center mb-4">

                        <svg
                            class="w-5 h-5 text-slate-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 20V10M12 20V4M19 20V7"/>

                        </svg>

                    </div>

                    <h3 class="text-sm font-bold text-slate-800">
                        Statistik
                    </h3>

                    <p class="text-xs text-slate-400 mt-1">
                        Lihat statistik website Anda.
                    </p>

                </a>

            @else

                <div class="border border-slate-200 rounded-xl p-5 opacity-50 cursor-not-allowed">

                    <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center mb-4">

                        <svg
                            class="w-5 h-5 text-slate-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 20V10M12 20V4M19 20V7"/>

                        </svg>

                    </div>

                    <h3 class="text-sm font-bold text-slate-400">
                        Statistik
                    </h3>

                    <p class="text-xs text-slate-400 mt-1">
                        Tersedia setelah pembayaran.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>
