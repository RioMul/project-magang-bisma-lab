<aside class="w-56 bg-white border-r border-slate-100 flex flex-col justify-between py-8 px-5 shrink-0 z-10 shadow-[4px_0_24px_rgba(0,0,0,0.02)]">
    <div>
        <div class="mb-8 px-2">
            <h2 class="text-sm font-bold text-slate-800">Panel Kendali</h2>
            <p class="text-[10px] font-medium text-slate-400 mt-0.5">Pengaturan Toko</p>
        </div>
        <nav class="space-y-1.5" x-show="activeTab === 'editor'" x-transition>
            <button class="w-full flex items-center px-4 py-2.5 rounded-xl text-xs transition text-left bg-sky-50 text-[#0369a1] font-bold border border-sky-100">
                Informasi Utama
            </button>
        </nav>
    </div>
    <div class="space-y-4 px-2">
        <a href="{{ route('dashboard') }}" class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold transition shadow-sm">
            Tutup Editor
        </a>
    </div>
</aside>