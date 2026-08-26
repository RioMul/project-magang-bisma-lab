@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Stepper Component -->
        <div class="flex items-center justify-center mb-10">
            <div class="flex items-center space-x-3 sm:space-x-4">
                <!-- Step 1 Active -->
                <div class="flex items-center text-sky-900">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-sky-900 text-white text-xs font-bold ring-4 ring-sky-100">1</span>
                    <span class="ml-2 text-xs font-bold uppercase tracking-wider text-sky-900">Template</span>
                </div>
                <div class="w-8 sm:w-12 h-0.5 bg-slate-200"></div>

                <!-- Step 2 Pending -->
                <div class="flex items-center text-slate-400">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-200 text-slate-500 text-xs font-bold">2</span>
                    <span class="ml-2 text-xs font-semibold uppercase tracking-wider text-slate-400 hidden sm:inline">Domain</span>
                </div>
                <div class="w-8 sm:w-12 h-0.5 bg-slate-200"></div>

                <!-- Step 3 Pending -->
                <div class="flex items-center text-slate-400">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-200 text-slate-500 text-xs font-bold">3</span>
                    <span class="ml-2 text-xs font-semibold uppercase tracking-wider text-slate-400 hidden sm:inline">Paket</span>
                </div>
                <div class="w-8 sm:w-12 h-0.5 bg-slate-200"></div>

                <!-- Step 4 Pending -->
                <div class="flex items-center text-slate-400">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-200 text-slate-500 text-xs font-bold">4</span>
                    <span class="ml-2 text-xs font-semibold uppercase tracking-wider text-slate-400 hidden sm:inline">Checkout</span>
                </div>
            </div>
        </div>

        <!-- Header Title & Subtitle -->
        <div class="text-center max-w-2xl mx-auto mb-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                Choose Your <span class="text-sky-900">Digital Canvas</span>
            </h1>
            <p class="text-slate-500 text-sm mt-3">
                Start with a professionally crafted template designed for high performance and effortless customization.
            </p>
        </div>

        <!-- Search Bar -->
        <div class="max-w-xl mx-auto mb-8">
            <form action="{{ route('order.template') }}" method="GET" class="relative flex items-center">
                <input type="hidden" name="category" value="{{ request('category', 'All') }}">
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search templates for your business..." 
                        class="w-full pl-11 pr-28 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-sky-900/20 focus:border-sky-900 shadow-sm"
                    >
                    <button type="submit" class="absolute right-2 top-2 bottom-2 bg-sky-900 hover:bg-sky-800 text-white text-xs font-semibold px-5 rounded-lg transition">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Category Pills Filter -->
        <div class="flex items-center justify-center flex-wrap gap-2 mb-10">
            <a href="{{ route('order.template', ['category' => 'All', 'search' => request('search')]) }}" 
               class="px-4 py-1.5 rounded-full text-xs font-semibold transition {{ ($selectedCategory ?? 'All') === 'All' ? 'bg-sky-900 text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                All Templates
            </a>
            @foreach($categories as $category)
                <a href="{{ route('order.template', ['category' => $category, 'search' => request('search')]) }}" 
                   class="px-4 py-1.5 rounded-full text-xs font-semibold transition {{ ($selectedCategory ?? '') === $category ? 'bg-sky-900 text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                    {{ $category }}
                </a>
            @endforeach
        </div>

        <!-- Templates Grid (Menggunakan tech1 - tech4) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($templates as $tmpl)
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col group">
                    <div class="aspect-[16/10] bg-slate-900 overflow-hidden relative">
                        <img 
                            src="{{ asset($tmpl->preview_image) }}" 
                            alt="{{ $tmpl->name }}" 
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                            onerror="this.onerror=null; this.src='{{ asset('tech1.png') }}';"
                        >
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-slate-900 text-base">{{ $tmpl->name }}</h3>
                            <span class="bg-slate-100 text-slate-600 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">
                                {{ $tmpl->category }}
                            </span>
                        </div>
                        <div class="flex items-center gap-3 pt-2">
                            <a href="{{ $tmpl->preview_url ?? '#' }}" target="_blank" class="w-1/2 text-center py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition">
                                Preview
                            </a>
                            <form action="{{ route('order.template.store') }}" method="POST" class="w-1/2">
                                @csrf
                                <input type="hidden" name="template_id" value="{{ $tmpl->id }}">
                                <button type="submit" class="w-full py-2.5 px-4 bg-sky-900 hover:bg-sky-800 text-white rounded-xl text-xs font-bold shadow-sm transition">
                                    Use Template
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-2xl border border-dashed border-slate-200">
                    <p class="text-slate-400 text-sm">Tidak ada template yang ditemukan untuk kategori atau pencarian ini.</p>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection