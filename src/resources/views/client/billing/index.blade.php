@extends('layouts.client')

@section('title', 'Billing | Bisma Labs')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Account</p>
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-1">Billing</h1>
            <p class="text-sm text-slate-500 mt-1">
                Kelola paket dan riwayat pembayaran website Anda.
            </p>
        </div>

        <button
            type="button"
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-[#0396c7] text-white text-sm font-semibold hover:bg-[#027ea7] transition">
            Upgrade Plan
        </button>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 shadow-sm">
        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">

            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="px-2.5 py-1 rounded-full bg-cyan-50 text-[#0396c7] text-[11px] font-bold">
                        CURRENT PLAN
                    </span>
                </div>

                <h2 class="text-xl sm:text-2xl font-bold text-slate-900">
                    {{ $latestOrder?->package?->name ?? 'Belum ada paket' }}
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Paket website aktif Anda
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 lg:text-right">

                <div>
                    <p class="text-xs text-slate-400">Renewal Date</p>
                    <p class="text-sm font-bold text-slate-800 mt-1">
                        {{ $latestOrder?->website?->expires_at?->format('d M Y') ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-400">Monthly Billing</p>
                    <p class="text-lg font-bold text-slate-900 mt-1">
                        @if($latestOrder?->package?->price_monthly)
                            Rp {{ number_format($latestOrder->package->price_monthly, 0, ',', '.') }}
                            <span class="text-xs font-medium text-slate-400">/month</span>
                        @else
                            -
                        @endif
                    </p>
                </div>

            </div>
        </div>

        <div class="border-t border-slate-100 mt-6 pt-5 flex flex-col sm:flex-row gap-3">
            <button
                type="button"
                class="w-full sm:w-auto px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                Manage Payment Methods
            </button>

            <button
                type="button"
                class="w-full sm:w-auto px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                View Plan Details
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-slate-500">Storage Used</p>
                <div class="w-9 h-9 rounded-xl bg-cyan-50 text-[#0396c7] flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h10"/>
                    </svg>
                </div>
            </div>

            <p class="text-2xl font-bold text-slate-900 mt-4">0 GB</p>
            <p class="text-xs text-slate-400 mt-1">Data penggunaan belum tersedia</p>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-slate-500">Team Members</p>
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                </div>
            </div>

            <p class="text-2xl font-bold text-slate-900 mt-4">1</p>
            <p class="text-xs text-slate-400 mt-1">Pemilik website</p>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-slate-500">API Calls</p>
                <div class="w-9 h-9 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l3 3-3 3M13 15h3M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                    </svg>
                </div>
            </div>

            <p class="text-2xl font-bold text-slate-900 mt-4">0</p>
            <p class="text-xs text-slate-400 mt-1">Belum ada API usage tracking</p>
        </div>

    </div>

    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">

        <div class="px-5 sm:px-6 py-5 border-b border-slate-100">
            <h2 class="text-lg font-bold text-slate-900">Billing History</h2>
            <p class="text-xs text-slate-400 mt-1">
                Riwayat transaksi pembayaran website Anda.
            </p>
        </div>

        @if($orders->isEmpty())

            <div class="px-6 py-12 text-center">
                <div class="w-12 h-12 mx-auto rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="17" rx="2"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h6"/>
                    </svg>
                </div>

                <p class="font-semibold text-slate-700 mt-4">Belum ada transaksi</p>
                <p class="text-sm text-slate-400 mt-1">
                    Riwayat pembayaran akan muncul setelah Anda melakukan pemesanan.
                </p>
            </div>

        @else

            <div class="overflow-x-auto">
                <table class="w-full min-w-[720px] text-left">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Invoice</th>
                            <th class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Date</th>
                            <th class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Amount</th>
                            <th class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Status</th>
                            <th class="px-5 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @foreach($orders as $order)
                            <tr class="hover:bg-slate-50/70 transition">

                                <td class="px-5 py-4">
                                    <p class="text-sm font-semibold text-slate-800">
                                        {{ $order->order_number ?? $order->id }}
                                    </p>
                                </td>

                                <td class="px-5 py-4">
                                    <p class="text-sm text-slate-600">
                                        {{ $order->created_at?->format('d M Y') }}
                                    </p>
                                </td>

                                <td class="px-5 py-4">
                                    <p class="text-sm font-semibold text-slate-800">
                                        Rp {{ number_format($order->total_amount ?? 0, 0, ',', '.') }}
                                    </p>
                                </td>

                                <td class="px-5 py-4">
                                    @php
                                        $status = strtolower($order->payment?->status ?? $order->status ?? 'pending');
                                    @endphp

                                    @if(in_array($status, ['paid', 'success', 'completed']))
                                        <span class="inline-flex px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[11px] font-bold">
                                            Paid
                                        </span>
                                    @elseif(in_array($status, ['failed', 'cancelled']))
                                        <span class="inline-flex px-2.5 py-1 rounded-full bg-red-50 text-red-600 text-[11px] font-bold">
                                            Failed
                                        </span>
                                    @else
                                        <span class="inline-flex px-2.5 py-1 rounded-full bg-amber-50 text-amber-600 text-[11px] font-bold">
                                            Pending
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4 text-right">
                                    <button
                                        type="button"
                                        class="text-sm font-semibold text-[#0396c7] hover:underline">
                                        Invoice
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @endif

    </div>

</div>
@endsection