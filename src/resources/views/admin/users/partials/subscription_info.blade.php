<div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm flex flex-col h-full">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-[11px] font-bold uppercase tracking-widest text-[#0369a1]">
            Subscription
        </h2>
        <svg class="h-5 w-5 text-[#0369a1]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <rect x="3" y="5" width="18" height="14" rx="2"/>
            <path stroke-linecap="round" d="M3 10h18"/>
        </svg>
    </div>
    @if($latestOrder)
        <div class="space-y-4">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Plan</p>
                <p class="text-sm font-semibold text-slate-800">{{ $latestOrder->package?->name ?? 'None' }}</p>
            </div>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Expiry Date</p>
                <p class="text-sm font-semibold text-slate-800">-</p>
                <p class="mt-1 text-[9px] leading-4 text-slate-400">
                    Belum tersedia pada struktur saat ini.
                </p>
            </div>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Status</p>
                <span class="inline-flex rounded-full px-2.5 py-1 text-[10px] font-bold tracking-wider uppercase {{ $statusClass }}">
                    {{ $statusLabel }}
                </span>
            </div>
        </div>
    @else
        <div class="flex-1 rounded-xl bg-slate-50 p-4 flex items-center">
            <p class="text-[11px] font-medium leading-5 text-slate-500">
                User belum memiliki subscription.
            </p>
        </div>
    @endif
</div>