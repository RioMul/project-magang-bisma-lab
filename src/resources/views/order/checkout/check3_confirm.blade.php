<div class="max-w-4xl mx-auto space-y-6">
    
    {{-- HEADER CONFIRMATION --}}
    <div class="mb-6">
        {{-- TOMBOL KEMBALI / GANTI BANK --}}
        <form action="{{ route('order.checkout.reset_payment') }}" method="POST" class="mb-6">
            @csrf
            <button type="submit" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-[#0369a1] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali Pilih Bank
            </button>
        </form>

        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Konfirmasi Pesanan</h1>
        <p class="text-slate-500 text-sm mt-1">Satu langkah terakhir. Pastikan detail pesanan sudah sesuai.</p>
    </div>

    {{-- KARTU UTAMA --}}
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden" 
         x-data="{ 
            activeSlide: 0, 
            modalOpen: false,
            slides: [
                '{{ asset($template->images->where('is_primary', true)->first()->image_path ?? 'tech1.png') }}',
                'https://placehold.co/1200x800/e2e8f0/64748b?text=Preview+Halaman+Produk',
                'https://placehold.co/1200x800/e2e8f0/64748b?text=Preview+Versi+Mobile'
            ]
         }">
        
        {{-- BAGIAN ATAS: Gambar Preview Slider --}}
        <div class="relative w-full h-48 sm:h-80 bg-slate-900 overflow-hidden group cursor-pointer" @click="modalOpen = true">
            
            <template x-for="(slide, index) in slides" :key="index">
                <img :src="slide" x-show="activeSlide === index" class="absolute inset-0 w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105" x-transition.opacity.duration.500ms>
            </template>

            {{-- Controls Panah --}}
            <button @click.stop="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1" class="absolute left-4 top-1/2 -translate-y-1/2 w-8 h-8 flex items-center justify-center bg-black/40 hover:bg-black/70 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity z-20">❮</button>
            <button @click.stop="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1" class="absolute right-4 top-1/2 -translate-y-1/2 w-8 h-8 flex items-center justify-center bg-black/40 hover:bg-black/70 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity z-20">❯</button>

            {{-- Indikator Titik --}}
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-1.5 z-20">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click.stop="activeSlide = index" class="w-1.5 h-1.5 rounded-full transition-colors" :class="activeSlide === index ? 'bg-white w-3' : 'bg-white/40'"></button>
                </template>
            </div>
            
            {{-- Gradient & Teks Info (Pointer events none agar klik tembus ke gambar) --}}
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/95 via-slate-900/40 to-transparent flex items-end p-6 sm:p-10 pointer-events-none z-10">
                <div class="w-full flex justify-between items-end">
                    <div>
                        <span class="px-3 py-1 bg-[#0369a1] text-white text-[10px] font-black uppercase tracking-wider rounded-lg mb-2 sm:mb-3 inline-block shadow-md">Template Terpilih</span>
                        <h2 class="text-2xl sm:text-4xl font-black text-white drop-shadow-md">{{ $template->name }}</h2>
                        <p class="text-slate-300 mt-1 sm:mt-2 max-w-2xl text-xs sm:text-base leading-relaxed drop-shadow-md line-clamp-2 sm:line-clamp-none">{{ $template->description }}</p>
                    </div>
                    <div class="hidden sm:flex items-center gap-1 text-white bg-black/30 px-3 py-1.5 rounded-lg backdrop-blur-sm text-xs font-bold pointer-events-auto cursor-pointer" @click="modalOpen = true">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg> Klik untuk perbesar
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL FULLSCREEN UNTUK DATA TEMPLATE --}}
        <div x-show="modalOpen" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/90 backdrop-blur-sm p-4 sm:p-8">
            <div @click.away="modalOpen = false" class="bg-white rounded-3xl overflow-hidden shadow-2xl max-w-5xl w-full relative flex flex-col max-h-[90vh]">
                <button @click="modalOpen = false" class="absolute top-4 right-4 z-50 w-10 h-10 bg-black/50 text-white rounded-full flex items-center justify-center hover:bg-black/80 transition backdrop-blur-md">✕</button>
                
                {{-- Gambar Modal --}}
                <div class="relative w-full flex-1 bg-slate-100 min-h-[40vh] sm:min-h-[50vh] flex items-center justify-center overflow-auto p-4">
                    <img :src="slides[activeSlide]" class="max-w-full max-h-[70vh] object-contain rounded-xl shadow-lg">
                </div>
                
                {{-- Detail Modal --}}
                <div class="p-6 bg-white shrink-0 border-t border-slate-200 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div>
                        <span class="text-[10px] font-black text-[#0369a1] uppercase tracking-wider">{{ $template->type->name ?? 'Kategori' }}</span>
                        <h3 class="text-xl sm:text-2xl font-black text-slate-900">{{ $template->name }}</h3>
                        <p class="text-sm text-slate-500 mt-1 max-w-2xl">{{ $template->description }}</p>
                    </div>
                    <div class="flex gap-2 w-full sm:w-auto">
                        <button @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1" class="flex-1 sm:flex-none px-6 py-2.5 bg-slate-100 hover:bg-slate-200 rounded-xl font-bold text-slate-700 text-sm transition">Prev</button>
                        <button @click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1" class="flex-1 sm:flex-none px-6 py-2.5 bg-slate-100 hover:bg-slate-200 rounded-xl font-bold text-slate-700 text-sm transition">Next</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- BAGIAN TENGAH: Data Pembeli & Metode Pembayaran --}}
        <div class="p-6 sm:p-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5 mb-8 sm:mb-10">
                {{-- Akun Tertaut --}}
                <div class="bg-slate-50 rounded-2xl p-4 sm:p-5 border border-slate-100 flex items-center gap-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white flex items-center justify-center text-[#0369a1] font-bold shadow-sm shrink-0 border border-slate-100">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] text-[#0369a1] font-black uppercase tracking-wider">Akun Tertaut</p>
                        <p class="text-sm font-bold text-slate-900 mt-0.5 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-[11px] sm:text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                {{-- Metode Pembayaran --}}
                <div class="bg-slate-50 rounded-2xl p-4 sm:p-5 border border-slate-100 flex items-center gap-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-white flex items-center justify-center text-[#057A55] shadow-sm shrink-0 border border-slate-100">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] text-[#057A55] font-black uppercase tracking-wider">Metode Pembayaran</p>
                        <p class="text-sm font-bold text-slate-900 mt-0.5 uppercase truncate">{{ str_replace('_', ' ', session('order.payment_method')) }}</p>
                    </div>
                </div>
            </div>

            {{-- BAGIAN BAWAH: Rincian Harga --}}
            <h3 class="text-base sm:text-lg font-black text-slate-800 mb-4 sm:mb-5 flex items-center gap-2">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#0369a1]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg> Rincian Layanan
            </h3>
            
            <div class="border border-slate-200 rounded-2xl overflow-hidden mb-8">
                {{-- List Domain --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 sm:p-5 bg-white border-b border-slate-100 gap-3 sm:gap-4">
                    <div class="flex items-center gap-4 min-w-0">
                        <div class="w-10 h-10 rounded-xl bg-sky-50 text-[#0369a1] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Domain Terdaftar (1 Tahun)</p>
                            <p class="font-bold text-slate-900 mt-0.5 truncate">{{ $domain }}</p>
                        </div>
                    </div>
                    <div class="text-left sm:text-right font-bold text-slate-800 whitespace-nowrap pl-14 sm:pl-0">
                        Rp {{ number_format($domainPrice, 0, ',', '.') }}
                    </div>
                </div>

                {{-- List Paket --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 sm:p-5 bg-white gap-3 sm:gap-4">
                    <div class="flex items-center gap-4 min-w-0">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-[#057A55] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Paket Layanan (1 Tahun)</p>
                            <p class="font-bold text-slate-900 mt-0.5 truncate">{{ $package->name }} Plan</p>
                        </div>
                    </div>
                    <div class="text-left sm:text-right font-bold text-slate-800 whitespace-nowrap pl-14 sm:pl-0">
                        Rp {{ number_format($package->price_annually, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            {{-- TOTAL & TOMBOL BAYAR --}}
            <div class="bg-slate-50 rounded-2xl p-5 sm:p-8 border border-slate-200 flex flex-col md:flex-row items-center justify-between gap-5 sm:gap-6">
                <div class="w-full md:w-auto text-center md:text-left">
                    <span class="font-black text-slate-500 uppercase tracking-wider text-[11px]">Total Dibayar</span>
                    <div class="text-3xl sm:text-4xl font-black text-[#0369a1] mt-1 tracking-tight whitespace-nowrap">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
                </div>
                
                <form action="{{ route('order.checkout.finalize') }}" method="POST" class="w-full md:w-auto">
                    @csrf
                    <button type="submit" class="w-full md:w-auto px-10 sm:px-12 py-3.5 sm:py-4 bg-[#0369a1] hover:bg-[#027ea8] text-white rounded-xl font-black shadow-md transition text-base sm:text-lg flex items-center justify-center gap-2">
                        Bayar Sekarang <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            </div>

            {{-- Jaminan / Guarantee --}}
            <div class="flex items-center justify-center gap-6 sm:gap-8 text-[9px] sm:text-[10px] font-bold text-slate-400 uppercase mt-8">
                <span class="flex flex-col items-center gap-1.5"><svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#057A55]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg> SSL SECURE</span>
                <span class="flex flex-col items-center gap-1.5"><svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#0369a1]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> GUARANTEED</span>
            </div>
            
        </div>

        {{-- Footer Card --}}
        <div class="bg-slate-50 p-4 sm:p-5 text-center border-t border-slate-100">
            <p class="text-[9px] sm:text-[10px] text-slate-500 leading-relaxed">
                <strong class="text-slate-700">14-Day Money-Back Guarantee:</strong> If you're not satisfied with Bisma Labs, contact us for a full refund. No questions asked.
            </p>
        </div>
    </div>
</div>