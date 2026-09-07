<x-guest-layout>
    <div class="grid grid-cols-1 lg:grid-cols-2 min-h-screen">
        
        {{-- KIRI: FORM LOGIN --}}
        <div class="flex flex-col justify-center px-8 sm:px-16 md:px-24 lg:px-16 xl:px-24 bg-white relative py-12">
            
            {{-- Tombol Back Mandiri --}}
            <a href="{{ route('home') }}" class="absolute top-8 left-8 sm:left-16 lg:left-16 xl:left-24 text-sm font-bold text-slate-400 hover:text-[#0396c7] transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Beranda
            </a>

            <div class="w-full max-w-sm mx-auto mt-8 lg:mt-0">
                <div class="mb-10">
                    <img src="{{ asset('logo.png') }}" alt="BismaLabs" class="h-10 w-auto mb-8" onerror="this.onerror=null;this.src='https://placehold.co/150x45/0396c7/ffffff?text=BismaLabs';">
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Selamat Datang!</h1>
                    <p class="text-slate-500 mt-2 font-medium">Masuk untuk mengelola website dan bisnis Anda.</p>
                </div>

                <x-auth-session-status class="mb-4 text-emerald-600 font-bold text-sm bg-emerald-50 p-4 rounded-xl" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-2">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-cyan-100 focus:border-[#0396c7] transition">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs font-bold" />
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[11px] font-bold text-[#0396c7] hover:underline">Lupa Password?</a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-cyan-100 focus:border-[#0396c7] transition">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs font-bold" />
                    </div>

                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-[#0396c7] focus:ring-[#0396c7]">
                        <label for="remember_me" class="ml-2 text-sm text-slate-600 font-medium">Ingat saya</label>
                    </div>

                    <button type="submit" class="w-full py-4 bg-[#0396c7] hover:bg-[#027ea7] text-white font-black rounded-xl shadow-lg shadow-cyan-900/20 transition transform hover:-translate-y-0.5 mt-2">
                        Masuk Sekarang
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-slate-500 font-medium">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-bold text-[#0396c7] hover:underline">Daftar di sini</a>
                </p>
            </div>
        </div>

        {{-- KANAN: BRANDING (Akan tersembunyi jika dibuka di HP) --}}
        <div class="hidden lg:flex relative bg-slate-900 items-center justify-center overflow-hidden">
            {{-- Menggunakan gambar dummy jika tech1.png tidak ada di path ini --}}
            <img src="{{ asset('tech1.png') }}" class="absolute inset-0 w-full h-full object-cover opacity-40 mix-blend-overlay" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2015&q=80';">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0396c7]/80 to-transparent mix-blend-multiply"></div>
            
            <div class="relative z-10 max-w-lg px-8 text-center">
                <h2 class="text-4xl font-black text-white leading-tight mb-4">Solusi Go-Digital Terbaik untuk UMKM.</h2>
                <p class="text-lg text-cyan-50 font-medium leading-relaxed mb-8">Kelola pesanan, ubah desain, dan pantau statistik pengunjung website Anda dalam satu dashboard cerdas.</p>
                
                <div class="flex items-center justify-center gap-4 bg-white/10 backdrop-blur-md p-4 rounded-2xl border border-white/20">
                    <div class="flex -space-x-3">
                        <div class="w-10 h-10 rounded-full border-2 border-slate-900 bg-sky-100 flex items-center justify-center text-xs font-bold text-sky-900">AB</div>
                        <div class="w-10 h-10 rounded-full border-2 border-slate-900 bg-emerald-100 flex items-center justify-center text-xs font-bold text-emerald-900">CD</div>
                        <div class="w-10 h-10 rounded-full border-2 border-slate-900 bg-amber-100 flex items-center justify-center text-xs font-bold text-amber-900">EF</div>
                    </div>
                    <div class="text-left text-white">
                        <div class="flex items-center gap-1 text-amber-400 text-xs">★★★★★</div>
                        <p class="text-xs font-bold mt-0.5">Dipercaya 2,500+ Klien</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-guest-layout>