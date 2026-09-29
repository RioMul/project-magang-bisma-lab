<header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 shrink-0 relative z-20">
    <div class="flex items-center gap-14 h-full">
        <div class="text-xl font-extrabold tracking-tight text-slate-900">
            Bisma Labs
        </div>
        <nav class="flex items-center h-full gap-8 text-sm font-semibold text-slate-400">
            <a href="{{ route('admin.websites.index', ['tab' => 'editor', 'section' => $section]) }}" 
               class="h-full flex items-center px-1 transition-colors {{ $tab === 'editor' ? 'text-[#0369a1] border-b-2 border-[#0369a1]' : 'hover:text-slate-600' }}">
                Editor
            </a>
            <a href="{{ route('admin.websites.index', ['tab' => 'seo', 'section' => $section]) }}" 
               class="h-full flex items-center px-1 transition-colors {{ $tab === 'seo' ? 'text-[#0369a1] border-b-2 border-[#0369a1]' : 'hover:text-slate-600' }}">
                SEO
            </a>
            <a href="{{ route('admin.websites.index', ['tab' => 'domain', 'section' => $section]) }}" 
               class="h-full flex items-center px-1 transition-colors {{ $tab === 'domain' ? 'text-[#0369a1] border-b-2 border-[#0369a1]' : 'hover:text-slate-600' }}">
                Domain
            </a>
        </nav>
    </div>
    <div class="flex items-center gap-6">
        <a href="{{ route('home') }}" target="_blank" class="text-sm font-bold text-slate-500 hover:text-slate-800 transition">
            Preview Website
        </a>
        <button type="submit" form="editor-form" class="px-7 py-2 rounded-lg bg-[#0369a1] hover:bg-[#075985] text-white text-sm font-bold transition shadow-sm">
            Save
        </button>
    </div>
</header>