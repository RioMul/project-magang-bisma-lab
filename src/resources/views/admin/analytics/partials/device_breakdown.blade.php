<div class="bg-white rounded-xl border border-slate-100 p-6 shadow-sm">
    <h2 class="text-sm font-bold text-slate-800 mb-5">Device Breakdown</h2>
    
    <div class="flex items-center justify-center mb-5">
        <div class="relative w-24 h-24">
            <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                <path class="text-sky-100" stroke-width="4" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                <path class="text-[#0369a1]" stroke-dasharray="64, 100" stroke-width="4" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
            </svg>
            <div class="absolute inset-0 flex flex-col items-center justify-center">
                <span class="text-xl font-bold text-slate-800">64%</span>
                <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Mobile</span>
            </div>
        </div>
    </div>

    <div class="space-y-3">
        <div class="flex justify-between items-center text-xs">
            <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-[#0369a1]"></span> <span class="font-semibold text-slate-600">Mobile</span></div>
            <span class="font-bold text-slate-800">{{ number_format($deviceData['mobile']['count'] ?? 53907) }}</span>
        </div>
        <div class="flex justify-between items-center text-xs">
            <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-sky-200"></span> <span class="font-semibold text-slate-600">Desktop</span></div>
            <span class="font-bold text-slate-800">{{ number_format($deviceData['desktop']['count'] ?? 28124) }}</span>
        </div>
    </div>
</div>