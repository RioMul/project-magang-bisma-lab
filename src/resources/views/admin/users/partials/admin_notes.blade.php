<div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm flex flex-col h-full">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-[11px] font-bold uppercase tracking-widest text-[#0369a1]">
            Admin Notes
        </h2>
        <svg class="h-5 w-5 text-[#0369a1]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <rect x="4" y="3" width="16" height="18" rx="2"/>
            <path stroke-linecap="round" d="M8 8h8M8 12h8M8 16h5"/>
        </svg>
    </div>
    
    <div class="flex-1 rounded-xl bg-slate-50 border border-slate-100 p-5">
        @if($latestOrder?->admin_notes)
            <p class="text-xs font-medium leading-relaxed text-slate-600">
                {{ $latestOrder->admin_notes }}
            </p>
        @else
            <p class="text-xs font-medium leading-relaxed text-slate-500">
                Belum ada catatan admin untuk order terbaru.
            </p>
        @endif
    </div>
</div>