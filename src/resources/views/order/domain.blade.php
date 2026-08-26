@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Alert Error jika ada pelanggaran step -->
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-xs font-bold rounded-r-xl shadow-sm flex items-center justify-between">
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Stepper Component dengan Indikator Status -->
        <div class="flex items-center justify-center mb-12">
            <div class="flex items-center space-x-3 sm:space-x-4">
                <div class="flex items-center text-emerald-600">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-emerald-600 text-white text-xs font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </span>
                    <span class="ml-2 text-xs font-semibold uppercase tracking-wider hidden sm:inline">Template</span>
                </div>
                <div class="w-8 sm:w-12 h-0.5 bg-emerald-600"></div>

                <div class="flex items-center text-sky-900">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-sky-900 text-white text-xs font-bold ring-4 ring-sky-100">2</span>
                    <span class="ml-2 text-xs font-bold uppercase tracking-wider text-sky-900">Domain</span>
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

        <!-- Header Title -->
        <div class="text-center max-w-xl mx-auto mb-8">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Cek Ketersediaan <span class="text-sky-900">Domain Anda</span>
            </h1>
            <p class="text-slate-500 text-sm mt-2">
                Template terpilih: <span class="font-bold text-slate-800">{{ $selectedTemplate->name ?? 'Custom Template' }}</span>
            </p>
        </div>

        <!-- Form Pencarian Domain -->
        <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm space-y-6">
            <form action="{{ route('order.domain') }}" method="GET" class="flex gap-3">
                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 font-bold text-sm">www.</span>
                    <input 
                        type="text" 
                        name="q" 
                        value="{{ $searchQuery ?? '' }}" 
                        placeholder="contoh: tokombakhars" 
                        required 
                        class="w-full pl-14 pr-4 py-3 bg-white border border-slate-300 rounded-xl text-sm focus:ring-sky-900 focus:border-sky-900 font-medium"
                    >
                </div>
                <button type="submit" class="bg-sky-900 hover:bg-sky-800 text-white font-bold text-xs uppercase tracking-wider px-6 py-3 rounded-xl shadow-sm transition">
                    Cek Domain
                </button>
            </form>

            <!-- Hasil Pengecekan Ketersediaan -->
            @if(isset($domainResults))
                <div class="pt-4 border-t border-slate-100 space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Hasil Pengecekan untuk "{{ $searchQuery }}"</h3>
                    
                    <form action="{{ route('order.domain.store') }}" method="POST" class="space-y-3">
                        @csrf
                        @foreach($domainResults as $res)
                            <div class="flex items-center justify-between p-4 rounded-xl border {{ $res['available'] ? 'border-slate-200 bg-white hover:border-sky-900' : 'border-red-100 bg-red-50/40 opacity-75' }} transition">
                                <div class="flex items-center space-x-3">
                                    @if($res['available'])
                                        <input type="radio" 
                                               name="selected_domain" 
                                               value="{{ $res['domain'] }}" 
                                               onclick="document.getElementById('domain_price_input').value = '{{ $res['price'] }}'"
                                               required 
                                               class="text-sky-900 focus:ring-sky-900">
                                    @else
                                        <!-- Tanda silang merah jika domain sudah dipakai orang -->
                                        <span class="w-5 h-5 flex items-center justify-center rounded-full bg-red-100 text-red-600 text-xs font-bold">✕</span>
                                    @endif
                                    <div>
                                        <p class="font-bold text-slate-900 text-sm">{{ $res['domain'] }}</p>
                                        <span class="text-xs {{ $res['available'] ? 'text-emerald-600 font-semibold' : 'text-red-500 font-medium' }}">
                                            {{ $res['available'] ? 'Tersedia' : 'Sudah dimiliki orang lain / Tidak tersedia' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    @if($res['available'])
                                        <span class="text-sm font-extrabold text-slate-900">Rp {{ number_format($res['price'], 0, ',', '.') }}</span>
                                        <span class="text-[10px] text-slate-400 block">/tahun</span>
                                    @else
                                        <span class="text-xs font-bold text-red-400 uppercase tracking-wider">Terpakai</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        <!-- Hidden input untuk menampung harga domain yang dipilih -->
                        <input type="hidden" name="domain_price" id="domain_price_input" value="150000">

                        <div class="flex items-center justify-between pt-4">
                            <a href="{{ route('order.template') }}" class="text-xs font-bold text-slate-500 hover:text-slate-800">
                                &larr; Kembali ke Template
                            </a>
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider px-8 py-3 rounded-xl shadow-sm transition">
                                Lanjut ke Paket Harga &rarr;
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection