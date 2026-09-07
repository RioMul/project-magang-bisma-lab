@extends('layouts.app')

@section('content')
<style>
    [x-cloak] { display: none !important; }
</style>

<div class="min-h-screen bg-slate-50 py-12 pt-28">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <nav class="flex text-sm text-slate-500 mb-8 font-medium">
            <a href="{{ route('home') }}" class="hover:text-sky-900">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('order.template') }}" class="hover:text-sky-900">Template</a>
            <span class="mx-2">/</span>
            <span class="text-slate-800 font-bold">{{ $template->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            {{-- KIRI: PREVIEW GAMBAR SLIDER --}}
            <div class="lg:col-span-7" 
                 x-data="{ 
                    activeSlide: 0, 
                    modalOpen: false,
                    slides: [
                        '{{ asset($template->images->where('is_primary', true)->first()->image_path ?? 'tech1.png') }}',
                        'https://placehold.co/1200x800/e2e8f0/64748b?text=Preview+Halaman+Produk',
                        'https://placehold.co/1200x800/e2e8f0/64748b?text=Preview+Versi+Mobile'
                    ]
                 }">
                 
                <div class="bg-white rounded-2xl border border-slate-200 p-2 shadow-sm relative group overflow-hidden">
                    <div class="relative w-full aspect-[4/3] rounded-xl overflow-hidden cursor-pointer" @click="modalOpen = true">
                        <template x-for="(slide, index) in slides" :key="index">
                            <img :src="slide" x-show="activeSlide === index" alt="Preview" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 hover:scale-105" x-transition.opacity.duration.500ms>
                        </template>
                        
                        {{-- Icon Zoom (Tengah) --}}
                        <div class="absolute inset-0 bg-slate-900/0 hover:bg-slate-900/20 transition flex items-center justify-center pointer-events-none">
                            <div class="w-12 h-12 bg-white/90 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow-lg">
                                <svg class="w-6 h-6 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                            </div>
                        </div>

                        {{-- Navigasi Panah --}}
                        <button @click.stop="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1" class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 bg-black/40 hover:bg-black/60 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-10">❮</button>
                        <button @click.stop="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1" class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 bg-black/40 hover:bg-black/60 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-10">❯</button>
                        
                        {{-- Indikator Titik --}}
                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                            <template x-for="(slide, index) in slides" :key="index">
                                <button @click.stop="activeSlide = index" class="w-2 h-2 rounded-full transition-colors shadow-sm" :class="activeSlide === index ? 'bg-white w-4' : 'bg-white/50'"></button>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- MODAL FULLSCREEN --}}
                <div x-show="modalOpen" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/90 backdrop-blur-sm p-4 sm:p-8">
                    <div @click.away="modalOpen = false" class="bg-slate-100 rounded-2xl overflow-hidden shadow-2xl max-w-5xl w-full relative flex flex-col max-h-[90vh]">
                        <button @click="modalOpen = false" class="absolute top-4 right-4 z-50 w-10 h-10 bg-black/50 text-white rounded-full flex items-center justify-center hover:bg-black/80 transition backdrop-blur-md">✕</button>
                        <div class="relative w-full flex-1 min-h-[50vh] flex items-center justify-center overflow-auto p-4">
                            <img :src="slides[activeSlide]" class="max-w-full max-h-[80vh] object-contain rounded-xl shadow-lg">
                        </div>
                        <div class="p-6 bg-white border-t border-slate-200 shrink-0 flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-black text-slate-900">{{ $template->name }}</h3>
                                <p class="text-sm text-slate-500 mt-1">Preview Gambar <span x-text="activeSlide + 1"></span> dari <span x-text="slides.length"></span></p>
                            </div>
                            <div class="flex gap-2">
                                <button @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 rounded-lg font-bold text-slate-700 text-sm transition">Prev</button>
                                <button @click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 rounded-lg font-bold text-slate-700 text-sm transition">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 space-y-6">
                <div>
                    <span class="inline-block px-3 py-1 bg-sky-100 text-sky-900 text-[10px] font-bold uppercase tracking-wider rounded-full mb-3">{{ $template->type->name ?? 'Kategori' }}</span>
                    <h1 class="text-3xl font-black text-slate-900">{{ $template->name }}</h1>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="text-amber-400 font-black text-lg">★</span>
                        <span class="text-slate-700 font-bold">{{ number_format($template->reviews->avg('rating'), 1) ?? '5.0' }}</span>
                        <span class="text-slate-400 text-sm">({{ $template->reviews->count() }} ulasan)</span>
                    </div>
                </div>

                <p class="text-slate-600 leading-relaxed">{{ $template->description }}</p>

                <div class="bg-white border border-slate-200 rounded-xl p-5 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Tingkat Kesulitan</span>
                        <span class="font-bold text-slate-800">{{ $template->difficulty }}</span>
                    </div>
                    <hr class="border-slate-100">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Live Demo</span>
                        <a href="{{ $template->demo_url }}" target="_blank" class="font-bold text-sky-900 hover:underline">Lihat Demo →</a>
                    </div>
                </div>

                <form action="{{ route('order.template.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="template_id" value="{{ $template->id }}">
                    <button type="submit" class="w-full py-4 text-center text-sm font-black bg-[#0396c7] hover:bg-[#027ea7] text-white rounded-xl shadow-md transition">
                        Gunakan Template Ini
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-16">
            <h2 class="text-2xl font-black text-slate-900 mb-6">Ulasan Pengguna</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($template->reviews as $review)
                    <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                            <span class="font-bold text-slate-800">{{ $review->user->name ?? 'Anonim' }}</span>
                            <span class="text-amber-400 font-black">★ {{ $review->rating }}</span>
                        </div>
                        <p class="text-slate-600 text-sm">"{{ $review->comment }}"</p>
                    </div>
                @empty
                    <p class="text-slate-500">Belum ada ulasan untuk template ini.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection