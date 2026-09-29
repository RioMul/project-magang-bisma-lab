@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-[#f8fafc] py-12 pt-32">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- STEPPER --}}
        <div class="flex items-center justify-center mb-16">
            <div class="flex items-center space-x-3 sm:space-x-4">
                <a href="{{ route('order.template') }}" class="flex items-center flex-col relative">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#057A55] text-white text-xs font-bold">✓</span>
                    <span class="absolute top-10 text-[10px] font-bold uppercase text-[#057A55]">Template</span>
                </a>
                <div class="w-12 sm:w-20 h-[2px] bg-[#057A55] -mt-5"></div>
                <a href="{{ route('order.domain') }}" class="flex items-center flex-col relative">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#057A55] text-white text-xs font-bold">✓</span>
                    <span class="absolute top-10 text-[10px] font-bold uppercase text-[#057A55]">Domain</span>
                </a>
                <div class="w-12 sm:w-20 h-[2px] bg-[#057A55] -mt-5"></div>
                <a href="{{ route('order.package') }}" class="flex items-center flex-col relative">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#057A55] text-white text-xs font-bold">✓</span>
                    <span class="absolute top-10 text-[10px] font-bold uppercase text-[#057A55]">Paket</span>
                </a>
                <div class="w-12 sm:w-20 h-[2px] bg-[#057A55] -mt-5"></div>
                <div class="flex items-center flex-col relative">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#0369a1] text-white text-xs font-bold ring-4 ring-sky-100">4</span>
                    <span class="absolute top-10 text-[10px] font-bold uppercase text-[#0369a1]">Checkout</span>
                </div>
            </div>
        </div>

        {{-- ALERT MENGGUNAKAN GRID 7 KOLOM AGAR SEJAJAR DENGAN FORM KIRI --}}
        @if(session('error') || session('success') || $errors->any())
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start mb-6">
            <div class="lg:col-span-7 space-y-4">
                @if(session('error'))
                    <div class="p-4 rounded-2xl border border-rose-200 bg-rose-50 text-rose-700 text-sm font-bold flex items-start gap-3 shadow-sm">
                        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
                @if(session('success'))
                    <div class="p-4 rounded-2xl border border-emerald-200 bg-emerald-50 text-emerald-700 text-sm font-bold flex items-start gap-3 shadow-sm">
                        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if($errors->any())
                    <div class="p-4 rounded-2xl border border-rose-200 bg-rose-50 text-rose-700 text-sm font-bold flex items-start gap-3 shadow-sm">
                        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <span>Terdapat kesalahan pada inputan Anda. Silakan periksa kembali.</span>
                    </div>
                @endif
            </div>
        </div>
        @endif

        {{-- ROUTING KOMPONEN VIEW BERDASARKAN STATE --}}
        @if(!$paymentMethod)
            @include('order.checkout.payment')
        @elseif(!Auth::check())
            @include('order.checkout.authentication')
        @else
            @include('order.checkout.confirmation')
        @endif
    </div>
</div>
@endsection