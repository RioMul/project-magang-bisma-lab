<x-guest-layout>
    <div class="grid grid-cols-1 lg:grid-cols-2 min-h-screen">
        
        {{-- KIRI: FORM REGISTER --}}
        <div class="flex flex-col justify-center px-8 sm:px-16 md:px-24 lg:px-16 xl:px-24 bg-white relative py-12">
            
            {{-- Tombol Back Mandiri --}}
            <a href="{{ route('home') }}" class="absolute top-8 left-8 sm:left-16 lg:left-16 xl:left-24 text-sm font-bold text-slate-400 hover:text-[#0396c7] transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Beranda
            </a>

            <div class="w-full max-w-sm mx-auto mt-8 lg:mt-0">
                <div class="mb-10">
                    <img src="{{ asset('logo.png') }}" alt="BismaLabs" class="h-10 w-auto mb-8" onerror="this.onerror=null;this.src='https://placehold.co/150x45/0396c7/ffffff?text=BismaLabs';">
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Daftar Akun Baru</h1>
                    <p class="text-slate-500 mt-2 font-medium">Satu langkah lagi menuju website profesional Anda.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-2">Nama Lengkap</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-cyan-100 focus:border-[#0396c7] transition">
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-xs font-bold" />
                    </div>

                    <div>
                        <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-2">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-cyan-100 focus:border-[#0396c7] transition">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs font-bold" />
                    </div>

                    <div>
                        <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-2">Password (Min. 8 Karakter)</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-cyan-100 focus:border-[#0396c7] transition">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs font-bold" />
                    </div>

                    <div>
                        <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-2">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-cyan-100 focus:border-[#0396c7] transition">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-xs font-bold" />
                    </div>

                    <button type="submit" class="w-full py-4 bg-[#0396c7] hover:bg-[#027ea7] text-white font-black rounded-xl shadow-lg shadow-cyan-900/20 transition transform hover:-translate-y-0.5 mt-2">
                        Buat Akun Sekarang
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-slate-500 font-medium">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-bold text-[#0396c7] hover:underline">Masuk di sini</a>
                </p>
            </div>
        </div>

        {{-- KANAN: BRANDING (Akan tersembunyi jika dibuka di HP) --}}
        <div class="hidden lg:flex relative bg-slate-900 items-center justify-center overflow-hidden">
            {{-- Menggunakan gambar dummy alternatif --}}
            <img src="{{ asset('tech1.png') }}" class="absolute inset-0 w-full h-full object-cover opacity-40 mix-blend-overlay" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80';">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0396c7]/80 to-transparent mix-blend-multiply"></div>
            
            <div class="relative z-10 max-w-lg px-8 text-center">
                <h2 class="text-4xl font-black text-white leading-tight mb-4">Skalakan Bisnis Anda ke Seluruh Dunia.</h2>
                <p class="text-lg text-cyan-50 font-medium leading-relaxed mb-8">Bergabunglah dengan ribuan pengusaha sukses lainnya yang telah mempercayakan kehadiran digital mereka pada Bisma Labs.</p>
                
                <div class="flex flex-col gap-4 text-left bg-white/10 backdrop-blur-md p-6 rounded-3xl border border-white/20">
                    <div class="flex items-center gap-3 text-white">
                        <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center shrink-0">✓</div>
                        <span class="font-bold text-sm">Gratis Domain & SSL Setup</span>
                    </div>
                    <div class="flex items-center gap-3 text-white">
                        <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center shrink-0">✓</div>
                        <span class="font-bold text-sm">Ratusan Template Premium</span>
                    </div>
                    <div class="flex items-center gap-3 text-white">
                        <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center shrink-0">✓</div>
                        <span class="font-bold text-sm">Support Teknis 24/7</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-guest-layout>