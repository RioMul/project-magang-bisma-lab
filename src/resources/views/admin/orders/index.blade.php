@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')
<div class="max-w-[1400px] space-y-6">

    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                Admin
            </p>
            <h1 class="mt-1 text-[28px] font-bold tracking-tight text-slate-900">
                Orders
            </h1>
            <p class="mt-1 text-sm font-medium text-slate-500">
                Daftar pesanan dan website yang dipesan pengguna.
            </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row">
            <a
                href="{{ $backUrl }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:bg-slate-50">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7 7l-7-7 7-7"/>
                </svg>
                {{ $backLabel }}
            </a>

            <form
                id="admin-orders-search-form"
                method="GET"
                action="{{ route('admin.orders.index') }}"
                class="flex w-full flex-col gap-3 sm:flex-row lg:w-auto"
                onsubmit="sessionStorage.setItem('adminOrdersScrollY', String(window.scrollY))">

                <input
                    type="hidden"
                    name="return_to"
                    value="{{ $returnSource }}">

                <input
                    type="hidden"
                    name="return_query"
                    value="{{ $returnQueryString }}">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari pesanan, pengguna, atau domain"
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 shadow-sm outline-none transition focus:border-[#0369a1] focus:ring-2 focus:ring-sky-50 sm:w-72">

                <select
                    name="status"
                    onchange="sessionStorage.setItem('adminOrdersScrollY', String(window.scrollY)); this.form.submit()"
                    class="w-full cursor-pointer rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm outline-none transition focus:border-[#0369a1] sm:w-auto">
                    <option value="">Semua status</option>
                    <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                    <option value="paid" @selected(request('status') === 'paid')>Paid</option>
                    <option value="expired" @selected(request('status') === 'expired')>Expired</option>
                    <option value="cancelled" @selected(request('status') === 'cancelled')>Cancelled</option>
                </select>

                <button
                    type="submit"
                    class="rounded-xl bg-[#0369a1] px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#075985]">
                    Cari
                </button>

                @if(request()->hasAny(['search', 'status']))
                    <a
                        href="{{ route('admin.orders.index', array_filter([
                            'return_to' => $returnSource,
                            'return_query' => $returnQueryString,
                        ])) }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-500 transition hover:bg-slate-50">
                        Reset
                    </a>
                @endif
            </form>
        </div>
    </div>

    <div id="orders-history" class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 px-5 py-5 sm:px-6">
            <h2 class="text-base font-bold text-slate-900">
                Daftar Pesanan
            </h2>
            <p class="mt-1 text-xs text-slate-400">
                Rincian website, template, dan paket berasal dari item pesanan.
            </p>
        </div>

        @if($orders->isEmpty())
            <div class="px-6 py-12 text-center">
                <p class="font-semibold text-slate-700">
                    Pesanan tidak ditemukan
                </p>
                <p class="mt-1 text-sm text-slate-400">
                    Coba ubah kata pencarian atau filter status.
                </p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1000px] text-left">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50">
                            <th class="px-5 py-4 text-[10px] font-bold uppercase tracking-wider text-slate-400">Pesanan</th>
                            <th class="px-5 py-4 text-[10px] font-bold uppercase tracking-wider text-slate-400">Pengguna</th>
                            <th class="px-5 py-4 text-[10px] font-bold uppercase tracking-wider text-slate-400">Website</th>
                            <th class="px-5 py-4 text-[10px] font-bold uppercase tracking-wider text-slate-400">Paket</th>
                            <th class="px-5 py-4 text-[10px] font-bold uppercase tracking-wider text-slate-400">Total</th>
                            <th class="px-5 py-4 text-[10px] font-bold uppercase tracking-wider text-slate-400">Status</th>
                            <th class="px-5 py-4 text-right text-[10px] font-bold uppercase tracking-wider text-slate-400">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @foreach($orders as $order)
                            @php
                                $item = $order->orderItems->first();

                                $statusClass = match ($order->status) {
                                    'paid' => 'bg-emerald-50 text-emerald-700',
                                    'pending' => 'bg-amber-50 text-amber-700',
                                    'expired', 'cancelled' => 'bg-rose-50 text-rose-700',
                                    default => 'bg-slate-100 text-slate-600',
                                };

                                $totalAmount = $order->invoice?->total_amount
                                    ?? $order->total_amount
                                    ?? 0;
                            @endphp

                            <tr class="transition hover:bg-slate-50/70">
                                <td class="px-5 py-4">
                                    <p class="text-sm font-bold text-slate-800">
                                        {{ $order->order_number }}
                                    </p>
                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $order->created_at?->format('d M Y, H:i') }}
                                    </p>
                                </td>

                                <td class="px-5 py-4">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ $order->customer_name ?? $order->user?->name ?? '—' }}
                                    </p>
                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $order->customer_email ?? $order->user?->email ?? '—' }}
                                    </p>
                                </td>

                                <td class="px-5 py-4">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ $item?->domain_name ?? $order->domain_name ?? '—' }}
                                    </p>
                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $item?->template?->name ?? $order->template?->name ?? 'Template —' }}
                                    </p>
                                </td>

                                <td class="px-5 py-4">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ $item?->package?->name ?? $order->package?->name ?? '—' }}
                                    </p>
                                    @if($item)
                                        <p class="mt-1 text-xs text-slate-400">
                                            Periode {{ $item->billing_period_months }} bulan
                                        </p>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    <p class="text-sm font-bold text-slate-800">
                                        Rp {{ number_format((float) $totalAmount, 0, ',', '.') }}
                                    </p>
                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $order->invoice?->invoice_number ?? 'Invoice belum tersedia' }}
                                    </p>
                                </td>

                                <td class="px-5 py-4">
                                    <span class="inline-flex rounded-full px-2.5 py-1 text-[10px] font-bold {{ $statusClass }}">
                                        {{ ucfirst($order->status ?? 'pending') }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 text-right">
                                    <a
                                        href="{{ route('admin.orders.show', [
                                            'order' => $order,
                                            'return_to' => 'orders',
                                            'return_query' => http_build_query(request()->query()),
                                        ]) }}"
                                        onclick="sessionStorage.setItem('adminOrdersScrollY', String(window.scrollY))"
                                        class="inline-flex items-center rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-bold text-[#0369a1] shadow-sm transition hover:bg-sky-50">
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($orders->hasPages())
                <div class="border-t border-slate-100 px-5 py-4 sm:px-6">
                    {{ $orders->links() }}
                </div>
            @endif
        @endif
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const storageKey = 'adminOrdersScrollY';
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

    document.querySelectorAll('#orders-history .pagination a').forEach(function (link) {
        link.addEventListener('click', function () {
            sessionStorage.setItem(storageKey, String(window.scrollY));
        });
    });
});
</script>
@endsection