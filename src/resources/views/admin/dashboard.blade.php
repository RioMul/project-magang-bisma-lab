@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="mb-7 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

    <div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-800">
            Dashboard Overview
        </h1>

        <p class="mt-1 text-xs text-slate-500">
            Welcome back, here's what's happening today.
        </p>
    </div>

    <div class="flex gap-2">

        <button class="px-3 py-2 rounded-lg bg-white border border-slate-200 text-xs text-slate-600">
            Last 30 Days
        </button>

        <button class="px-3 py-2 rounded-lg bg-[#0879b9] text-white text-xs font-semibold">
            Export
        </button>

    </div>

</div>

<div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-5">

    <div class="bg-white rounded-xl border border-slate-100 p-5">
        <p class="text-[10px] text-slate-400 uppercase tracking-wider">
            Total Users
        </p>

        <div class="mt-2 text-2xl font-bold text-slate-800">
            {{ number_format($totalUsers) }}
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-100 p-5">
        <p class="text-[10px] text-slate-400 uppercase tracking-wider">
            Active Websites
        </p>

        <div class="mt-2 text-2xl font-bold text-slate-800">
            {{ number_format($activeWebsites) }}
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-100 p-5">
        <p class="text-[10px] text-slate-400 uppercase tracking-wider">
            Monthly Revenue
        </p>

        <div class="mt-2 text-2xl font-bold text-slate-800">
            Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-100 p-5">
        <p class="text-[10px] text-slate-400 uppercase tracking-wider">
            Expired Orders
        </p>

        <div class="mt-2 text-2xl font-bold text-slate-800">
            {{ number_format($expiredOrders) }}
        </div>
    </div>

</div>

<div class="grid xl:grid-cols-3 gap-5 mb-5">

    <div class="xl:col-span-2 bg-white rounded-xl border border-slate-100 p-5">

        <div class="flex items-center justify-between mb-5">

            <div>
                <h2 class="text-sm font-bold text-slate-800">
                    Revenue Over Time
                </h2>

                <p class="text-[10px] text-slate-400">
                    Paid order revenue
                </p>
            </div>

            <span class="px-2 py-1 rounded-full bg-blue-50 text-[9px] text-blue-600">
                Earnings
            </span>

        </div>

        <div class="h-56 flex items-end gap-3 border-b border-slate-100">

            @php
                $maxRevenue = max(
                    $revenueData->max('value'),
                    1
                );
            @endphp

            @foreach($revenueData as $item)

                <div class="flex-1 flex flex-col justify-end items-center gap-2 h-full">

                    <div
                        class="w-full max-w-12 bg-[#cfe7f3] rounded-t-md"
                        style="height: {{ max(8, ($item['value'] / $maxRevenue) * 80) }}%">
                    </div>

                    <span class="text-[9px] text-slate-400">
                        {{ $item['label'] }}
                    </span>

                </div>

            @endforeach

        </div>

    </div>

    <div class="bg-white rounded-xl border border-slate-100 p-5">

        <h2 class="text-sm font-bold text-slate-800">
            Order Overview
        </h2>

        <p class="mt-1 text-[10px] text-slate-400">
            Current order status
        </p>

        <div class="mt-7 space-y-5">

            <div>
                <div class="flex justify-between text-xs mb-2">
                    <span class="text-slate-500">Paid</span>
                    <span class="font-semibold text-slate-700">{{ $paidOrders }}</span>
                </div>

                <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-400 rounded-full w-3/4"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between text-xs mb-2">
                    <span class="text-slate-500">Pending</span>
                    <span class="font-semibold text-slate-700">{{ $pendingOrders }}</span>
                </div>

                <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-400 rounded-full w-1/3"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between text-xs mb-2">
                    <span class="text-slate-500">New Users</span>
                    <span class="font-semibold text-slate-700">{{ $monthlyUsers }}</span>
                </div>

                <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-cyan-400 rounded-full w-1/2"></div>
                </div>
            </div>

        </div>

    </div>

</div>

<div class="bg-white rounded-xl border border-slate-100 overflow-hidden">

    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">

        <h2 class="text-sm font-bold text-slate-800">
            Recent Orders
        </h2>

        <a
            href="{{ route('admin.orders.index') }}"
            class="text-[10px] font-semibold text-[#0879b9]">
            View All Orders
        </a>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-left">

            <thead class="bg-slate-50">

                <tr class="text-[9px] uppercase tracking-wider text-slate-400">

                    <th class="px-5 py-3">Order ID</th>
                    <th class="px-5 py-3">Customer</th>
                    <th class="px-5 py-3">Plan</th>
                    <th class="px-5 py-3">Amount</th>
                    <th class="px-5 py-3">Date</th>
                    <th class="px-5 py-3">Status</th>

                </tr>

            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($recentOrders as $order)

                    <tr class="text-xs">

                        <td class="px-5 py-4 font-semibold text-slate-700">
                            {{ $order->order_number }}
                        </td>

                        <td class="px-5 py-4">
                            {{ $order->customer_name }}
                        </td>

                        <td class="px-5 py-4">
                            {{ $order->package?->name ?? '-' }}
                        </td>

                        <td class="px-5 py-4">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </td>

                        <td class="px-5 py-4 text-slate-500">
                            {{ $order->created_at->format('d M Y') }}
                        </td>

                        <td class="px-5 py-4">

                            <span class="px-2 py-1 rounded-full text-[9px]
                                {{ $order->status === 'paid'
                                    ? 'bg-emerald-50 text-emerald-600'
                                    : ($order->status === 'pending'
                                        ? 'bg-blue-50 text-blue-600'
                                        : 'bg-red-50 text-red-600') }}">

                                {{ ucfirst($order->status) }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="px-5 py-10 text-center text-xs text-slate-400">
                            Belum ada order.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection