<div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm flex flex-col h-full">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-[11px] font-bold uppercase tracking-widest text-[#0369a1]">
            Website Info
        </h2>
        <svg class="h-5 w-5 text-[#0369a1]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="9"/>
            <path stroke-linecap="round" d="M3 12h18M12 3a14 14 0 010 18M12 3a14 14 0 000 18"/>
        </svg>
    </div>
    @if($latestOrder)
        <div class="space-y-4">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Domain</p>
                @if($latestOrder->domain_name)
                    <p class="break-all text-sm font-semibold text-[#0369a1] hover:underline cursor-pointer">
                        {{ $latestOrder->domain_name }}
                    </p>
                @else
                    <p class="text-sm font-semibold text-slate-800">Not configured</p>
                @endif
            </div>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Template</p>
                <p class="text-sm font-semibold text-slate-800">{{ $latestOrder->template?->name ?? 'None' }}</p>
            </div>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Status</p>
                <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-[10px] font-bold {{ $websiteStatusClass }}">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    {{ $websiteStatusLabel }}
                </span>
            </div>
        </div>
    @else
        <div class="flex-1 rounded-xl bg-slate-50 p-4 flex items-center">
            <p class="text-[11px] font-medium leading-5 text-slate-500">
                User belum memiliki website atau pesanan.
            </p>
        </div>
    @endif
</div>