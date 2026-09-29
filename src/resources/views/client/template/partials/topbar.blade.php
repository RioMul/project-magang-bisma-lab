<header class="h-[72px] bg-white border-b border-slate-200 flex items-center justify-between px-8 shrink-0 relative z-20">
    <div class="flex items-center gap-14 h-full">
        <div class="text-xl font-extrabold tracking-tight text-slate-900">
            Bisma Labs Editor
        </div>
        
        {{-- Navigasi Tab (Berjalan instan dengan Alpine @click) --}}
        <nav class="flex items-center h-full gap-8 text-sm font-semibold text-slate-400">
            <button type="button" @click="activeTab = 'editor'" :class="activeTab === 'editor' ? 'text-[#0369a1] border-b-2 border-[#0369a1]' : 'hover:text-slate-600'" class="h-full flex items-center px-1 transition-colors">
                General
            </button>
            <button type="button" @click="activeTab = 'seo'" :class="activeTab === 'seo' ? 'text-[#0369a1] border-b-2 border-[#0369a1]' : 'hover:text-slate-600'" class="h-full flex items-center px-1 transition-colors">
                SEO & Meta
            </button>
        </nav>
    </div>
    <div class="flex items-center gap-6">
        <a href="{{ route('dashboard') }}" class="text-sm font-bold text-slate-500 hover:text-slate-800 transition">
            Kembali ke Dashboard
        </a>
        <button type="submit" form="editor-form" class="px-7 py-2.5 rounded-xl bg-[#0369a1] hover:bg-[#075985] text-white text-sm font-bold transition shadow-sm">
            Simpan Perubahan
        </button>
    </div>
</header>