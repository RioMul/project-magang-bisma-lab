<div class="flex-1 bg-[#e2e8f0] flex flex-col items-center justify-center p-8 relative overflow-hidden">
    {{-- MOCKUP CONTAINER --}}
    <div 
        class="bg-white rounded-[32px] shadow-2xl flex flex-col overflow-hidden transition-all duration-300 ring-1 ring-slate-200"
        :class="viewMode === 'mobile' ? 'w-[375px] h-[812px]' : 'w-full max-w-[1000px] h-[90%]'"
    >
        {{-- Mockup Header (Browser Bar) --}}
        <div class="h-14 bg-white border-b border-slate-100 flex items-center px-6 gap-4 shrink-0">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-rose-400"></div>
                <div class="w-3 h-3 rounded-full bg-amber-300"></div>
                <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
            </div>
            <div class="flex-1 flex justify-center">
                <div class="px-6 py-1.5 rounded-full bg-slate-50 border border-slate-100 text-[10px] font-bold text-slate-500 tracking-wider">
                    {{ $website['domain']['name'] ?? 'www.bismalabs.atelier.com' }}
                </div>
            </div>
            <div class="w-16"></div> {{-- Spacer --}}
        </div>

        {{-- IFRAME LIVE PREVIEW --}}
        <div class="flex-1 w-full h-full bg-slate-50 relative">
            {{-- Loading Indicator saat Iframe memuat --}}
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none" x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 1500)" x-show="loading">
                <div class="w-8 h-8 border-4 border-[#0369a1] border-t-transparent rounded-full animate-spin"></div>
            </div>
            {{-- Menampilkan Homepage (Landing Page) secara Live --}}
            <iframe src="{{ route('home') }}" class="w-full h-full border-none"></iframe>
        </div>
    </div>

    {{-- View Toggles (Mobile / Desktop) --}}
    <div class="absolute bottom-6 flex items-center gap-8 text-[11px] font-bold text-slate-500 bg-white px-6 py-3 rounded-full shadow-md border border-slate-200">
        <button 
            @click="viewMode = 'mobile'" 
            class="flex items-center gap-2 transition"
            :class="viewMode === 'mobile' ? 'text-[#0369a1]' : 'hover:text-slate-800'"
        >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><path stroke-linecap="round" d="M12 18h.01"/></svg>
            Mobile View
        </button>
        <button 
            @click="viewMode = 'desktop'" 
            class="flex items-center gap-2 transition"
            :class="viewMode === 'desktop' ? 'text-[#0369a1]' : 'hover:text-slate-800'"
        >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="14" rx="2"/><path stroke-linecap="round" d="M8 22h8m-4-4v4"/></svg>
            Desktop View
        </button>
    </div>
</div>