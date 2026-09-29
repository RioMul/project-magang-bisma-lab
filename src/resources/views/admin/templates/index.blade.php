@extends('admin.layouts.app')
@section('title', 'Template Management')

@section('content')
<div class="max-w-[1400px] mx-auto space-y-8">

    {{-- HEADER & TOMBOL UPLOAD --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                Template Management
            </h1>
            <p class="mt-1.5 text-sm text-slate-500 font-medium">
                Curate and manage your atelier's digital masterpieces.
            </p>
        </div>
        <a href="{{ route('admin.templates.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#0369a1] hover:bg-[#027ea7] text-white text-sm font-semibold transition shadow-md">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
            </svg>
            Upload New Template
        </a>
    </div>

    {{-- FILTER & SORTING --}}
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5">
        <div class="inline-flex items-center gap-1 bg-white p-1.5 rounded-full border border-slate-100 shadow-sm overflow-x-auto max-w-full">
            <a href="{{ route('admin.templates.index') }}" class="px-6 py-2 rounded-full text-xs font-bold transition whitespace-nowrap {{ !request('category') ? 'bg-white shadow-sm border border-slate-100 text-[#0369a1]' : 'text-slate-500 hover:text-slate-800' }}">
                All
            </a>
            <a href="{{ route('admin.templates.index', ['category' => 'UMKM']) }}" class="px-5 py-2 rounded-full text-xs font-semibold transition whitespace-nowrap {{ request('category') === 'UMKM' ? 'bg-white shadow-sm border border-slate-100 text-[#0369a1]' : 'text-slate-500 hover:text-slate-800' }}">
                UMKM
            </a>
            <a href="{{ route('admin.templates.index', ['category' => 'Company']) }}" class="px-5 py-2 rounded-full text-xs font-semibold transition whitespace-nowrap {{ request('category') === 'Company' ? 'bg-white shadow-sm border border-slate-100 text-[#0369a1]' : 'text-slate-500 hover:text-slate-800' }}">
                Company
            </a>
            <a href="{{ route('admin.templates.index', ['category' => 'School']) }}" class="px-5 py-2 rounded-full text-xs font-semibold transition whitespace-nowrap {{ request('category') === 'School' ? 'bg-white shadow-sm border border-slate-100 text-[#0369a1]' : 'text-slate-500 hover:text-slate-800' }}">
                School
            </a>
            <a href="{{ route('admin.templates.index', ['category' => 'Government']) }}" class="px-5 py-2 rounded-full text-xs font-semibold transition whitespace-nowrap {{ request('category') === 'Government' ? 'bg-white shadow-sm border border-slate-100 text-[#0369a1]' : 'text-slate-500 hover:text-slate-800' }}">
                Government
            </a>
        </div>
        
        <div class="text-xs text-slate-400 flex items-center gap-2">
            Sort by: <span class="font-bold text-slate-700 cursor-pointer hover:text-[#0369a1] flex items-center gap-1">Recently Added <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg></span>
        </div>
    </div>

    {{-- INTERACTIVE GRID DENGAN ALPINE.JS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6" x-data="{ expandedId: null }">
        @forelse($templates as $template)
            @php
                $categoryName = $template->type->name ?? 'Template';
                $badgeClass = match(strtolower($categoryName)) {
                    'umkm' => 'bg-blue-50 text-blue-600',
                    'company' => 'bg-sky-50 text-sky-600',
                    'school' => 'bg-emerald-50 text-emerald-600',
                    'government' => 'bg-slate-100 text-slate-600',
                    default => 'bg-slate-100 text-slate-600'
                };
            @endphp

            <div class="transition-all duration-300" :class="expandedId === {{ $template->id }} ? 'md:col-span-2 xl:col-span-2' : 'col-span-1'">
                
                {{-- 1. STANDAR CARD (Bentuk Vertikal) --}}
                <div x-show="expandedId !== {{ $template->id }}" class="bg-white rounded-[24px] border border-slate-100 shadow-sm flex flex-col h-full overflow-hidden group transition">
                    <div class="h-[200px] w-full bg-slate-900 rounded-t-[24px] overflow-hidden relative">
                        <img 
                            src="{{ asset($template->images->where('is_primary', true)->first()->image_path ?? 'tech1.png') }}" 
                            alt="{{ $template->name }}" 
                            onerror="this.onerror=null; this.src='{{ asset('tech2.png') }}';"
                            class="w-full h-full object-cover opacity-95"
                        >
                        <button @click="expandedId = {{ $template->id }}" class="absolute top-4 left-4 w-9 h-9 bg-white/90 hover:bg-[#0369a1] text-slate-700 hover:text-white rounded-lg flex items-center justify-center transition shadow-md" title="Preview Detail">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-start justify-between gap-3 mb-2">
                            <h3 class="text-lg font-bold text-slate-900 leading-snug">{{ $template->name }}</h3>
                            
                            <form method="POST" action="{{ route('admin.templates.destroy', $template) }}" onsubmit="return confirm('Hapus template ini secara permanen?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="text-rose-300 hover:text-rose-500 transition shrink-0" title="Delete Template">
                                    <svg class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <div class="mb-auto">
                            <span class="inline-block px-3 py-1 rounded-full text-[9px] font-bold uppercase tracking-wider {{ $badgeClass }}">
                                {{ $categoryName }}
                            </span>
                        </div>
                        
                        <div class="mt-8 flex items-center justify-between">
                            <div class="text-[11px] font-medium text-slate-400">
                                Last edit: {{ $template->updated_at->format('M d, Y') }}
                            </div>
                            <div class="flex -space-x-1.5">
                                <div class="w-4 h-4 rounded-full bg-emerald-400 border-2 border-white"></div>
                                <div class="w-4 h-4 rounded-full bg-[#0369a1] border-2 border-white"></div>
                                @if($loop->iteration % 2 == 0)
                                    <div class="w-4 h-4 rounded-full bg-rose-400 border-2 border-white"></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 2. EXPANDED CARD (Gambar 3 - Bentuk Horizontal) --}}
                <div x-show="expandedId === {{ $template->id }}" style="display: none;" class="bg-white rounded-[24px] border border-slate-100 shadow-lg overflow-hidden flex flex-col sm:flex-row h-full">
                    <div class="sm:w-1/2 relative bg-slate-900 min-h-[320px]">
                        <img 
                            src="{{ asset($template->images->where('is_primary', true)->first()->image_path ?? 'tech1.png') }}" 
                            alt="{{ $template->name }}" 
                            onerror="this.onerror=null; this.src='{{ asset('tech2.png') }}';"
                            class="absolute inset-0 w-full h-full object-cover opacity-90"
                        >
                        <div class="absolute top-5 left-5">
                            <span class="px-4 py-1.5 rounded-full bg-[#0369a1] text-white text-[10px] font-bold shadow-sm tracking-wider uppercase">
                                Featured Template
                            </span>
                        </div>
                    </div>
                    <div class="sm:w-1/2 p-8 flex flex-col justify-between relative">
                        <button @click="expandedId = null" class="absolute top-6 right-6 text-slate-300 hover:text-rose-500 transition">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <div>
                            <div class="flex items-center gap-3 pr-10 mb-1">
                                <h3 class="text-2xl font-black text-slate-900 leading-tight">{{ $template->name }}</h3>
                                <span class="inline-block px-2.5 py-1 rounded-md text-[9px] font-bold uppercase tracking-wider {{ $badgeClass }}">
                                    {{ $categoryName }}
                                </span>
                            </div>
                            <p class="text-[13px] text-slate-500 mt-4 leading-relaxed line-clamp-4">
                                {{ $template->description ?? 'A robust, accessible, and secure portal designed specifically for modern municipal and state-level digital services.' }}
                            </p>
                        </div>
                        
                        <div class="mt-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="flex-1 py-3 bg-sky-50 rounded-xl text-center border border-sky-100/50">
                                    <div class="text-xl font-black text-[#0369a1]">98</div>
                                    <div class="text-[8px] font-bold text-sky-500 uppercase tracking-widest mt-1">Lighthouse Score</div>
                                </div>
                                <div class="flex-1 py-3 bg-[#f8fafc] rounded-xl text-center border border-slate-100">
                                    <div class="text-xl font-black text-[#0369a1]">WCAG</div>
                                    <div class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mt-1">Compliant</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.templates.edit', $template) }}" class="flex-1 py-3.5 bg-[#0369a1] hover:bg-[#027ea7] text-white text-[13px] font-bold rounded-xl text-center transition shadow-sm flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M4 20h4l10.768-10.768a2.5 2.5 0 10-3.536-3.536L4.464 16.464A2 2 0 004 17.879V20z"/>
                                    </svg>
                                    Edit Template
                                </a>
                                <a href="{{ $template->demo_url ?? '#' }}" target="_blank" class="w-12 h-12 shrink-0 rounded-xl border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-slate-50 hover:text-[#0369a1] transition">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @empty
            <div class="col-span-full py-20 text-center bg-white rounded-[24px] border border-dashed border-slate-200 shadow-sm">
                <div class="w-16 h-16 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-base font-bold text-slate-700">No Templates Found</h3>
                <p class="text-sm text-slate-500 mt-1">Start by uploading your first digital masterpiece.</p>
            </div>
        @endforelse
    </div>

    {{-- 4. PAGINATION DINAMIS LARAVEL --}}
    @if($templates->hasPages())
        <div class="pt-8 flex justify-center pb-12">
            <div class="inline-flex items-center gap-1 bg-[#f8fafc] border border-slate-200 rounded-full px-2 py-1.5 shadow-sm">
                
                {{-- Tombol Prev --}}
                @if ($templates->onFirstPage())
                    <span class="w-8 h-8 flex items-center justify-center text-slate-300">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    </span>
                @else
                    <a href="{{ $templates->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center text-slate-500 hover:bg-slate-200 rounded-full transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    </a>
                @endif

                {{-- Nomor Halaman (1, 2, 3, 4, dst) secara Dinamis dari Controller --}}
                @foreach ($templates->links()->elements as $element)
                    {{-- Render "..." --}}
                    @if (is_string($element))
                        <span class="w-8 h-8 flex items-center justify-center text-slate-400 text-xs tracking-widest">{{ $element }}</span>
                    @endif

                    {{-- Render Angka Halaman --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $templates->currentPage())
                                <span class="w-8 h-8 flex items-center justify-center bg-[#0369a1] text-white rounded-full text-xs font-bold shadow-sm">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="w-8 h-8 flex items-center justify-center text-slate-500 hover:bg-slate-200 rounded-full text-xs font-bold transition">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Tombol Next --}}
                @if ($templates->hasMorePages())
                    <a href="{{ $templates->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center text-slate-500 hover:bg-slate-200 rounded-full transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                @else
                    <span class="w-8 h-8 flex items-center justify-center text-slate-300">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </span>
                @endif
            </div>
        </div>
    @endif

</div>
@endsection