@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#f8fafc] py-12">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">


        {{-- STEPPER --}}
        <div class="flex items-center justify-center mb-16">

            <div class="flex items-center space-x-3 sm:space-x-4">

                {{-- TEMPLATE --}}
                <div class="flex items-center flex-col relative">

                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#057A55] text-white text-xs font-bold">
                        ✓
                    </span>

                    <span class="absolute top-10 text-[10px] font-bold uppercase text-[#057A55]">
                        Template
                    </span>

                </div>

                <div class="w-12 sm:w-20 h-[2px] bg-[#057A55] -mt-5"></div>


                {{-- DOMAIN --}}
                <div class="flex items-center flex-col relative">

                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#057A55] text-white text-xs font-bold">
                        ✓
                    </span>

                    <span class="absolute top-10 text-[10px] font-bold uppercase text-[#057A55]">
                        Domain
                    </span>

                </div>

                <div class="w-12 sm:w-20 h-[2px] bg-[#057A55] -mt-5"></div>


                {{-- PACKAGE --}}
                <div class="flex items-center flex-col relative">

                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#057A55] text-white text-xs font-bold">
                        ✓
                    </span>

                    <span class="absolute top-10 text-[10px] font-bold uppercase text-[#057A55]">
                        Paket
                    </span>

                </div>

                <div class="w-12 sm:w-20 h-[2px] bg-[#057A55] -mt-5"></div>


                {{-- CHECKOUT --}}
                <div class="flex items-center flex-col relative">

                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#0369a1] text-white text-xs font-bold ring-4 ring-sky-100">
                        4
                    </span>

                    <span class="absolute top-10 text-[10px] font-bold uppercase text-[#0369a1]">
                        Checkout
                    </span>

                </div>

            </div>

        </div>


        {{-- TITLE --}}
        <div class="mb-10">

            <h1 class="text-4xl font-light text-slate-800 tracking-tight mb-2">

                Complete your
                <span class="font-medium text-slate-900">
                    purchase
                </span>

            </h1>

            <p class="text-slate-500 text-sm">

                Review your order and choose your preferred payment method.

            </p>

        </div>

        @if(session('success'))

            <div class="mb-6 p-4 rounded-xl border border-green-200 bg-green-50 text-green-700">

                {{ session('success') }}

            </div>

        @endif


        @if(session('error'))

            <div class="mb-6 p-4 rounded-xl border border-red-200 bg-red-50 text-red-700">

                {{ session('error') }}

            </div>

        @endif


        <form
            action="{{ route('order.checkout.process') }}"
            method="POST"
        >

            @csrf


            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

                <div class="lg:col-span-7 space-y-6">


                    <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">

                        <h2 class="text-lg font-bold text-slate-800 mb-6">

                        </h2>


                        <div class="space-y-3">


                            {{-- BANK --}}
                            <label class="flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:bg-sky-50 cursor-pointer transition">

                                <div>

                                    <p class="font-bold text-slate-800 text-sm">

                                        Bank Transfer (VA)

                                    </p>

                                    <span class="text-xs text-slate-500">

                                        BCA, Mandiri, BNI, BRI

                                    </span>

                                </div>

                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="bank_transfer"
                                    checked
                                    class="w-5 h-5"
                                >

                            </label>


                            {{-- CREDIT CARD --}}
                            <label class="flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:bg-sky-50 cursor-pointer transition">

                                <div>

                                    <p class="font-bold text-slate-800 text-sm">

                                        Credit Card

                                    </p>

                                    <span class="text-xs text-slate-500">

                                        Visa, Mastercard, JCB

                                    </span>

                                </div>

                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="credit_card"
                                    class="w-5 h-5"
                                >

                            </label>


                            {{-- EWALLET --}}
                            <label class="flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:bg-sky-50 cursor-pointer transition">

                                <div>

                                    <p class="font-bold text-slate-800 text-sm">

                                        E-Wallet

                                    </p>

                                    <span class="text-xs text-slate-500">

                                        OVO, DANA, LinkAja

                                    </span>

                                </div>

                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="ewallet"
                                    class="w-5 h-5"
                                >

                            </label>


                            {{-- QRIS --}}
                            <label class="flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:bg-sky-50 cursor-pointer transition">

                                <div>

                                    <p class="font-bold text-slate-800 text-sm">

                                        QRIS

                                    </p>

                                    <span class="text-xs text-slate-500">

                                        Scan using any payment app

                                    </span>

                                </div>

                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="qris"
                                    class="w-5 h-5"
                                >

                            </label>

                        </div>

                    </div>


                    {{-- SECURE CHECKOUT --}}

                    <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">

                        <h3 class="font-bold text-slate-800 text-lg mb-5">

                            Secure Checkout

                        </h3>


                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                            <div class="bg-slate-50 p-4 rounded-xl">

                                <p class="font-semibold text-slate-800 text-sm">

                                    Encrypted Transaction

                                </p>

                                <p class="text-xs text-slate-500 mt-1">

                                    Your transaction data is protected securely.

                                </p>

                            </div>


                            <div class="bg-slate-50 p-4 rounded-xl">

                                <p class="font-semibold text-slate-800 text-sm">

                                    Verified Provider

                                </p>

                                <p class="text-xs text-slate-500 mt-1">

                                    Secure payment processing for your order.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ================================ --}}
                {{-- ORDER SUMMARY --}}
                {{-- ================================ --}}

                <div class="lg:col-span-5 sticky top-6">


                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">


                        <div class="p-8 space-y-6">


                            <h2 class="text-lg font-bold text-slate-800">

                                Order Summary

                            </h2>


                            {{-- TEMPLATE IMAGE --}}

                            <div class="flex gap-4">

                                <div class="w-20 h-20 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">

                                    <img
                                        src="{{ asset($template->preview_image ?? 'tech1.png') }}"
                                        alt="{{ $template->name }}"
                                        class="w-full h-full object-cover"
                                    >

                                </div>


                                <div>

                                    <span class="text-xs font-bold text-[#0369a1] uppercase">

                                        Template

                                    </span>

                                    <h3 class="font-bold text-slate-800 mt-1">

                                        {{ $template->name }}

                                    </h3>

                                </div>

                            </div>


                            <hr>


                            <div class="space-y-4 text-sm">


                                <div class="flex justify-between">

                                    <span class="text-slate-500">

                                        Paket

                                    </span>

                                    <span class="font-bold text-slate-800">

                                        {{ $package->name }}

                                    </span>

                                </div>


                                <div class="flex justify-between">

                                    <span class="text-slate-500">

                                        Harga Paket

                                    </span>

                                    <span class="font-bold">

                                        Rp {{ number_format($package->price, 0, ',', '.') }}

                                    </span>

                                </div>


                                <div class="flex justify-between gap-4">

                                    <span class="text-slate-500">

                                        Domain

                                    </span>

                                    <span class="font-bold text-right">

                                        {{ $domain }}

                                    </span>

                                </div>


                                <div class="flex justify-between">

                                    <span class="text-slate-500">

                                        Harga Domain

                                    </span>

                                    <span class="font-bold">

                                        Rp {{ number_format($domainPrice, 0, ',', '.') }}

                                    </span>

                                </div>

                            </div>


                            <hr>


                            <div class="flex justify-between items-center">

                                <span class="font-bold text-slate-800">

                                    Total Amount

                                </span>

                                <span class="text-2xl font-bold text-[#0369a1]">

                                    Rp {{ number_format($totalAmount, 0, ',', '.') }}

                                </span>

                            </div>


                            {{-- PAYMENT BUTTON --}}

                            <button
                                type="submit"
                                class="w-full bg-[#0369a1] hover:bg-sky-800 text-white py-4 rounded-xl font-bold transition"
                            >

                                Bayar Sekarang

                            </button>


                            @guest

                                <p class="text-xs text-center text-slate-400">

                                    Anda akan diminta Login atau Register sebelum pembayaran.

                                </p>

                            @endguest


                            @auth

                                <p class="text-xs text-center text-green-600">

                                    Login sebagai {{ Auth::user()->name }}

                                </p>

                            @endauth


                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection