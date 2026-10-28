@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-[28px] font-bold tracking-tight text-slate-900 leading-tight">
            Dashboard Overview
        </h1>
        <p class="mt-1 text-sm font-medium text-slate-500">
            Welcome back, here's what's happening today.
        </p>
    </div>

    <div class="flex items-center gap-3">
        <button class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
            <svg class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            Last 30 Days
        </button>

        <button class="inline-flex items-center gap-2 rounded-xl bg-[#0369a1] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#075985]">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Export
        </button>
    </div>
</div>

<div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">

    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-bold text-emerald-600">
                ↗ 12%
            </span>
        </div>
        <div class="mt-4">
            <p class="text-sm font-medium text-slate-500">Total Users</p>
            <h3 class="mt-1 text-3xl font-bold text-slate-900">{{ number_format($totalUsers) }}</h3>
        </div>
    </div>

    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-50 text-slate-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="9"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.6 9h16.8M3.6 15h16.8M12 3v18"/>
                </svg>
            </div>
            <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-bold text-emerald-600">
                ↗ 5%
            </span>
        </div>
        <div class="mt-4">
            <p class="text-sm font-medium text-slate-500">Active Websites</p>
            <h3 class="mt-1 text-3xl font-bold text-slate-900">{{ number_format($activeWebsites) }}</h3>
        </div>
    </div>

    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="6" width="20" height="12" rx="2" ry="2"/>
                    <circle cx="12" cy="12" r="2"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12h.01M18 12h.01"/>
                </svg>
            </div>
            <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-bold text-emerald-600">
                ↗ 18%
            </span>
        </div>
        <div class="mt-4">
            <p class="text-sm font-medium text-slate-500">Monthly Revenue</p>
            <h3 class="mt-1 text-3xl font-bold text-slate-900">
                Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}
            </h3>
        </div>
    </div>

    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-50 text-rose-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l4 4m0-4l-4 4"/>
                </svg>
            </div>
            <span class="inline-flex items-center gap-1 rounded-full bg-rose-50 px-2.5 py-1 text-[11px] font-bold text-rose-600">
                ↘ 2%
            </span>
        </div>
        <div class="mt-4">
            <p class="text-sm font-medium text-slate-500">Expired Subscriptions</p>
            <h3 class="mt-1 text-3xl font-bold text-slate-900">{{ number_format($expiredOrders) }}</h3>
        </div>
    </div>

</div>

{{-- Grafik mockup tetap dipertahankan --}}
<div class="mb-8 grid grid-cols-1 gap-6 lg:grid-cols-3">

    <div class="relative flex flex-col overflow-hidden rounded-3xl border border-slate-100 bg-white p-8 shadow-sm lg:col-span-2">
        <div class="relative z-10 mb-8 flex items-start justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Revenue Over Time</h2>
                <p class="mt-1 text-xs text-slate-400">Daily earning report overview</p>
            </div>
            <span class="inline-flex items-center gap-2 rounded-full bg-sky-50 px-3 py-1.5 text-xs font-bold uppercase tracking-wider text-sky-700">
                <span class="h-2 w-2 rounded-full bg-sky-500"></span>
                Earnings
            </span>
        </div>

        <div class="relative mt-4 flex min-h-[200px] w-full flex-1 items-end">
            <div class="pointer-events-none absolute inset-0 flex flex-col justify-between">
                <div class="h-px w-full bg-slate-50"></div>
                <div class="h-px w-full bg-slate-50"></div>
                <div class="h-px w-full bg-slate-50"></div>
                <div class="h-px w-full bg-slate-100"></div>
            </div>

            <svg class="relative z-10 h-[180px] w-full drop-shadow-sm" preserveAspectRatio="none" viewBox="0 0 1000 300">
                <defs>
                    <linearGradient id="gradientArea" x1="0" x2="0" y1="0" y2="1">
                        <stop offset="0%" stop-color="#0284c7" stop-opacity="0.2"/>
                        <stop offset="100%" stop-color="#0284c7" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <path d="M0,250 C100,250 150,180 200,100 C250,20 300,90 350,100 C400,110 450,160 500,160 C550,160 600,80 650,60 C700,40 750,80 800,80 C850,80 900,40 1000,50 L1000,300 L0,300 Z" fill="url(#gradientArea)"/>
                <path d="M0,250 C100,250 150,180 200,100 C250,20 300,90 350,100 C400,110 450,160 500,160 C550,160 600,80 650,60 C700,40 750,80 800,80 C850,80 900,40 1000,50" fill="none" stroke="#0284c7" stroke-width="4" stroke-linecap="round"/>
            </svg>
        </div>
    </div>

    <div class="flex flex-col rounded-3xl border border-slate-100 bg-white p-8 shadow-sm">
        <h2 class="text-lg font-bold text-slate-900">User Growth</h2>

        <div class="mt-6 flex items-center justify-between">
            <span class="text-sm font-medium text-slate-500">This Month</span>
            <span class="text-sm font-bold text-[#0369a1]">+{{ number_format($monthlyUsers ?? 0) }}</span>
        </div>

        <div class="mt-8 flex flex-1 items-end justify-between gap-4 px-2">
            <div class="h-[45%] w-12 rounded-t-xl bg-slate-100 transition hover:bg-slate-200"></div>
            <div class="h-[35%] w-12 rounded-t-xl bg-slate-100 transition hover:bg-slate-200"></div>
            <div class="relative h-[75%] w-12 rounded-t-xl bg-[#93c5fd] shadow-sm transition hover:bg-[#60a5fa]">
                <div class="absolute -top-3 left-1/2 h-1.5 w-1.5 -translate-x-1/2 rounded-full bg-[#3b82f6]"></div>
            </div>
            <div class="h-[65%] w-12 rounded-t-xl bg-slate-100 transition hover:bg-slate-200"></div>
        </div>

        <div class="mt-4 flex items-center justify-between px-3 text-xs font-semibold text-slate-400">
            <span>Mon</span>
            <span>Wed</span>
            <span>Fri</span>
            <span>Sun</span>
        </div>
    </div>

