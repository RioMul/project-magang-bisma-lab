@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-100 py-12">

    <div class="max-w-3xl mx-auto px-4">


        @if(session('payment_success'))

            <div class="mb-6 p-5 bg-green-50 border border-green-200 rounded-xl">

                <h2 class="font-bold text-green-700">

                    Pembayaran Berhasil!

                </h2>

                <p class="text-sm text-green-600 mt-1">

                    Pesanan Anda berhasil dibuat.

                </p>

            </div>

        @endif


        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">


            {{-- HEADER --}}

            <div class="bg-slate-900 text-white p-8">

                <div class="flex justify-between">

                    <div>

                        <p class="text-sm text-slate-400">

                            BISMA LAB

                        </p>

                        <h1 class="text-3xl font-bold">

                            Invoice

                        </h1>

                    </div>


                    <div class="text-right">

                        <p class="text-xs text-slate-400">

                            ORDER NUMBER

                        </p>

                        <p class="font-bold">

                            {{ $order->order_number }}

                        </p>

                    </div>

                </div>

            </div>


            <div class="p-8 space-y-8">


                {{-- STATUS --}}

                <div class="flex justify-between items-center bg-green-50 border border-green-200 rounded-xl p-5">

                    <div>

                        <p class="font-bold text-green-700">

                            Payment Status

                        </p>

                        <p class="text-sm text-green-600">

                            Pembayaran berhasil dikonfirmasi.

                        </p>

                    </div>


                    <span class="bg-green-600 text-white px-4 py-2 rounded-full text-sm font-bold">

                        PAID

                    </span>

                </div>


                {{-- CUSTOMER --}}

                <div>

                    <h2 class="font-bold text-slate-800 mb-4">

                        Informasi Pemesan

                    </h2>


                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-sm">

                        <div>

                            <p class="text-slate-400">

                                Nama

                            </p>

                            <p class="font-bold">

                                {{ $order->customer_name }}

                            </p>

                        </div>


                        <div>

                            <p class="text-slate-400">

                                Email

                            </p>

                            <p class="font-bold">

                                {{ $order->customer_email }}

                            </p>

                        </div>


                        <div>

                            <p class="text-slate-400">

                                Tanggal

                            </p>

                            <p class="font-bold">

                                {{ $order->created_at->format('d M Y H:i') }}

                            </p>

                        </div>


                        <div>

                            <p class="text-slate-400">

                                Pembayaran

                            </p>

                            <p class="font-bold">

                                {{ ucwords(str_replace('_', ' ', $order->payment_method)) }}

                            </p>

                        </div>

                    </div>

                </div>


                <hr>


                {{-- ORDER --}}

                <div>

                    <h2 class="font-bold text-slate-800 mb-5">

                        Detail Pesanan

                    </h2>


                    <div class="flex gap-4">


                        <div class="w-24 h-24 rounded-xl overflow-hidden bg-slate-100">

                            <img
                                src="{{ asset($order->template->preview_image ?? 'tech1.png') }}"
                                alt="{{ $order->template->name }}"
                                class="w-full h-full object-cover"
                            >

                        </div>


                        <div>

                            <p class="text-xs uppercase font-bold text-[#0369a1]">

                                Template

                            </p>

                            <h3 class="font-bold text-slate-800">

                                {{ $order->template->name }}

                            </h3>

                            <p class="text-sm text-slate-500 mt-1">

                                Domain: {{ $order->desired_domain }}

                            </p>

                            <p class="text-sm text-slate-500">

                                Paket: {{ $order->serverPackage->name }}

                            </p>

                        </div>

                    </div>

                </div>


                <hr>


                {{-- TOTAL --}}

                <div class="flex justify-between items-center">

                    <span class="text-lg font-bold text-slate-800">

                        Total Pembayaran

                    </span>

                    <span class="text-2xl font-bold text-[#0369a1]">

                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}

                    </span>

                </div>


                {{-- ACTION --}}

                <div class="flex flex-col sm:flex-row gap-3">

                    <a
                        href="{{ route('dashboard') }}"
                        class="flex-1 text-center bg-slate-900 text-white py-3 rounded-xl font-bold"
                    >

                        Lihat Pesanan Saya

                    </a>


                    <a
                        href="{{ route('home') }}"
                        class="flex-1 text-center border border-slate-300 py-3 rounded-xl font-bold text-slate-700"
                    >

                        Kembali ke Beranda

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection