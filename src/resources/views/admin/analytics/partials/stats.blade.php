<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-5">
    {{-- Card 1: Total Visitors --}}
    <div class="bg-white rounded-xl border border-slate-100 p-5 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <div class="w-8 h-8 rounded-lg bg-sky-50 text-[#0369a1] flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-600 text-[9px] font-bold">
                <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg> +12.5%
            </span>
        </div>
        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Visitors</p>
        <h3 class="text-xl font-bold text-slate-800">{{ number_format($totalVisitors) }}</h3>
    </div>

    {{-- Card 2: Unique Visitors --}}
    <div class="bg-white rounded-xl border border-slate-100 p-5 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <div class="w-8 h-8 rounded-lg bg-sky-50 text-[#0369a1] flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"/></svg>
            </div>
            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-600 text-[9px] font-bold">
                <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg> +8.2%
            </span>
        </div>
        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider mb-1">Unique Visitors</p>
        <h3 class="text-xl font-bold text-slate-800">{{ number_format($uniqueVisitors) }}</h3>
    </div>

    {{-- Card 3: Bounce Rate --}}
    <div class="bg-white rounded-xl border border-slate-100 p-5 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <div class="w-8 h-8 rounded-lg bg-slate-50 text-slate-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            </div>
            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-rose-50 text-rose-600 text-[9px] font-bold">
                <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"/></svg> -2.4%
            </span>
        </div>
        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider mb-1">Bounce Rate</p>
        <h3 class="text-xl font-bold text-slate-800">{{ $bounceRate ?? '42.8' }}%</h3>
    </div>

    {{-- Card 4: Avg. Session --}}
    <div class="bg-white rounded-xl border border-slate-100 p-5 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <div class="w-8 h-8 rounded-lg bg-slate-50 text-slate-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-slate-100 text-slate-500 text-[9px] font-bold">
                Stable
            </span>
        </div>
        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider mb-1">Avg. Session</p>
        <h3 class="text-xl font-bold text-slate-800">{{ $averageSession ?? '3m 42s' }}</h3>
    </div>
</div>