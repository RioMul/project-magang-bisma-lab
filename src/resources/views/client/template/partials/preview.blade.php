<div class="flex-1 bg-[#e2e8f0] flex flex-col items-center justify-center p-8 relative overflow-hidden">
    <div class="bg-white rounded-[32px] shadow-2xl flex flex-col overflow-hidden transition-all duration-300 ring-1 ring-slate-200" :class="viewMode === 'mobile' ? 'w-[375px] h-[812px]' : 'w-full max-w-[1000px] h-[90%]'">
        
        {{-- Mockup Header (Browser Bar) --}}
        <div class="h-14 bg-white border-b border-slate-100 flex items-center px-6 gap-4 shrink-0">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-rose-400"></div>
                <div class="w-3 h-3 rounded-full bg-amber-300"></div>
                <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
            </div>
            <div class="flex-1 flex justify-center">
                <div class="px-6 py-1.5 rounded-full bg-slate-50 border border-slate-100 text-[10px] font-bold text-slate-500 tracking-wider">
                    {{ $order->domain_name ?? 'Live Preview' }}
                </div>
            </div>
            <div class="w-16"></div>
        </div>

        {{-- IFRAME LIVE PREVIEW --}}
        <div class="flex-1 w-full h-full bg-slate-50 relative">
            <iframe src="{{ route('client.website.preview') }}" id="previewIframe" class="w-full h-full border-none"></iframe>
        </div>
    </div>

    {{-- View Toggles (Mockup Controls) --}}
    <div class="absolute bottom-6 flex items-center gap-8 text-[11px] font-bold text-slate-500 bg-white px-6 py-3 rounded-full shadow-md border border-slate-200">
        <button @click="viewMode = 'mobile'" class="flex items-center gap-2 transition" :class="viewMode === 'mobile' ? 'text-[#0369a1]' : 'hover:text-slate-800'">
            Mobile View
        </button>
        <button @click="viewMode = 'desktop'" class="flex items-center gap-2 transition" :class="viewMode === 'desktop' ? 'text-[#0369a1]' : 'hover:text-slate-800'">
            Desktop View
        </button>
        <button onclick="document.getElementById('previewIframe').contentWindow.location.reload();" class="text-sky-600 hover:text-sky-800 flex items-center gap-2 transition ml-4 border-l border-slate-200 pl-6">
            Refresh
        </button>
    </div>
</div>