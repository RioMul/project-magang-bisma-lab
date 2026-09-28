<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    {{-- Card 1: Total Invoice --}}
    <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-sky-50 text-[#0369a1] flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[11px] font-bold">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg> +12%
            </span>
        </div>
        <p class="text-xs font-semibold text-slate-500 mb-1">Total Invoice</p>
        <h3 class="text-3xl font-bold text-slate-900">{{ number_format($totalInvoices) }}</h3>
    </div>

    {{-- Card 2: Invoice Ditagih --}}
    <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-slate-50 text-slate-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" stroke-linejoin="round" d="M3.6 9h16.8M3.6 15h16.8M12 3v18"/></svg>
            </div>
            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[11px] font-bold">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg> +5%
            </span>
        </div>
        <p class="text-xs font-semibold text-slate-500 mb-1">Invoice Ditagih</p>
        <h3 class="text-3xl font-bold text-slate-900">{{ number_format($pendingInvoices) }}</h3>
    </div>

    {{-- Card 3: Invoice Dibayar --}}
    <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="2" ry="2"/><circle cx="12" cy="12" r="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 12h.01M18 12h.01"/></svg>
            </div>
            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[11px] font-bold">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg> +18%
            </span>
        </div>
        <p class="text-xs font-semibold text-slate-500 mb-1">Invoice Dibayar</p>
        <h3 class="text-3xl font-bold text-slate-900">{{ number_format($paidInvoices) }}</h3>
    </div>

    {{-- Card 4: Invoice Expired --}}
    <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l4 4m0-4l-4 4"/></svg>
            </div>
            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-rose-50 text-rose-600 text-[11px] font-bold">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"/></svg> -2%
            </span>
        </div>
        <p class="text-xs font-semibold text-slate-500 mb-1">Invoice Expired</p>
        <h3 class="text-3xl font-bold text-slate-900">{{ number_format($failedInvoices) }}</h3>
    </div>
</div>