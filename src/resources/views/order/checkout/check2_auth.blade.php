<div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start" x-data="{ tab: '{{ (old('name') || $errors->has('name') || $errors->has('password') || ($errors->has('email') && old('name'))) ? 'register' : 'login' }}' }">
    
    {{-- KIRI: FORM LOGIN/REGISTER --}}
    <div class="lg:col-span-7 space-y-6">
        
        <div class="mb-8">
            {{-- TOMBOL KEMBALI --}}
            <form action="{{ route('order.checkout.reset_payment') }}" method="POST" class="mb-6">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-[#0369a1] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali Pilih Bank
                </button>
            </form>

            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-[#057A55] text-white flex items-center justify-center font-bold shrink-0">✓</div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Buat Akun Dulu!</h1>
                    <p class="text-slate-500 text-sm mt-1">Tinggal selangkah lagi. Silakan buat akun untuk melanjutkan pembayaran.</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
            {{-- TAB CONTROLS (Berdampingan di semua ukuran layar) --}}
            <div class="flex rounded-xl bg-slate-100 p-1.5 mb-8">
                <button type="button" @click="tab = 'register'" :class="tab === 'register' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-900'" class="flex-1 py-3 text-xs font-bold uppercase tracking-wider rounded-lg transition-all">
                    Register
                </button>
                <button type="button" @click="tab = 'login'" :class="tab === 'login' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-900'" class="flex-1 py-3 text-xs font-bold uppercase tracking-wider rounded-lg transition-all">
                    Login
                </button>
            </div>

            <div x-show="tab === 'register'" x-cloak>
                <form action="{{ route('order.check_register.process') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div><label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-2">Nama Lengkap</label><input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-[#0369a1]"></div>
                        <div><label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-2">Email</label><input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-[#0369a1]"></div>
                    </div>
                    <div><label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-2">Password Baru</label><input type="password" name="password" required class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-[#0369a1]"></div>
                    <div><label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-2">Konfirmasi Password</label><input type="password" name="password_confirmation" required class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-[#0369a1]"></div>
                    <button type="submit" class="w-full bg-[#0369a1] hover:bg-[#027ea8] text-white font-bold text-sm py-4 rounded-xl shadow-md transition mt-2">Selesaikan Pendaftaran & Lanjut Bayar!</button>
                    <p class="text-[10px] text-center text-slate-400 mt-4">Dengan mendaftar, Anda menyetujui Syarat & Ketentuan Bisma Labs.</p>
                </form>
            </div>

            <div x-show="tab === 'login'" x-cloak>
                <form action="{{ route('order.check_login.process') }}" method="POST" class="space-y-5">
                    @csrf
                    <div><label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-2">Email</label><input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-[#0369a1]"></div>
                    <div><label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-2">Password</label><input type="password" name="password" required class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-[#0369a1]"></div>
                    <button type="submit" class="w-full bg-[#0369a1] hover:bg-[#027ea8] text-white font-bold text-sm py-4 rounded-xl shadow-md transition mt-2">Masuk & Lanjut Bayar!</button>
                </form>
            </div>
        </div>
    </div>

    {{-- KANAN: CARD PREMIUM --}}
    <div class="lg:col-span-5 lg:sticky lg:top-28 space-y-6">
        <div class="flex items-center justify-end text-[11px] font-bold text-emerald-600 gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg> Sesi Aman & Terenkripsi
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
            
            <div class="relative h-48 sm:h-64 bg-slate-900 border-b border-slate-100 group overflow-hidden shrink-0">
                <img src="{{ asset($template->images->where('is_primary', true)->first()->image_path ?? 'tech1.png') }}" class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/30 to-transparent flex items-end p-6 sm:p-8">
                    <div class="w-full">
                        <span class="px-3 py-1 bg-[#0369a1] text-white text-[10px] font-black uppercase tracking-wider rounded-lg mb-2 sm:mb-3 inline-block shadow-md">Template Terpilih</span>
                        <h3 class="text-2xl sm:text-3xl font-black text-white drop-shadow-md">{{ $template->name }}</h3>
                        <p class="text-xs sm:text-sm text-slate-200 mt-1 sm:mt-2 line-clamp-2 drop-shadow-md">{{ $template->description }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6 sm:p-8 flex-1 flex flex-col">
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100 space-y-5 mb-6">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-sky-100 text-[#0369a1] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Domain Terdaftar</p>
                            <p class="font-bold text-slate-900 text-sm truncate">{{ $domain }}</p>
                        </div>
                    </div>
                    <div class="h-px bg-slate-200 w-full"></div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-[#057A55] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Paket Layanan</p>
                            <p class="font-bold text-slate-900 text-sm">{{ $package->name }} <span class="text-slate-500 font-medium text-xs">(Tahunan)</span></p>
                        </div>
                    </div>
                </div>

                <div class="space-y-3 text-sm px-2 mb-6 flex-1">
                    <div class="flex justify-between items-center gap-4">
                        <span class="font-bold text-slate-500">Biaya Paket</span>
                        <span class="font-bold text-slate-800 whitespace-nowrap">Rp {{ number_format($package->price_annually, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center gap-4">
                        <span class="font-bold text-slate-500">Registrasi Domain</span>
                        <span class="font-bold text-slate-800 whitespace-nowrap">Rp {{ number_format($domainPrice, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="pt-5 border-t border-slate-100 flex justify-between items-end px-2 gap-4">
                    <span class="font-black text-slate-800 uppercase tracking-wider text-[11px] sm:text-xs mb-1">Total Dibayar</span>
                    <div class="text-2xl sm:text-3xl font-black text-[#0369a1] whitespace-nowrap">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
                </div>
                
                <p class="mt-6 text-xs text-center text-slate-400 font-bold bg-slate-50 p-4 rounded-xl border border-slate-100">Selesaikan registrasi terlebih dahulu..</p>
            </div>
        </div>
    </div>
</div>