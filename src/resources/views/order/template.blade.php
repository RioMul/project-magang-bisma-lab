@extends('layouts.app')

@section('content')
<style>
    [x-cloak] { display: none !important; }
</style>

<div class="min-h-screen bg-slate-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-center mb-10">
            <div class="flex items-center space-x-3 sm:space-x-4">
                <div class="flex items-center text-sky-900">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-sky-900 text-white text-xs font-bold ring-4 ring-sky-100">1</span>
                    <span class="ml-2 text-xs font-bold uppercase tracking-wider text-sky-900">Template</span>
                </div>
                <div class="w-8 sm:w-12 h-0.5 bg-slate-200"></div>

                <div class="flex items-center text-slate-400">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-200 text-slate-500 text-xs font-bold">2</span>
                    <span class="ml-2 text-xs font-semibold uppercase tracking-wider text-slate-400 hidden sm:inline">Domain</span>
                </div>
                <div class="w-8 sm:w-12 h-0.5 bg-slate-200"></div>

                <div class="flex items-center text-slate-400">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-200 text-slate-500 text-xs font-bold">3</span>
                    <span class="ml-2 text-xs font-semibold uppercase tracking-wider text-slate-400 hidden sm:inline">Paket</span>
                </div>
                <div class="w-8 sm:w-12 h-0.5 bg-slate-200"></div>

                <div class="flex items-center text-slate-400">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-200 text-slate-500 text-xs font-bold">4</span>
                    <span class="ml-2 text-xs font-semibold uppercase tracking-wider text-slate-400 hidden sm:inline">Checkout</span>
                </div>
            </div>
        </div>

        <div class="text-center max-w-2xl mx-auto mb-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                Choose Your <span class="text-sky-900">Digital Canvas</span>
            </h1>
            <p class="text-slate-500 text-sm mt-3">
                Start with a professionally crafted template designed for high performance and effortless customization.
            </p>
        </div>

        <div class="max-w-xl mx-auto mb-8">
            <form action="{{ route('order.template') }}" method="GET" class="relative flex items-center">
                <input type="hidden" name="category" value="{{ request('category', 'All') }}">
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search templates for your business..." class="w-full pl-11 pr-28 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-sky-900/20 focus:border-sky-900 shadow-sm">
                    <button type="submit" class="absolute right-2 top-2 bottom-2 bg-sky-900 hover:bg-sky-800 text-white text-xs font-semibold px-5 rounded-lg transition">Search</button>
                </div>
            </form>
        </div>

        <div class="flex items-center justify-center flex-wrap gap-2 mb-10">
            <a href="{{ route('order.template', ['category' => 'All', 'search' => request('search')]) }}" class="px-4 py-1.5 rounded-full text-xs font-semibold transition {{ ($selectedCategory ?? 'All') === 'All' ? 'bg-sky-900 text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">All Templates</a>
            @foreach($categories as $category)
                <a href="{{ route('order.template', ['category' => $category, 'search' => request('search')]) }}" class="px-4 py-1.5 rounded-full text-xs font-semibold transition {{ ($selectedCategory ?? '') === $category ? 'bg-sky-900 text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">{{ $category }}</a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($templates as $tmpl)
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col group">
                    
                    {{-- SLIDER GAMBAR TEMPLATE --}}
                    <div class="aspect-[16/10] bg-slate-900 overflow-hidden relative" 
                         x-data="{ activeSlide: 0, slides: [
                             '{{ asset($tmpl->images->where('is_primary', true)->first()->image_path ?? 'tech1.png') }}',
                             'https://placehold.co/600x400/e2e8f0/64748b?text=Preview+Fitur+1',
                             'https://placehold.co/600x400/e2e8f0/64748b?text=Preview+Mobile'
                         ]}">
                        
                        <template x-for="(slide, index) in slides" :key="index">
                            <img :src="slide" x-show="activeSlide === index" alt="{{ $tmpl->name }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500" x-transition.opacity.duration.500ms>
                        </template>

                        {{-- Tombol Geser (Hanya Muncul Saat di-Hover) --}}
                        <button @click.prevent="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1" class="absolute left-2 top-1/2 -translate-y-1/2 w-8 h-8 bg-black/40 hover:bg-black/60 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-10">❮</button>
                        <button @click.prevent="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1" class="absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 bg-black/40 hover:bg-black/60 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-10">❯</button>

                        {{-- Indikator Titik --}}
                        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5 z-10">
                            <template x-for="(slide, index) in slides" :key="index">
                                <div class="w-1.5 h-1.5 rounded-full transition-colors" :class="activeSlide === index ? 'bg-white' : 'bg-white/40'"></div>
                            </template>
                        </div>
                    </div>

                    <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-slate-900 text-base">{{ $tmpl->name }}</h3>
                            <span class="bg-slate-100 text-slate-600 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">{{ $tmpl->type->name ?? 'Kategori' }}</span>
                        </div>
                        <div class="flex items-center gap-3 pt-2">
                            <a href="{{ route('template.detail', $tmpl->slug) }}" class="w-1/2 text-center py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition">Detail</a>
                            <form action="{{ route('order.template.store') }}" method="POST" class="w-1/2">
                                @csrf
                                <input type="hidden" name="template_id" value="{{ $tmpl->id }}">
                                <button type="submit" class="w-full py-2.5 px-4 bg-sky-900 hover:bg-sky-800 text-white rounded-xl text-xs font-bold shadow-sm transition">Use Template</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-2xl border border-dashed border-slate-200">
                    <p class="text-slate-400 text-sm">Tidak ada template yang ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection