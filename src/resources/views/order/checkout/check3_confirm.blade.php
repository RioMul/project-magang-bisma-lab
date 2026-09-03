<div class="max-w-4xl mx-auto space-y-6">
    
    {{-- HEADER CONFIRMATION --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Konfirmasi Pesanan</h1>
            <p class="text-slate-500 text-sm mt-1">Satu langkah terakhir. Pastikan detail pesanan sudah sesuai.</p>
        </div>
        <form action="{{ route('order.checkout.reset_payment') }}" method="POST" class="shrink-0">
            @csrf
            <button type="submit" class="text-xs font-bold text-[#0369a1] hover:text-[#027ea8] bg-sky-50 px-4 py-2 rounded-lg transition flex items-center gap-1">
                ← Ganti Metode Pembayaran
            </button>
        </form>
    </div>

    {{-- KARTU UTAMA (Mirip Template Detail) --}}
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        
        {{-- BAGIAN ATAS: Gambar Preview Lebar & Deskripsi Template --}}
        <div class="relative w-full h-64 sm:h-96 bg-slate-900 overflow-hidden group">
            <img src="{{ asset($template->images->where('is_primary', true)->first()->image_path ?? 'tech1.png') }}" class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
            
            {{-- Gradient & Teks --}}
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/95 via-slate-900/40 to-transparent flex items-end p-6 sm:p-10">
                <div class="w-full">
                    <span class="px-3 py-1 bg-[#0369a1] text-white text-[10px] font-black uppercase tracking-wider rounded-lg mb-3 inline-block shadow-md">Template Terpilih</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-white drop-shadow-md">{{ $template->name }}</h2>
                    <p class="text-slate-300 mt-2 max-w-2xl text-sm sm:text-base leading-relaxed drop-shadow-md">{{ $template->description }}</p>
                </div>
            </div>
        </div>

        {{-- BAGIAN TENGAH: Data Pembeli & Metode Pembayaran --}}
        <div class="p-6 sm:p-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-10">
                {{-- Akun Tertaut --}}
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-[#0369a1] font-bold shadow-sm shrink-0 border border-slate-100">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] text-[#0369a1] font-black uppercase tracking-wider">Akun Tertaut</p>
                        <p class="text-sm font-bold text-slate-900 mt-0.5 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                {{-- Metode Pembayaran --}}
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center text-[#057A55] shadow-sm shrink-0 border border-slate-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-[#057A55] font-black uppercase tracking-wider">Metode Pembayaran</p>
                        <p class="text-sm font-bold text-slate-900 mt-0.5 uppercase">{{ str_replace('_', ' ', session('order.payment_method')) }}</p>
                    </div>
                </div>
            </div>

            {{-- BAGIAN BAWAH: Rincian Harga --}}
            <h3 class="text-lg font-black text-slate-800 mb-5 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#0369a1]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg> Rincian Layanan
            </h3>
            
            <div class="border border-slate-200 rounded-2xl overflow-hidden mb-8">
                {{-- List Domain --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between p-5 bg-white border-b border-slate-100 gap-4 sm:gap-0">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-sky-50 text-[#0369a1] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Domain Terdaftar (1 Tahun)</p>
                            <p class="font-bold text-slate-900 mt-0.5">{{ $domain }}</p>
                        </div>
                    </div>
                    <div class="text-left sm:text-right font-bold text-slate-800">
                        Rp {{ number_format($domainPrice, 0, ',', '.') }}
                    </div>
                </div>

                {{-- List Paket --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between p-5 bg-white gap-4 sm:gap-0">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-[#057A55] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Paket Layanan (1 Tahun)</p>
                            <p class="font-bold text-slate-900 mt-0.5">{{ $package->name }} Plan</p>
                        </div>
                    </div>
                    <div class="text-left sm:text-right font-bold text-slate-800">
                        Rp {{ number_format($package->price_annually, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            {{-- TOTAL & TOMBOL BAYAR --}}
            <div class="bg-slate-50 rounded-2xl p-6 sm:p-8 border border-slate-200 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="w-full md:w-auto text-center md:text-left">
                    <span class="font-black text-slate-500 uppercase tracking-wider text-[11px]">Total Dibayar</span>
                    <div class="text-4xl font-black text-[#0369a1] mt-1 tracking-tight">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
                </div>
                
                <form action="{{ route('order.checkout.finalize') }}" method="POST" class="w-full md:w-auto">
                    @csrf
                    <button type="submit" class="w-full md:w-auto px-12 py-4 bg-[#0369a1] hover:bg-[#027ea8] text-white rounded-xl font-black shadow-md transition text-lg flex items-center justify-center gap-2">
                        Bayar Sekarang <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            </div>

            {{-- Jaminan / Guarantee --}}
            <div class="flex items-center justify-center gap-8 text-[10px] font-bold text-slate-400 uppercase mt-8">
                <span class="flex flex-col items-center gap-1.5"><svg class="w-5 h-5 text-[#057A55]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg> SSL SECURE</span>
                <span class="flex flex-col items-center gap-1.5"><svg class="w-5 h-5 text-[#0369a1]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> GUARANTEED</span>
            </div>
            
        </div>

        {{-- Footer Card --}}
        <div class="bg-slate-50 p-5 text-center border-t border-slate-100">
            <p class="text-[10px] text-slate-500 leading-relaxed">
                <strong class="text-slate-700">14-Day Money-Back Guarantee:</strong> If you're not satisfied with Bisma Labs, contact us for a full refund. No questions asked.
            </p>
        </div>
    </div>
</div>