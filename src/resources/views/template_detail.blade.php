@extends('layouts.app')

@section('content')
<style>
    [x-cloak] {
        display: none !important;
    }
    html {
        scroll-behavior: smooth;
    }
    .custom-scrollbar::-webkit-scrollbar {
        height: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

@php
    $galleryImages = $template->images;
    $rating = $template->reviews->avg('rating');
    $ratingCount = $template->reviews->count();
    $templateType = $template->type->name ?? 'Website Template';
    
    $templateData = $template->template_data ?? [];
    $menuItems = $templateData['header']['menu'] ?? [];
    $categories = $templateData['body']['categories'] ?? [];
    $products = $templateData['body']['products'] ?? [];
    $layout = $templateData['layout'] ?? null;
    
    $similarTemplates = \App\Models\Template::with([
        'type',
        'images' => function ($query) {
            $query->where('is_primary', true);
        },
        'reviews'
    ])
        ->where('is_active', true)
        ->where('id', '!=', $template->id)
        ->where('template_type_id', $template->template_type_id)
        ->latest()
        ->take(3)
        ->get();

    if ($similarTemplates->count() < 3) {
        $additionalTemplates = \App\Models\Template::with([
            'type',
            'images' => function ($query) {
                $query->where('is_primary', true);
            },
            'reviews'
        ])
            ->where('is_active', true)
            ->where('id', '!=', $template->id)
            ->whereNotIn('id', $similarTemplates->pluck('id'))
            ->latest()
            ->take(3 - $similarTemplates->count())
            ->get();
        $similarTemplates = $similarTemplates->concat($additionalTemplates);
    }
@endphp

<div class="min-h-screen bg-slate-50 pt-28 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-[#0396c7] transition">Beranda</a>
            <span class="text-slate-300">/</span>
            <a href="{{ route('order.template') }}" class="hover:text-[#0396c7] transition">Template</a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-800 font-bold truncate">{{ $template->name }}</span>
        </div>

        {{-- Main Layout: 2 Columns Modern UI --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
            
            {{-- KOLOM KIRI (Area Scroll Utama) --}}
            <div class="lg:col-span-7 space-y-8">
                
                {{-- 1. Preview Galeri --}}
                <section 
                    x-data="{ 
                        activeSlide: 0, 
                        modalOpen: false, 
                        slides: @js($galleryImages->map(fn ($img) => asset($img->image_path))->values()->all()) 
                    }" 
                    class="bg-white border border-slate-200 rounded-[2rem] p-4 sm:p-5 shadow-sm"
                >
                    <div class="relative aspect-[16/10] rounded-2xl overflow-hidden bg-slate-100 group">
                        <template x-if="slides.length">
                            <template x-for="(slide, index) in slides" :key="index">
                                <img 
                                    :src="slide" 
                                    x-show="activeSlide === index" 
                                    x-transition.opacity.duration.300ms 
                                    @click="modalOpen = true"
                                    class="absolute inset-0 w-full h-full object-cover cursor-zoom-in group-hover:scale-[1.02] transition-transform duration-500" 
                                    alt="{{ $template->name }}"
                                >
                            </template>
                        </template>

                        <template x-if="!slides.length">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-8 h-8 mx-auto text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-width="1.5" d="M4 16l4-4a2 2 0 012.8 0l3.2 3.2 2-2a2 2 0 012.8 0L20 14.4M5 19h14a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v12a1 1 0 001 1z"/>
                                    </svg>
                                    <p class="text-xs text-slate-400 mt-2">Preview belum tersedia</p>
                                </div>
                            </div>
                        </template>

                        @if($galleryImages->count() > 1)
                            <button type="button" @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/90 shadow-md flex items-center justify-center text-slate-700 hover:bg-white hover:scale-105 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button type="button" @click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/90 shadow-md flex items-center justify-center text-slate-700 hover:bg-white hover:scale-105 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        @endif
                    </div>

                    @if($galleryImages->count() > 1)
                        <div class="flex gap-3 mt-4 overflow-x-auto custom-scrollbar pb-2">
                            @foreach($galleryImages as $index => $image)
                                <button type="button" @click="activeSlide = {{ $index }}" class="w-20 h-14 shrink-0 rounded-xl overflow-hidden border-2 transition-all duration-200" :class="activeSlide === {{ $index }} ? 'border-[#0396c7] opacity-100' : 'border-transparent opacity-60 hover:opacity-100'">
                                    <img src="{{ asset($image->image_path) }}" alt="{{ $image->alt_text ?? $template->name }}" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif

                    {{-- Modal Zoom --}}
                    <div x-show="modalOpen" x-cloak x-transition.opacity class="fixed inset-0 z-[100] bg-slate-900/95 backdrop-blur-sm flex items-center justify-center p-4">
                        <div @click.away="modalOpen = false" class="relative max-w-6xl w-full">
                            <button type="button" @click="modalOpen = false" class="absolute -top-12 right-0 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-width="2" d="M6 6l12 12M18 6L6 18"/></svg>
                            </button>
                            <img :src="slides[activeSlide]" class="w-full max-h-[85vh] object-contain rounded-xl" alt="{{ $template->name }}">
                        </div>
                    </div>
                </section>

                {{-- 2. Template Structure & Content --}}
                <section class="bg-white border border-slate-200 rounded-[2rem] p-6 sm:p-8 shadow-sm">
                    <div class="mb-8">
                        <p class="text-xs font-black uppercase tracking-widest text-[#0396c7] mb-1">Analisis Template</p>
                        <h2 class="text-2xl font-bold text-slate-900">Struktur & Konten</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Struktur Box --}}
                        <div class="border border-slate-200 rounded-2xl p-5">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h3 class="text-base font-bold text-slate-800">Halaman Bawaan</h3>
                                    <p class="text-xs text-slate-500 mt-0.5">Struktur navigasi siap pakai</p>
                                </div>
                                <span class="bg-sky-50 text-[#0396c7] text-xs font-bold px-3 py-1 rounded-full">{{ count($menuItems) }} Hal</span>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                @forelse($menuItems as $menu)
                                    <span class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-xs font-medium text-slate-600 shadow-sm">{{ $menu }}</span>
                                @empty
                                    <span class="text-xs text-slate-400 italic">Menu belum dikonfigurasi</span>
                                @endforelse
                            </div>
                        </div>

                        {{-- Konten Box --}}
                        <div class="bg-slate-50 rounded-2xl p-5">
                            <div class="mb-4">
                                <h3 class="text-base font-bold text-slate-800">Kapasitas Konten Awal</h3>
                                <p class="text-xs text-slate-500 mt-0.5">Komponen yang disematkan</p>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="bg-white rounded-xl px-4 py-3 border border-slate-100 shadow-sm">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase">Kategori</p>
                                    <p class="text-lg font-black text-slate-800 mt-1">{{ count($categories) }} <span class="text-xs font-normal text-slate-500">item</span></p>
                                </div>
                                <div class="bg-white rounded-xl px-4 py-3 border border-slate-100 shadow-sm">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase">Produk</p>
                                    <p class="text-lg font-black text-slate-800 mt-1">{{ count($products) }} <span class="text-xs font-normal text-slate-500">slot</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- 3. Reviews --}}
                <section class="bg-white border border-slate-200 rounded-[2rem] p-6 sm:p-8 shadow-sm">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                        <div>
                            <p class="text-xs font-black uppercase tracking-widest text-[#0396c7] mb-1">Feedback</p>
                            <h2 class="text-2xl font-bold text-slate-900">Ulasan Pengguna</h2>
                        </div>
                        @if($rating)
                            <div class="flex items-center gap-2 bg-amber-50 px-4 py-2 rounded-xl">
                                <span class="text-amber-500"><svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></span>
                                <span class="text-base font-black text-slate-900">{{ number_format($rating, 1) }}</span>
                                <span class="text-xs font-medium text-slate-500">({{ $ratingCount }} ulasan)</span>
                            </div>
                        @endif
                    </div>

                    @if($template->reviews->count())
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($template->reviews->take(4) as $review)
                                <div class="rounded-2xl bg-slate-50 p-5">
                                    <div class="flex items-center justify-between gap-2 mb-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-600">
                                                {{ strtoupper(substr($review->user->name ?? 'P', 0, 1)) }}
                                            </div>
                                            <p class="text-sm font-bold text-slate-800 truncate">{{ $review->user->name ?? 'Pengguna Anonim' }}</p>
                                        </div>
                                        <div class="flex text-amber-400">
                                            @for($i = 0; $i < $review->rating; $i++)
                                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-sm text-slate-600 leading-relaxed line-clamp-3">
                                        {{ $review->comment ?? 'Template yang sangat bagus dan mudah disesuaikan!' }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-10 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                            <p class="text-slate-500 font-medium">Belum ada ulasan untuk template ini.</p>
                            <p class="text-xs text-slate-400 mt-1">Jadilah yang pertama mencoba dan memberikan ulasan!</p>
                        </div>
                    @endif
                </section>
            </div>

            {{-- KOLOM KANAN (Sticky Info & CTA) --}}
            <div class="lg:col-span-5 sticky top-28 space-y-8">
                
                {{-- Template Information Panel --}}
                <div class="bg-white border border-slate-200 rounded-[2rem] p-6 sm:p-8 shadow-sm">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="px-3 py-1 bg-sky-50 text-[#0396c7] text-xs font-black rounded-full uppercase tracking-wider">
                            {{ $templateType }}
                        </span>
                        @if($template->difficulty)
                            <span class="flex items-center gap-1 px-3 py-1 bg-slate-100 text-slate-500 text-xs font-bold rounded-full">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                {{ $template->difficulty }}
                            </span>
                        @endif
                    </div>
                    
                    <h1 class="text-3xl font-black text-slate-900 leading-tight">
                        {{ $template->name }}
                    </h1>
                    
                    @if($template->description)
                        <p class="text-sm text-slate-600 leading-relaxed mt-4">
                            {{ $template->description }}
                        </p>
                    @endif
                    
                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <p class="text-xs font-black uppercase tracking-widest text-slate-400 mb-4">Fitur Bawaan</p>
                        <div class="grid grid-cols-2 gap-y-4 gap-x-2">
                            <div class="flex items-center gap-2.5 text-sm text-slate-700 font-semibold">
                                <div class="w-6 h-6 rounded-md bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </div> 
                                Responsive
                            </div>
                            <div class="flex items-center gap-2.5 text-sm text-slate-700 font-semibold">
                                <div class="w-6 h-6 rounded-md bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </div> 
                                Customizable
                            </div>
                            @if($layout === 'shop')
                                <div class="flex items-center gap-2.5 text-sm text-slate-700 font-semibold">
                                    <div class="w-6 h-6 rounded-md bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    </div> 
                                    Product Catalog
                                </div>
                            @endif
                            @if(!empty($templateData['seo']))
                                <div class="flex items-center gap-2.5 text-sm text-slate-700 font-semibold">
                                    <div class="w-6 h-6 rounded-md bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    </div> 
                                    SEO Ready
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mt-8 flex flex-col gap-3">
                        <form action="{{ route('order.template.store') }}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" name="template_id" value="{{ $template->id }}">
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-[#0396c7] hover:bg-[#027ea7] text-white text-base font-black transition transform hover:-translate-y-0.5 shadow-xl shadow-[#0396c7]/25">
                                Gunakan Template Ini
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </button>
                        </form>
                        <a href="{{ route('template.preview', $template->slug) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl border-2 border-slate-200 bg-white text-base font-bold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Live Preview
                        </a>
                    </div>
                </div>

                {{-- Template Serupa (Pindah ke sidebar kanan) --}}
                @if($similarTemplates->count())
                    <div class="bg-white border border-slate-200 rounded-[2rem] p-6 sm:p-8 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-slate-900">Template Serupa</h3>
                            <a href="{{ route('order.template') }}" class="text-xs font-bold text-[#0396c7] hover:underline">Lihat Semua</a>
                        </div>
                        <div class="flex flex-col gap-4">
                            @foreach($similarTemplates as $similar)
                                @php
                                    $similarImage = $similar->images->first();
                                    $similarRating = $similar->reviews->avg('rating');
                                @endphp
                                <a href="{{ route('template.detail', $similar->slug) }}" class="group flex gap-4 p-3 rounded-2xl border border-transparent hover:border-slate-200 hover:bg-slate-50 transition">
                                    <div class="w-24 h-20 shrink-0 rounded-xl overflow-hidden bg-slate-100 relative">
                                        @if($similarImage)
                                            <img src="{{ asset($similarImage->image_path) }}" alt="{{ $similar->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0 py-1">
                                        <p class="text-[10px] font-bold uppercase tracking-wider text-[#0396c7] mb-1 truncate">{{ $similar->type->name ?? 'Template' }}</p>
                                        <h4 class="text-sm font-bold text-slate-900 truncate group-hover:text-[#0396c7] transition">{{ $similar->name }}</h4>
                                        @if($similarRating)
                                            <div class="flex items-center gap-1 mt-1.5">
                                                <span class="text-amber-400"><svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></span>
                                                <span class="text-[11px] font-medium text-slate-500">{{ number_format($similarRating, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</div>
@endsection