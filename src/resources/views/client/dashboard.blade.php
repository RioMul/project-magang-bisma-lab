@extends('layouts.client')

@section('title', 'Dashboard | Bisma Labs')

@section('content')

@php
    $latestOrder = $orders->first();

    $firstName = explode(' ', Auth::user()->name)[0];

    $websiteStatus = $latestOrder?->website?->status ?? 'Active';
    $domainName = $latestOrder?->domain_name ?? '-';
    $packageName = $latestOrder?->package?->name ?? 'No Plan';

    $activeWebsites = $orders->filter(function ($order) {
        return strtolower($order->website?->status ?? '') === 'active';
    })->count();
@endphp

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5 mb-8">

    <div>

        <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-800">
            Dashboard
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Selamat datang kembali, {{ $firstName }}.
        </p>

    </div>

    <a
        href="{{ route('order.template') }}"
        class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-[#0369a1] hover:bg-[#075985] text-white rounded-xl text-sm font-semibold shadow-sm transition">

        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
        </svg>

        Buat Website

    </a>

</div>

@if($latestOrder)

    {{-- Statistics --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

        <x-client.stat-card
            title="Website Status"
            label="Status"
            value="{{ $websiteStatus }}"
            icon="check"
            type="success"
        />

        <x-client.stat-card
            title="Domain"
            label="Website Address"
            value="{{ $domainName }}"
            icon="globe"
            type="info"
        />

        <x-client.stat-card
            title="Package"
            label="Current Plan"
            value="{{ $packageName }}"
            icon="package"
            type="purple"
        />

    </div>

    {{-- Website & Orders --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Website --}}
        <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">

                <div>

                    <h2 class="text-lg font-bold text-slate-800">
                        Website Anda
                    </h2>

                    <p class="text-xs text-slate-400 mt-1">
                        Informasi website yang sedang digunakan.
                    </p>

                </div>

                <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold">
                    {{ ucfirst($websiteStatus) }}
                </span>

            </div>

            <div class="p-6">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    <div class="bg-slate-50 rounded-xl p-5">

                        <p class="text-xs text-slate-400 mb-2">
                            Nama Pemesan
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ $latestOrder->customer_name ?? Auth::user()->name }}
                        </p>

                    </div>

                    <div class="bg-slate-50 rounded-xl p-5">

                        <p class="text-xs text-slate-400 mb-2">
                            Email
                        </p>

                        <p class="font-semibold text-slate-800 truncate">
                            {{ $latestOrder->customer_email ?? Auth::user()->email }}
                        </p>

                    </div>

                    <div class="bg-slate-50 rounded-xl p-5">

                        <p class="text-xs text-slate-400 mb-2">
                            Template
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ $latestOrder->template->name ?? 'Template Website' }}
                        </p>

                    </div>

                    <div class="bg-slate-50 rounded-xl p-5">

                        <p class="text-xs text-slate-400 mb-2">
                            Nomor Pesanan
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ $latestOrder->order_number }}
                        </p>

                    </div>

                </div>

                <div class="mt-6 flex flex-col sm:flex-row gap-3">

                    <a
                        href="#"
                        class="flex-1 text-center px-5 py-3 rounded-xl bg-[#0369a1] hover:bg-[#075985] text-white text-sm font-semibold transition">
                        Edit Website
                    </a>

                    @if($latestOrder->website)

                        <a
                            href="#"
                            class="flex-1 text-center px-5 py-3 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 text-sm font-semibold transition">
                            Preview Website
                        </a>

                    @endif

                </div>

            </div>

        </div>

        {{-- Recent Orders --}}
        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-100">

                <h2 class="text-lg font-bold text-slate-800">
                    Pesanan Terbaru
                </h2>

                <p class="text-xs text-slate-400 mt-1">
                    Riwayat pesanan Anda.
                </p>

            </div>

            <div class="divide-y divide-slate-100">

                @forelse($orders->take(4) as $order)

                    <x-client.order-card :order="$order" />

                @empty

                    <div class="px-6 py-10 text-center">

                        <p class="text-sm text-slate-400">
                            Belum ada pesanan.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

@else

    {{-- Empty State --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-8 sm:p-12 text-center">

        <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-100 flex items-center justify-center mb-5">

            <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                <rect x="4" y="4" width="16" height="16" rx="2"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 9h8M8 13h5"/>
            </svg>

        </div>

        <h2 class="text-xl font-bold text-slate-800">
            Anda belum memiliki website
        </h2>

        <p class="text-sm text-slate-500 mt-2 max-w-md mx-auto">
            Mulai buat website pertama Anda dengan memilih template yang tersedia di Bisma Labs.
        </p>

        <a
            href="{{ route('order.template') }}"
            class="inline-flex items-center gap-2 mt-6 px-5 py-3 bg-[#0369a1] hover:bg-[#075985] text-white rounded-xl text-sm font-semibold transition">

            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
            </svg>

            Mulai Buat Website

        </a>

    </div>

@endif

{{-- Summary --}}
<div class="mt-6 bg-slate-100 rounded-2xl px-6 py-5">

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

        <div class="flex items-center gap-4">

            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center">

                <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="4" y="4" width="6" height="6" rx="1"/>
                    <rect x="14" y="4" width="6" height="6" rx="1"/>
                    <rect x="4" y="14" width="6" height="6" rx="1"/>
                </svg>

            </div>

            <div>

                <p class="text-xs text-slate-400">
                    Total Pesanan
                </p>

                <p class="text-lg font-bold text-slate-700">
                    {{ $orders->count() }}
                </p>

            </div>

        </div>

        <div class="flex items-center gap-4 sm:border-l sm:border-slate-200 sm:pl-5">

            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center">

                <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>

            </div>

            <div>

                <p class="text-xs text-slate-400">
                    Website Aktif
                </p>

                <p class="text-lg font-bold text-slate-700">
                    {{ $activeWebsites }}
                </p>

            </div>

        </div>

        <div class="flex items-center gap-4 sm:border-l sm:border-slate-200 sm:pl-5">

            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center">

                <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="9"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2"/>
                </svg>

            </div>

            <div>

                <p class="text-xs text-slate-400">
                    Status
                </p>

                <p class="text-lg font-bold text-slate-700">
                    {{ $latestOrder ? 'Terhubung' : 'Belum Ada' }}
                </p>

            </div>

        </div>

    </div>

</div>

@endsection