<aside class="w-56 bg-white border-r border-slate-100 flex flex-col justify-between py-8 px-5 shrink-0 z-10 shadow-[4px_0_24px_rgba(0,0,0,0.02)]">
    <div>
        <div class="mb-8 px-2">
            <h2 class="text-sm font-bold text-slate-800">Atelier Editor</h2>
            <p class="text-[10px] font-medium text-slate-400 mt-0.5">Site Settings</p>
        </div>
        <nav class="space-y-1.5">
            <a href="{{ route('admin.websites.index', ['tab' => 'editor', 'section' => 'header']) }}" class="w-full flex items-center px-4 py-2.5 rounded-lg text-xs transition text-left {{ $section === 'header' ? 'bg-sky-50 text-[#0369a1] font-bold' : 'text-slate-500 hover:bg-slate-50 font-semibold' }}">
                Header
            </a>
            <a href="{{ route('admin.websites.index', ['tab' => 'editor', 'section' => 'body']) }}" class="w-full flex items-center px-4 py-2.5 rounded-lg text-xs transition text-left {{ $section === 'body' ? 'bg-sky-50 text-[#0369a1] font-bold' : 'text-slate-500 hover:bg-slate-50 font-semibold' }}">
                Body
            </a>
            <a href="{{ route('admin.websites.index', ['tab' => 'editor', 'section' => 'sidebar']) }}" class="w-full flex items-center px-4 py-2.5 rounded-lg text-xs transition text-left {{ $section === 'sidebar' ? 'bg-sky-50 text-[#0369a1] font-bold' : 'text-slate-500 hover:bg-slate-50 font-semibold' }}">
                Sidebar
            </a>
            <a href="{{ route('admin.websites.index', ['tab' => 'editor', 'section' => 'footer']) }}" class="w-full flex items-center px-4 py-2.5 rounded-lg text-xs transition text-left {{ $section === 'footer' ? 'bg-sky-50 text-[#0369a1] font-bold' : 'text-slate-500 hover:bg-slate-50 font-semibold' }}">
                Footer
            </a>
        </nav>
    </div>
    <div class="space-y-4 px-2">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center gap-2 w-full py-2.5 rounded-lg bg-[#0369a1] hover:bg-[#075985] text-white text-xs font-bold transition shadow-sm">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
        <button class="w-9 h-9 rounded-full border border-slate-200 flex items-center justify-center text-[#0369a1] hover:bg-sky-50 transition shadow-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </button>
    </div>
</aside>