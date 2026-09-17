<div>
    <div class="flex items-center gap-2 text-sm font-semibold text-slate-500">
        <a href="{{ route('admin.users.index') }}" class="hover:text-[#0369a1] transition">Users</a>
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-slate-800">{{ $user->name }}</span>
    </div>

    <div class="mt-5 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-5">
            <div class="relative shrink-0">
                <div class="w-[72px] h-[72px] sm:w-20 sm:h-20 rounded-2xl bg-slate-800 text-white flex items-center justify-center font-bold text-2xl overflow-hidden shadow-sm">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=1e293b&color=fff" alt="{{ $user->name }}" class="w-full h-full object-cover">
                </div>
                <div class="absolute -bottom-2 right-1 sm:-right-2 bg-[#f7f9fc] p-1 rounded-full">
                    <span class="flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider shadow-sm {{ $statusClass }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ str_contains($statusClass, 'emerald') ? 'bg-emerald-500' : (str_contains($statusClass, 'amber') ? 'bg-amber-500' : (str_contains($statusClass, 'red') ? 'bg-rose-500' : 'bg-sky-500')) }}"></span>
                        {{ $statusLabel }}
                    </span>
                </div>
            </div>
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">{{ $user->name }}</h1>
                <p class="text-xs sm:text-sm font-medium text-slate-500 mt-1">
                    {{ $user->email }} &bull; Member since {{ $user->created_at->format('M Y') }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            
            {{-- LOGIKA TOMBOL HAPUS/SUSPEND --}}
            @if(!$user->orders()->exists())
                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun user ini secara permanen?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-200 hover:bg-rose-100 text-slate-600 hover:text-rose-600 text-xs font-bold transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Delete User
                    </button>
                </form>
            @else
                <button type="button" disabled title="User tidak dapat dihapus karena sudah memiliki riwayat pesanan." class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-200 text-slate-400 text-xs font-bold transition shadow-sm opacity-70 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                    Suspend User
                </button>
            @endif

            {{-- TOMBOL EXTEND (Diarahkan ke halaman Edit User) --}}
            <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#0369a1] hover:bg-[#075985] text-white text-xs font-bold transition shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                Extend Subscription
            </a>
        </div>
    </div>
</div>