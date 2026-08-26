@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Alert Error jika melompati langkah -->
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-xs font-bold rounded-r-xl shadow-sm flex items-center justify-between">
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Stepper Component -->
        <div class="flex items-center justify-center mb-12">
            <div class="flex items-center space-x-3 sm:space-x-4">
                <div class="flex items-center text-emerald-600">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-emerald-600 text-white text-xs font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </span>
                    <span class="ml-2 text-xs font-semibold uppercase tracking-wider hidden sm:inline">Template</span>
                </div>
                <div class="w-8 sm:w-12 h-0.5 bg-emerald-600"></div>

                <div class="flex items-center text-emerald-600">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-emerald-600 text-white text-xs font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </span>
                    <span class="ml-2 text-xs font-semibold uppercase tracking-wider hidden sm:inline">Domain</span>
                </div>
                <div class="w-8 sm:w-12 h-0.5 bg-emerald-600"></div>

                <div class="flex items-center text-sky-900">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-sky-900 text-white text-xs font-bold ring-4 ring-sky-100">3</span>
                    <span class="ml-2 text-xs font-bold uppercase tracking-wider text-sky-900">Paket</span>
                </div>
                <div class="w-8 sm:w-12 h-0.5 bg-slate-200"></div>

                <div class="flex items-center text-slate-400">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-200 text-slate-500 text-xs font-bold">4</span>
                    <span class="ml-2 text-xs font-semibold uppercase tracking-wider text-slate-400 hidden sm:inline">Checkout</span>
                </div>
            </div>
        </div>

        <form action="{{ route('order.package.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <!-- Sisi Kiri: Template Preview Terpilih -->
                <div class="lg:col-span-5 space-y-6">
                    <div>
                        <h1 class="text-3xl font-extrabold text-slate-900 leading-tight">
                            Choose Your<br><span class="text-sky-900">Growth Plan</span>
                        </h1>
                        <p class="text-slate-500 text-sm mt-2">
                            Unlock professional features and premium support tailored for your specific business goals.
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                        <div class="aspect-[16/10] bg-slate-900 rounded-xl overflow-hidden mb-4 relative">
                            <img 
                                src="{{ asset($selectedTemplate->preview_image ?? 'tech1.png') }}" 
                                alt="Template Preview" 
                                class="w-full h-full object-cover"
                                onerror="this.onerror=null; this.src='{{ asset('tech1.png') }}';"
                            >
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <div>
                                <span class="text-slate-400 uppercase font-medium">Selected Template</span>
                                <p class="font-bold text-slate-800 text-sm mt-0.5">{{ $selectedTemplate->name ?? 'Artisan Bakehouse' }}</p>
                            </div>
                            <a href="{{ route('order.template') }}" class="text-sky-900 font-semibold hover:underline">Change Template &rarr;</a>
                        </div>
                    </div>

                    <!-- Informasi Domain yang Dipilih di Step Sebelumnya -->
                    @if(session('order.domain'))
                        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-4 text-xs flex items-center justify-between">
                            <div>
                                <span class="text-emerald-600 font-bold uppercase tracking-wider block">Domain Terpilih</span>
                                <span class="font-extrabold text-slate-800 text-sm">{{ session('order.domain') }}</span>
                            </div>
                            <a href="{{ route('order.domain') }}" class="text-emerald-700 font-bold hover:underline">Ubah &rarr;</a>
                        </div>
                    @endif
                </div>

                <!-- Sisi Kanan: Pilihan Paket Harga -->
                <div class="lg:col-span-7 space-y-4">
                    @foreach($packages as $pkg)
                        <label class="block relative cursor-pointer">
                            <input 
                                type="radio" 
                                name="package_id" 
                                value="{{ $pkg->id }}" 
                                class="peer sr-only" 
                                {{ ($selectedPackageId == $pkg->id || (!$selectedPackageId && $pkg->is_popular)) ? 'checked' : '' }}
                            >
                            
                            <div class="p-5 bg-white rounded-2xl border-2 border-slate-200 peer-checked:border-sky-900 peer-checked:bg-sky-50/20 transition-all flex items-center justify-between shadow-sm hover:border-slate-300">
                                <div class="space-y-1">
                                    <div class="flex items-center space-x-2">
                                        <h3 class="font-bold text-slate-900 text-base">{{ $pkg->name }}</h3>
                                        @if($pkg->is_popular)
                                            <span class="bg-sky-100 text-sky-800 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider">Most Popular</span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-slate-500 max-w-sm">{{ $pkg->description }}</p>
                                    <div class="pt-2 text-xl font-extrabold text-slate-900">
                                        Rp {{ number_format($pkg->price, 0, ',', '.') }} 
                                        <span class="text-xs font-normal text-slate-500">/bln</span>
                                    </div>
                                </div>

                                <div class="pl-4">
                                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 text-slate-700 peer-checked:bg-sky-900 peer-checked:text-white transition">
                                        Select
                                    </span>
                                </div>
                            </div>
                        </label>
                    @endforeach

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="w-full sm:w-auto bg-sky-900 hover:bg-sky-800 text-white px-8 py-3 rounded-xl font-semibold text-sm shadow-md transition flex items-center justify-center space-x-2">
                            <span>Lanjut ke Checkout</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection