@extends('layouts.client')

@section('title', 'Dashboard | Bisma Labs')

@section('content')

@php
    $firstName = explode(' ', Auth::user()->name)[0];

    $isPaid = $hasPaidOrder;
    $isPending = !$isPaid && $hasPendingOrder;

    $statusLabel = match (strtolower((string) $systemStatus)) {
        'active' => 'Active',
        'building' => 'Building',
        'inactive' => 'Inactive',
        default => ucfirst((string) $systemStatus),
    };

    $statusDot = match (strtolower((string) $systemStatus)) {
        'active' => 'bg-emerald-500',
        'building' => 'bg-amber-500',
        default => 'bg-slate-400',
    };
@endphp

<div class="mb-8 lg:mb-10">
    <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-slate-800">
        Welcome back, {{ $firstName }}!
    </h1>

    <p class="text-sm text-slate-500 mt-2">
        {{ $isPaid
            ? 'Your digital shop is looking great today.'
            : 'Complete your website setup to start managing your website.'
        }}
    </p>
</div>

@if($isPending)
    @include('components.client.alert_dashboard_pending')
@endif

<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-7">

    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="w-9 h-9 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center">
                <svg
                    class="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400">
                System Status
            </span>
        </div>

        <div class="mt-5">
            <p class="text-[11px] text-slate-400 mb-1">
                Status
            </p>

            <div class="flex items-center gap-2">
                <h3 class="text-xl font-bold text-slate-800">
                    {{ $statusLabel }}
                </h3>

                <span class="w-2 h-2 rounded-full {{ $statusDot }}"></span>
            </div>

            @if($isPending)
                <p class="text-[10px] text-amber-600 mt-1">
                    Menunggu pembayaran
                </p>
            @elseif(!$isPaid)
                <p class="text-[10px] text-slate-400 mt-1">
                    Website belum dibuat
                </p>
            @endif
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="w-9 h-9 rounded-lg bg-sky-50 text-[#0369a1] flex items-center justify-center">
                <svg
                    class="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <circle cx="12" cy="12" r="9"/>
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 12h18M12 3c2.5 2.5 3.5 5.5 3.5 9s-1 6.5-3.5 9c-2.5-2.5-3.5-6.5-3.5-9S9.5 5.5 12 3z"/>
                </svg>
            </div>

            <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400">
                Live Address
            </span>
        </div>

        <div class="mt-5">
            <p class="text-[11px] text-slate-400 mb-1">
                Domain
            </p>

            @if($domainName)
                <h3 class="text-lg font-semibold text-slate-800 truncate">
                    {{ $domainName }}
                </h3>

                @if(!$isPaid)
                    <p class="text-[10px] text-amber-600 mt-1">
                        Belum aktif
                    </p>
                @endif
            @else
                <a
                    href="{{ route('order.domain') }}"
                    class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#0369a1] hover:text-[#075985] transition">
                    Beli Domain
                    <svg
                        class="w-3.5 h-3.5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @endif
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="w-9 h-9 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center">
                <svg
                    class="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <rect
                        x="3"
                        y="5"
                        width="18"
                        height="14"
                        rx="2"/>
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 10h18"/>
                </svg>
            </div>

            <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400">
                Billing Cycle
            </span>
        </div>

        <div class="mt-5">
            <p class="text-[11px] text-slate-400 mb-1">
                Plan
            </p>

            @if($packageName)
                <h3 class="text-lg font-semibold text-slate-800 truncate">
                    {{ $packageName }}
                </h3>

                @if(!$isPaid)
                    <p class="text-[10px] text-amber-600 mt-1">
                        Menunggu pembayaran
                    </p>
                @elseif($latestOrder?->website?->expires_at)
                    <p class="text-[10px] text-slate-400 mt-1">
                        Renews on {{ $latestOrder->website->expires_at->format('d M Y') }}
                    </p>
                @endif
            @else
                <a
                    href="{{ route('order.package') }}"
                    class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#0369a1] hover:text-[#075985] transition">
                    Pilih Paket
                    <svg
                        class="w-3.5 h-3.5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @endif
        </div>
    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-5 gap-5">

    <div class="lg:col-span-3 bg-white border border-slate-200 rounded-2xl p-6 sm:p-7 shadow-sm">

        <div class="min-h-[210px] flex flex-col justify-center">

            <span class="text-[10px] font-bold uppercase tracking-wider text-[#0369a1] mb-3">
                Website Management
            </span>

            @if($isPaid)

                <h2 class="text-2xl font-bold text-slate-800">
                    Ready to make changes?
                </h2>

                <p class="text-sm text-slate-500 mt-2 max-w-lg leading-relaxed">
                    Update your gallery, adjust your pricing, or manage the latest content on your website.
                </p>

                <div class="flex flex-col sm:flex-row gap-3 mt-7">

                    <a
                        href="{{ route('client.website.edit') }}"
                        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-[#0369a1] hover:bg-[#075985] text-white text-sm font-semibold transition shadow-sm">
                        <svg
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 20h16M6 17l8.5-8.5a2.1 2.1 0 013 3L9 20H6v-3z"/>
                        </svg>
                        Edit Website
                    </a>

                    <a
                        href="{{ route('client.pages.index') }}"
                        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 text-sm font-semibold transition">
                        <svg
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 4h9l3 3v13H6V4z"/>
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 11h6M9 15h6"/>
                        </svg>
                        Manage Pages
                    </a>

                </div>

            @elseif($isPending)

                <div class="flex items-center gap-2 mb-2">
                    <h2 class="text-2xl font-bold text-slate-800">
                        Website belum aktif
                    </h2>

                    <span class="px-2 py-1 rounded-md bg-amber-50 text-amber-600 text-[9px] font-bold uppercase">
                        Pending
                    </span>
                </div>

                <p class="text-sm text-slate-500 mt-2 max-w-lg leading-relaxed">
                    Fitur pengelolaan website akan tersedia setelah pembayaran Anda berhasil diproses.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-7">

                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 border border-slate-100 text-slate-400">
                        <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shrink-0">
                            <svg
                                class="w-4 h-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 20h16M6 17l8.5-8.5a2.1 2.1 0 013 3L9 20H6v-3z"/>
                            </svg>
                        </div>

                        <span class="text-xs font-semibold">
                            Edit Website
                        </span>

                        <svg
                            class="w-3.5 h-3.5 ml-auto"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <rect
                                x="5"
                                y="11"
                                width="14"
                                height="9"
                                rx="2"/>
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 11V8a4 4 0 018 0v3"/>
                        </svg>
                    </div>

                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 border border-slate-100 text-slate-400">
                        <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shrink-0">
                            <svg
                                class="w-4 h-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 4h9l3 3v13H6V4z"/>
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 11h6M9 15h6"/>
                            </svg>
                        </div>

                        <span class="text-xs font-semibold">
                            Manage Pages
                        </span>

                        <svg
                            class="w-3.5 h-3.5 ml-auto"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <rect
                                x="5"
                                y="11"
                                width="14"
                                height="9"
                                rx="2"/>
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 11V8a4 4 0 018 0v3"/>
                        </svg>
                    </div>

                </div>

            @else

                <h2 class="text-2xl font-bold text-slate-800">
                    Start your website
                </h2>

                <p class="text-sm text-slate-500 mt-2 max-w-lg leading-relaxed">
                    Pilih template, domain, dan paket terlebih dahulu untuk mulai membuat website Anda.
                </p>

                <a
                    href="{{ route('order.template') }}"
                    class="inline-flex items-center justify-center gap-2 mt-7 px-5 py-3 rounded-xl bg-[#0369a1] hover:bg-[#075985] text-white text-sm font-semibold transition shadow-sm">
                    Mulai Buat Website
                    <svg
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 5v14M5 12h14"/>
                    </svg>
                </a>

            @endif

        </div>

    </div>

    <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-800">
                Recent Activity
            </h2>

            <p class="text-xs text-slate-400 mt-1">
                Latest activity from your account.
            </p>
        </div>

        <div class="divide-y divide-slate-100">

            @forelse($orders->take(3) as $order)

                <div class="px-6 py-4 flex gap-3">

                    <div class="w-2 h-2 rounded-full {{ strtolower((string) $order->status) === 'paid' ? 'bg-emerald-500' : 'bg-amber-500' }} mt-1.5 shrink-0"></div>

                    <div class="min-w-0 flex-1">

                        <div class="flex items-center justify-between gap-3">
                            <p class="text-xs font-semibold text-slate-700 truncate">
                                Order {{ $order->order_number }}
                            </p>

                            <span class="text-[9px] font-bold uppercase text-slate-400">
                                {{ $order->status }}
                            </span>
                        </div>

                        <p class="text-[11px] text-slate-400 mt-1">
                            {{ $order->package?->name ?? 'Website Package' }}
                        </p>

                    </div>

                </div>

            @empty

                @if($isPending)

                    <div class="px-6 py-7">
                        <div class="flex gap-3">

                            <div class="w-2 h-2 rounded-full bg-amber-500 mt-1.5 shrink-0"></div>

                            <div>
                                <p class="text-xs font-semibold text-slate-700">
                                    Website setup in progress
                                </p>

                                <p class="text-[11px] text-slate-400 mt-1">
                                    Menunggu pembayaran untuk menyelesaikan proses pemesanan.
                                </p>
                            </div>

                        </div>
                    </div>

                @else

                    <div class="px-6 py-8 text-center">
                        <p class="text-sm text-slate-400">
                            Belum ada aktivitas.
                        </p>
                    </div>

                @endif

            @endforelse

        </div>

    </div>

</div>

@if(!$isPaid)

    <div class="mt-5 bg-sky-50 border border-sky-100 rounded-2xl px-6 py-5 flex flex-col sm:flex-row sm:items-center gap-4">

        <div class="w-10 h-10 rounded-xl bg-white text-[#0369a1] flex items-center justify-center shrink-0">
            <svg
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 18h.01M12 14a4 4 0 10-4-4"/>
                <circle
                    cx="12"
                    cy="12"
                    r="9"/>
            </svg>
        </div>

        <div>
            <p class="text-xs font-bold text-[#0369a1]">
                Mulai dari Dashboard
            </p>

            <p class="text-xs text-slate-500 mt-1">
                Pilih template dan lengkapi proses pemesanan untuk mengaktifkan website Anda.
            </p>
        </div>

    </div>

@else

    <div class="mt-5 bg-sky-50 border border-sky-100 rounded-2xl px-6 py-5 flex flex-col sm:flex-row sm:items-center gap-4">

        <div class="w-10 h-10 rounded-xl bg-white text-[#0369a1] flex items-center justify-center shrink-0">
            <svg
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 18h.01M12 14a4 4 0 10-4-4"/>
                <circle
                    cx="12"
                    cy="12"
                    r="9"/>
            </svg>
        </div>

        <div>
            <p class="text-xs font-bold text-[#0369a1]">
                Pro Tip
            </p>

            <p class="text-xs text-slate-500 mt-1">
                Keep your website content updated to make your online presence more relevant to visitors.
            </p>
        </div>

    </div>

@endif

@endsection