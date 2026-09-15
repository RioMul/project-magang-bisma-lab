<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-7">

    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    System Status
                </p>

                @if($systemStatus === 'active')
                    <p class="text-lg font-bold text-emerald-600 mt-2">
                        Active
                    </p>
                @elseif($systemStatus === 'pending')
                    <p class="text-lg font-bold text-amber-500 mt-2">
                        Pending
                    </p>
                @else
                    <p class="text-lg font-bold text-slate-500 mt-2">
                        Inactive
                    </p>
                @endif
            </div>

            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center">
                <svg
                    class="w-5 h-5 text-slate-500"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 12l2 2 4-4"/>

                    <circle
                        cx="12"
                        cy="12"
                        r="9"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    Live Address
                </p>

                @if($domainName)
                    <p class="text-sm font-bold text-slate-800 mt-2 truncate max-w-[180px]">
                        {{ $domainName }}
                    </p>
                @else
                    <p class="text-sm font-semibold text-slate-400 mt-2">
                        Belum tersedia
                    </p>
                @endif
            </div>

            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center">
                <svg
                    class="w-5 h-5 text-slate-500"
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
                        d="M3 12h18"/>

                    <path
                        stroke-linecap="round"
                        d="M12 3c2.5 2.5 3.5 5.5 3.5 9s-1 6.5-3.5 9c-2.5-2.5-3.5-5.5-3.5-9S9.5 5.5 12 3z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    Billing Cycle
                </p>

                @if($packageName)
                    <p class="text-sm font-bold text-slate-800 mt-2">
                        {{ $packageName }}
                    </p>

                    @if($planName)
                        <p class="text-[10px] text-slate-400 mt-1">
                            {{ $planName }}
                        </p>
                    @endif
                @else
                    <p class="text-sm font-semibold text-slate-400 mt-2">
                        Belum dipilih
                    </p>
                @endif
            </div>

            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center">
                <svg
                    class="w-5 h-5 text-slate-500"
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
            </div>
        </div>
    </div>

</div>
