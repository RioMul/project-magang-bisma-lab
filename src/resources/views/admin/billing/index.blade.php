@extends('admin.layouts.app')

@section('title', 'Billing')

@section('content')
<div class="max-w-[1400px] space-y-6">

    <div class="mb-8 flex flex-col gap-4 xl:flex-row xl:items-end xl:justify-between">
        <div>
            <h1 class="text-[28px] font-bold tracking-tight text-slate-900 leading-tight">
                Billing
            </h1>
            <p class="mt-1 text-sm font-medium text-slate-500">
                Ringkasan invoice dan pembayaran.
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

    @include('admin.billing.partials.billing_summary')

    {{-- Grafik mockup Billing tetap dipertahankan --}}
    <div class="mb-8 grid grid-cols-1 gap-6 xl:grid-cols-3">
        <div class="relative flex flex-col overflow-hidden rounded-3xl border border-slate-100 bg-white p-8 shadow-sm xl:col-span-2">
            <div class="relative z-10 mb-8 flex items-start justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Tren Pembayaran Tagihan</h2>
                    <p class="mt-1 text-xs text-slate-400">Daily paid invoice overview</p>
                </div>

                <span class="inline-flex items-center gap-2 rounded-full border border-slate-100 bg-slate-50 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider text-slate-600">
                    <span class="h-2 w-2 rounded-full bg-[#0369a1]"></span>
                    Paid
                </span>
            </div>

            <div class="relative mt-4 flex min-h-[200px] w-full flex-1 items-end">
                <div class="pointer-events-none absolute inset-0 flex flex-col justify-between pb-6">
                    <div class="h-px w-full bg-slate-50"></div>
                    <div class="h-px w-full bg-slate-50"></div>
                    <div class="h-px w-full bg-slate-50"></div>
                    <div class="h-px w-full bg-slate-100"></div>
                </div>

                <svg class="relative z-10 mb-6 h-[180px] w-full drop-shadow-sm" preserveAspectRatio="none" viewBox="0 0 1000 300">
                    <defs>
                        <linearGradient id="billingGradient" x1="0" x2="0" y1="0" y2="1">
                            <stop offset="0%" stop-color="#0284c7" stop-opacity="0.2"/>
                            <stop offset="100%" stop-color="#0284c7" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                    <path d="M0,250 C100,250 150,180 200,100 C250,20 300,90 350,100 C400,110 450,160 500,160 C550,160 600,80 650,60 C700,40 750,80 800,80 C850,80 900,40 1000,50 L1000,300 L0,300 Z" fill="url(#billingGradient)"/>
                    <path d="M0,250 C100,250 150,180 200,100 C250,20 300,90 350,100 C400,110 450,160 500,160 C550,160 600,80 650,60 C700,40 750,80 800,80 C850,80 900,40 1000,50" fill="none" stroke="#0369a1" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-100 bg-white p-8 shadow-sm">
            <h2 class="mb-6 text-base font-bold text-slate-900">Sumber Tagihan</h2>

            <div class="space-y-6">
                @foreach([
                    ['label' => 'User Baru', 'percentage' => 45, 'color' => 'bg-[#0369a1]'],
                    ['label' => 'User 2th +', 'percentage' => 32, 'color' => 'bg-sky-400'],
                    ['label' => 'User 3th +', 'percentage' => 12, 'color' => 'bg-slate-300'],
                    ['label' => 'User 5th +', 'percentage' => 11, 'color' => 'bg-slate-200'],
                ] as $source)
                    <div>
                        <div class="mb-2 flex items-end justify-between">
                            <span class="text-xs font-semibold text-slate-600">{{ $source['label'] }}</span>
                            <span class="text-xs font-bold text-slate-900">{{ $source['percentage'] }}%</span>
                        </div>
                        <div class="h-2 w-full overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full {{ $source['color'] }}" style="width: {{ $source['percentage'] }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="billing-history" class="mb-8 overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm">
        <div class="flex flex-col gap-4 border-b border-slate-50 px-5 py-6 lg:flex-row lg:items-center lg:justify-between sm:px-8">

            <div>
                <h2 class="text-lg font-bold text-slate-900">
                    Pembayaran &amp; Invoice
                </h2>
                <p class="mt-1 text-xs text-slate-500">
                    Daftar transaksi beserta status pembayarannya.
                </p>

                <a
                    href="{{ route('admin.orders.index', [
                        'return_to' => 'billing',
                        'return_query' => http_build_query(request()->query()),
                    ]) }}"
                    onclick="sessionStorage.setItem('adminBillingScrollY', String(window.scrollY))"
                    class="mt-2 inline-flex items-center gap-1 text-xs font-semibold text-[#0369a1] transition hover:text-[#075985] hover:underline">
                    Lihat semua pesanan
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6"/>
                    </svg>
                </a>
            </div>

            <form
                id="admin-billing-search-form"
                method="GET"
                action="{{ route('admin.billing.index') }}"
                class="flex w-full flex-col items-center gap-3 sm:flex-row lg:w-auto"
                onsubmit="sessionStorage.setItem('adminBillingScrollY', String(window.scrollY))">

                <div class="relative w-full sm:w-64">
                    <svg class="absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="7"/>
                        <path stroke-linecap="round" d="M21 21l-4.35-4.35"/>
                    </svg>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari invoice..."
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-4 text-xs text-slate-700 shadow-sm outline-none transition focus:border-[#0369a1] focus:bg-white focus:ring-2 focus:ring-sky-50">
                </div>

                <select
                    name="status"
                    onchange="sessionStorage.setItem('adminBillingScrollY', String(window.scrollY)); this.form.submit()"
                    class="w-full cursor-pointer rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-600 shadow-sm outline-none transition hover:bg-slate-50 focus:border-[#0369a1] sm:w-auto">
                    <option value="">All Status</option>
                    <option value="paid" @selected(request('status') === 'paid')>Paid</option>
                    <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                    <option value="failed" @selected(request('status') === 'failed')>Failed</option>
                    <option value="expired" @selected(request('status') === 'expired')>Expired</option>
                </select>

                @if(request()->hasAny(['search', 'status']))
                    <a
                        href="{{ route('admin.billing.index') }}"
                        class="px-2 text-xs font-bold text-slate-400 transition hover:text-rose-500">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        @include('admin.billing.partials.payment_table')
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const storageKey = 'adminBillingScrollY';
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

    document.querySelectorAll('#billing-history .pagination a').forEach(function (link) {
        link.addEventListener('click', function () {
            sessionStorage.setItem(storageKey, String(window.scrollY));
        });
    });
});
</script>
@endsection