</div>

{{-- Pesanan terbaru hanya ditampilkan di Dashboard --}}
<div id="dashboard-recent-orders" class="mb-8 overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm">
    <div class="flex items-center justify-between px-5 py-5 sm:px-8">
        <div>
            <h2 class="text-lg font-bold text-slate-900">Pesanan Terbaru</h2>
            <p class="mt-1 text-xs text-slate-500">Lima pesanan terbaru yang masuk.</p>
        </div>

        <a
            href="{{ route('admin.orders.index', ['return_to' => 'dashboard']) }}"
            onclick="sessionStorage.setItem('adminDashboardScrollY', String(window.scrollY))"
            class="text-sm font-semibold text-[#0369a1] transition hover:text-[#075985]">
            Lihat semua pesanan
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-left">
            <thead>
                <tr class="border-b border-slate-100 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    <th class="px-5 py-4 sm:px-8">Nomor pesanan</th>
                    <th class="px-5 py-4 sm:px-8">Pelanggan</th>
                    <th class="px-5 py-4 sm:px-8">Paket</th>
                    <th class="px-5 py-4 sm:px-8">Total</th>
                    <th class="px-5 py-4 sm:px-8">Tanggal</th>
                    <th class="px-5 py-4 sm:px-8">Status</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-50">
                @forelse($recentOrders as $order)
                    @php
                        $customerName = $order->customer_name ?? $order->user?->name ?? 'User';
                        $initials = collect(explode(' ', $customerName))
                            ->filter()
                            ->map(fn ($name) => substr($name, 0, 1))
                            ->take(2)
                            ->join('');

                        $colors = [
                            'bg-sky-100 text-sky-600',
                            'bg-emerald-100 text-emerald-600',
                            'bg-blue-100 text-blue-600',
                            'bg-rose-100 text-rose-600',
                        ];

                        $avatarColor = $colors[strlen($customerName) % count($colors)];
                        $planName = $order->package?->name ?? '—';

                        $statusClass = match ($order->status) {
                            'paid' => 'border-emerald-100 bg-emerald-50 text-emerald-600',
                            'pending' => 'border-sky-100 bg-sky-50 text-sky-600',
                            default => 'border-rose-100 bg-rose-50 text-rose-600',
                        };
                    @endphp

                    <tr class="transition hover:bg-slate-50/50">
                        <td class="whitespace-nowrap px-5 py-5 sm:px-8">
                            <a
                                href="{{ route('admin.orders.show', [
                                    'order' => $order,
                                    'return_to' => 'dashboard',
                                ]) }}"
                                onclick="sessionStorage.setItem('adminDashboardScrollY', String(window.scrollY))"
                                class="text-sm font-bold text-slate-700 transition hover:text-[#0369a1]">
                                #BSM-{{ $order->order_number }}
                            </a>
                        </td>

                        <td class="px-5 py-5 sm:px-8">
                            <div class="flex items-center gap-3">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-xs font-bold uppercase {{ $avatarColor }}">
                                    {{ $initials }}
                                </div>
                                <span class="text-sm font-semibold text-slate-700">{{ $customerName }}</span>
                            </div>
                        </td>

                        <td class="px-5 py-5 sm:px-8">
                            <span class="inline-flex items-center rounded-md bg-sky-50 px-2.5 py-1 text-xs font-bold text-sky-600">
                                {{ $planName }}
                            </span>
                        </td>

                        <td class="whitespace-nowrap px-5 py-5 text-sm font-bold text-slate-700 sm:px-8">
                            Rp {{ number_format((float) $order->total_amount, 0, ',', '.') }}
                        </td>

                        <td class="whitespace-nowrap px-5 py-5 text-sm font-medium text-slate-500 sm:px-8">
                            {{ $order->created_at?->format('d M Y') ?? '—' }}
                        </td>

                        <td class="whitespace-nowrap px-5 py-5 sm:px-8">
                            <span class="inline-flex items-center rounded-full border px-3 py-1 text-[11px] font-bold {{ $statusClass }}">
                                {{ ucfirst($order->status ?? 'pending') }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-8 py-10 text-center text-sm text-slate-400">
                            Belum ada pesanan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const storageKey = 'adminDashboardScrollY';
    const savedPosition = sessionStorage.getItem(storageKey);

    if (savedPosition !== null) {
        sessionStorage.removeItem(storageKey);

        const scrollPosition = Number.parseInt(savedPosition, 10);

        if (Number.isFinite(scrollPosition)) {
            requestAnimationFrame(function () {
                window.scrollTo(0, scrollPosition);
            });
        }
    }
});
</script>

@endsection