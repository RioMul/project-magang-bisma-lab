@extends('layouts.app')

@section('content')

<style>
    @media print {
        @page {
            size: A4;
            margin: 0;
        }

        html,
        body {
            margin: 0 !important;
            padding: 0 !important;
            background: white !important;
        }

        body * {
            visibility: hidden !important;
        }

        .invoice-paper,
        .invoice-paper * {
            visibility: visible !important;
        }

        .invoice-paper {
            position: absolute !important;
            left: 0 !important;
            top: 0 !important;
            width: 100% !important;
            max-width: none !important;
            margin: 0 !important;
            border: none !important;
            border-radius: 0 !important;
            box-shadow: none !important;
        }

        .print-hidden {
            display: none !important;
        }

        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    }
</style>

<div class="min-h-screen bg-[#f8fafc] py-12 pt-32">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(session('payment_success'))

            <div class="mb-6 p-5 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center gap-4 print-hidden">

                <div class="w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                    </svg>

                </div>

                <div>

                    <h3 class="font-black text-emerald-800">
                        Pembayaran Berhasil
                    </h3>

                    <p class="text-sm text-emerald-600 mt-1">
                        Invoice pesanan Anda telah dibuat.
                    </p>

                </div>

            </div>

        @endif

        <div class="invoice-paper bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="p-7 sm:p-10 border-b border-slate-200">

                <div class="flex flex-col sm:flex-row justify-between gap-8">

                    <div>

                        <p class="text-[10px] font-black tracking-[0.25em] text-[#0369a1] uppercase">
                            BISMA LAB
                        </p>

                        <h1 class="text-4xl font-black text-slate-900 tracking-tight mt-2">
                            INVOICE
                        </h1>

                        <p class="text-sm text-slate-500 mt-2">
                            #{{ $order->order_number }}
                        </p>

                    </div>

                    <div class="sm:text-right">

                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-black uppercase tracking-wider">

                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                            PAID

                        </span>

                        <p class="text-xs text-slate-400 mt-3">
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </p>

                    </div>

                </div>

            </div>

            <div class="p-7 sm:p-10">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-9">

                    <div>

                        <p class="text-[10px] font-black uppercase tracking-wider text-slate-400 mb-2">
                            Ditagihkan Kepada
                        </p>

                        <p class="text-sm font-black text-slate-900">
                            {{ $order->customer_name }}
                        </p>

                        <p class="text-xs text-slate-500 mt-1 break-all">
                            {{ $order->customer_email }}
                        </p>

                    </div>

                    <div class="sm:text-right">

                        <p class="text-[10px] font-black uppercase tracking-wider text-slate-400 mb-2">
                            Pembayaran
                        </p>

                        <p class="text-sm font-black text-slate-900 uppercase">
                            {{ str_replace('_', ' ', $order->payment_method) }}
                        </p>

                        <p class="text-xs text-slate-500 mt-1">
                            Pembayaran berhasil
                        </p>

                    </div>

                </div>

                <div class="border border-slate-200 rounded-2xl overflow-hidden">

                    <div class="grid grid-cols-12 bg-slate-50 border-b border-slate-200">

                        <div class="col-span-8 px-5 py-4">
                            <p class="text-[10px] font-black uppercase tracking-wider text-slate-500">
                                Deskripsi
                            </p>
                        </div>

                        <div class="col-span-4 px-5 py-4 text-right">
                            <p class="text-[10px] font-black uppercase tracking-wider text-slate-500">
                                Jumlah
                            </p>
                        </div>

                    </div>

                    <div class="grid grid-cols-12 border-b border-slate-100">

                        <div class="col-span-8 px-5 py-5">

                            <p class="text-sm font-black text-slate-900">
                                {{ $order->package->name }} Plan
                            </p>

                            <p class="text-xs text-slate-500 mt-1">
                                Template: {{ $order->template->name }}
                            </p>

                            <p class="text-xs text-slate-400 mt-1">
                                Layanan website tahunan
                            </p>

                        </div>

                        <div class="col-span-4 px-5 py-5 text-right">

                            <p class="text-sm font-bold text-slate-900 whitespace-nowrap">
                                Rp {{ number_format($order->package->price_annually, 0, ',', '.') }}
                            </p>

                        </div>

                    </div>

                    <div class="grid grid-cols-12 border-b border-slate-100">

                        <div class="col-span-8 px-5 py-5">

                            <p class="text-sm font-black text-slate-900">
                                Registrasi Domain
                            </p>

                            <p class="text-xs text-slate-500 mt-1 break-all">
                                {{ $order->domain_name }}
                            </p>

                            <p class="text-xs text-slate-400 mt-1">
                                Masa aktif 1 tahun
                            </p>

                        </div>

                        <div class="col-span-4 px-5 py-5 text-right">

                            @php
                                $domainAmount = $order->total_amount - $order->package->price_annually;
                            @endphp

                            <p class="text-sm font-bold text-slate-900 whitespace-nowrap">
                                Rp {{ number_format($domainAmount, 0, ',', '.') }}
                            </p>

                        </div>

                    </div>

                    <div class="p-5 sm:p-6">

                        <div class="max-w-sm ml-auto space-y-3">

                            <div class="flex justify-between gap-5 text-sm">

                                <span class="text-slate-500">
                                    Subtotal
                                </span>

                                <span class="font-bold text-slate-900">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </span>

                            </div>

                            <div class="flex justify-between gap-5 text-sm">

                                <span class="text-slate-500">
                                    Diskon
                                </span>

                                <span class="font-bold text-slate-400">
                                    Rp 0
                                </span>

                            </div>

                            <div class="flex justify-between gap-5 text-sm">

                                <span class="text-slate-500">
                                    Pajak
                                </span>

                                <span class="font-bold text-slate-400">
                                    Rp 0
                                </span>

                            </div>

                            <div class="border-t border-slate-200 pt-4 flex justify-between items-end gap-5">

                                <span class="font-black text-slate-900">
                                    Total
                                </span>

                                <span class="text-2xl font-black text-[#0369a1] whitespace-nowrap">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-8">

                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100">

                        <p class="text-[10px] font-black uppercase tracking-wider text-slate-400">
                            Domain
                        </p>

                        <p class="text-sm font-bold text-slate-900 mt-2 break-all">
                            {{ $order->domain_name }}
                        </p>

                    </div>

                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100">

                        <p class="text-[10px] font-black uppercase tracking-wider text-slate-400">
                            Invoice Date
                        </p>

                        <p class="text-sm font-bold text-slate-900 mt-2">
                            {{ $order->created_at->format('d F Y') }}
                        </p>

                    </div>

                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 text-center">

                    <p class="text-xs font-bold text-slate-600">
                        Terima kasih telah menggunakan layanan BISMA LAB.
                    </p>

                    <p class="text-[10px] text-slate-400 mt-1">
                        Invoice ini merupakan bukti pembayaran atas pesanan Anda.
                    </p>

                </div>

            </div>

            <div class="p-6 sm:p-7 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row justify-between gap-3 print-hidden">

                <button
                    onclick="window.print()"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 font-bold text-sm transition"
                >

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 2v6h12V2M6 14h12v8H6v-8zM4 8h16a2 2 0 012 2v6"/>
                    </svg>

                    Simpan Invoice

                </button>

                <a
                    href="{{ route('dashboard') }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl bg-[#0369a1] hover:bg-[#075985] text-white font-bold text-sm shadow-sm transition"
                >

                    Ke Dashboard

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>

                </a>

            </div>

        </div>

    </div>

</div>

@endsection