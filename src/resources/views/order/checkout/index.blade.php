@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8fafc] py-12 pt-32">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Stepper --}}
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

        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl border border-red-200 bg-red-50 text-red-700 font-bold max-w-3xl mx-auto">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 text-red-700 text-sm rounded-xl font-bold max-w-3xl mx-auto">
                Terdapat kesalahan pada inputan Anda. Silakan periksa kembali.
            </div>
        @endif

        @if(!session('order.payment_method'))
            @include('order.checkout.payment')
        @elseif(!Auth::check())
            @include('order.checkout.authentication')
        @else
            @include('order.checkout.confirmation')
        @endif

    </div>
</div>

@endsection