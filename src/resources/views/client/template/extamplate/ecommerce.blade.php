<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $templateData['business_name'] ?? 'Toko Online' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .theme-bg { background-color: {{ $templateData['theme_color'] ?? '#ee4d2d' }}; }
        .theme-text { color: {{ $templateData['theme_color'] ?? '#ee4d2d' }}; }
        .theme-border { border-color: {{ $templateData['theme_color'] ?? '#ee4d2d' }}; }
    </style>
</head>
<body class="bg-[#f5f5f5] text-slate-800 font-sans antialiased h-screen flex flex-col">

    {{-- TOPBAR PREVIEW MODE --}}
    @if(Route::is('template.preview'))
    <div class="h-16 bg-slate-900 text-white flex items-center justify-between px-8 shrink-0 relative z-50 shadow-md">
        <div class="flex items-center gap-5">
            <a href="{{ url()->previous() }}" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-700 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            </a>
            <div>
                <span class="text-[10px] font-bold text-sky-400 uppercase tracking-widest">Mode Preview</span>
                <h1 class="text-sm font-bold mt-0.5">{{ $template->name ?? 'Shopee Clone' }}</h1>
            </div>
        </div>
        <form action="{{ route('order.template.store') }}" method="POST">
            @csrf
            <input type="hidden" name="template_id" value="{{ $template->id ?? 1 }}">
            <button type="submit" class="px-6 py-2.5 bg-[#0396c7] hover:bg-[#027ea7] text-white text-xs font-bold rounded-xl transition shadow-sm flex items-center gap-2">
                Gunakan Template Ini
            </button>
        </form>
    </div>
    @endif

    {{-- KONTEN SHOPEE CLONE --}}
    <div class="flex-1 w-full relative overflow-y-auto">
        <header class="theme-bg text-white sticky top-0 z-40 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-1.5 text-[11px] font-medium opacity-90 hidden sm:flex">
                    <div class="flex gap-4">
                        <a href="#" class="hover:opacity-80">Seller Centre</a>
                        <a href="#" class="hover:opacity-80">Mulai Berjualan</a>
                    </div>
                    <div class="flex gap-4">
                        <a href="#" class="hover:opacity-80">Notifikasi</a>
                        <a href="#" class="hover:opacity-80">Bantuan</a>
                    </div>
                </div>
                
                <div class="flex items-center gap-6 py-4">
                    <div class="text-2xl sm:text-3xl font-black tracking-tighter shrink-0 flex items-center gap-2">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M19 6h-2c0-2.76-2.24-5-5-5S7 3.24 7 6H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-7-3c1.66 0 3 1.34 3 3H9c0-1.66 1.34-3 3-3zm7 17H5V8h14v12z"/></svg>
                        {{ $templateData['business_name'] ?? 'Shopee Clone' }}
                    </div>
                    <div class="flex-1 max-w-3xl relative hidden sm:block">
                        <input type="text" placeholder="{{ $templateData['search_placeholder'] ?? 'Cari produk di toko ini...' }}" class="w-full py-2.5 pl-4 pr-12 rounded-sm text-slate-800 text-sm focus:outline-none">
                        <button class="absolute right-1 top-1 bottom-1 w-12 theme-bg rounded-sm flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
            <div class="bg-white p-2 rounded-sm shadow-sm flex flex-col lg:flex-row gap-2">
                <div class="flex-1 bg-slate-200 h-[240px] sm:h-[300px] rounded-sm relative overflow-hidden">
                    <img src="{{ str_starts_with($templateData['main_banner'] ?? 'jpg1.jpg', 'storage/') ? asset($templateData['main_banner']) : asset($templateData['main_banner'] ?? 'jpg1.jpg') }}" class="w-full h-full object-cover">
                </div>
                <div class="hidden lg:flex flex-col gap-2 w-1/3">
                    <div class="flex-1 bg-slate-200 rounded-sm overflow-hidden flex items-center justify-center text-slate-400 font-bold">Promo Spesial</div>
                    <div class="flex-1 bg-slate-200 rounded-sm overflow-hidden flex items-center justify-center text-slate-400 font-bold">Cashback 50%</div>
                </div>
            </div>

            <div class="bg-white rounded-sm shadow-sm p-4 text-center">
                <p class="text-slate-600 font-medium">{{ $templateData['description'] ?? 'Deskripsi toko Anda akan muncul di sini.' }}</p>
                <button class="mt-4 px-6 py-2 text-white font-bold rounded-sm shadow-sm theme-bg">{{ $templateData['button_text'] ?? 'Beli Sekarang' }}</button>
            </div>

            <div class="bg-white rounded-sm shadow-sm">
                <div class="p-4 border-b border-slate-100 flex justify-between items-center">
                    <h2 class="text-base font-bold theme-text uppercase tracking-wide">Rekomendasi Produk</h2>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-2 p-2">
                    @for($i=1; $i<=12; $i++)
                    <div class="bg-white border border-slate-200 hover:border-[#ee4d2d] transition group cursor-pointer flex flex-col">
                        <div class="aspect-square bg-slate-100 relative overflow-hidden">
                            <img src="https://placehold.co/300x300/f8fafc/94a3b8?text=Produk+{{$i}}" class="w-full h-full object-cover">
                            <div class="absolute top-0 left-0 bg-rose-500 text-white text-[10px] font-bold px-1.5 py-0.5">-{{ rand(10, 80) }}%</div>
                        </div>
                        <div class="p-2 flex flex-col flex-1">
                            <h3 class="text-xs text-slate-700 line-clamp-2 leading-tight flex-1">Produk Unggulan {{ $i }} Berkualitas Tinggi</h3>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="theme-text font-bold text-sm">Rp {{ number_format(rand(10000, 500000), 0, ',', '.') }}</span>
                                <span class="text-[10px] text-slate-400">{{ rand(10, 999) }} Terjual</span>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </main>
    </div>
</body>
</html>