@extends('layouts.app')

@section('content')
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
            <div class="lg:col-span-7">
                <div class="bg-white rounded-2xl border border-slate-200 p-2 shadow-sm">
                    <img src="{{ asset($template->images->where('is_primary', true)->first()->image_path ?? 'tech1.png') }}" alt="{{ $template->name }}" class="w-full h-auto rounded-xl object-cover">
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