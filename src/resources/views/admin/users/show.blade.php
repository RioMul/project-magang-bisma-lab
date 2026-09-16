@extends('admin.layouts.app')

@section('title', 'User Detail')

@section('content')

@php
    $latestOrder = $user->orders->sortByDesc('created_at')->first();
    $latestPayment = $latestOrder?->payment;
    $latestWebsite = $latestOrder?->website;

    $status = $latestOrder?->status ?? 'new';

    $statusLabel = match ($status) {
        'paid' => 'Active',
        'pending' => 'Pending',
        'expired' => 'Expired',
        default => 'New',
    };

    $statusClass = match ($status) {
        'paid' => 'bg-emerald-50 text-emerald-600',
        'pending' => 'bg-amber-50 text-amber-600',
        'expired' => 'bg-red-50 text-red-500',
        default => 'bg-sky-50 text-sky-600',
    };
@endphp

<div class="space-y-6">

    <div>
        <div class="flex items-center gap-2 text-[10px] text-slate-400">
            <a
                href="{{ route('admin.users.index') }}"
                class="hover:text-sky-600"
            >
                Users
            </a>

            <span>/</span>

            <span class="text-slate-600">
                {{ $user->name }}
            </span>
        </div>

        <div class="mt-4 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <div class="flex items-center gap-4">

                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-lg font-bold text-slate-600">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>

                <div>
                    <h1 class="text-2xl font-bold text-slate-800">
                        {{ $user->name }}
                    </h1>

                    <p class="mt-1 text-xs text-slate-400">
                        {{ $user->email }}
                    </p>

                    <div class="mt-2">
                        <span class="rounded-full px-2.5 py-1 text-[8px] font-semibold {{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>
                    </div>
                </div>

            </div>

            <div class="flex gap-2">

                <a
                    href="{{ route('admin.users.edit', $user) }}"
                    class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-[10px] font-semibold text-slate-600 hover:bg-slate-50"
                >
                    Edit User
                </a>

                @if(!$user->orders()->exists())

                    <form
                        method="POST"
                        action="{{ route('admin.users.destroy', $user) }}"
                        onsubmit="return confirm('Hapus user ini?')"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="rounded-lg border border-red-100 bg-red-50 px-4 py-2 text-[10px] font-semibold text-red-500 hover:bg-red-100"
                        >
                            Delete User
                        </button>
                    </form>

                @endif

            </div>

        </div>
    </div>

    <div class="grid gap-5 xl:grid-cols-2">

        <div class="rounded-xl border border-slate-100 bg-white p-5 shadow-sm">

            <h2 class="text-sm font-bold text-slate-800">
                Personal Information
            </h2>

            <div class="mt-5 grid gap-5 sm:grid-cols-2">

                <div>
                    <p class="text-[9px] uppercase tracking-wide text-slate-400">
                        Full Name
                    </p>

                    <p class="mt-1 text-xs font-semibold text-slate-700">
                        {{ $user->name }}
                    </p>
                </div>

                <div>
                    <p class="text-[9px] uppercase tracking-wide text-slate-400">
                        Email
                    </p>

                    <p class="mt-1 text-xs font-semibold text-slate-700 break-all">
                        {{ $user->email }}
                    </p>
                </div>

                <div>
                    <p class="text-[9px] uppercase tracking-wide text-slate-400">
                        Registered
                    </p>

                    <p class="mt-1 text-xs font-semibold text-slate-700">
                        {{ $user->created_at->format('d M Y, H:i') }}
                    </p>
                </div>

                <div>
                    <p class="text-[9px] uppercase tracking-wide text-slate-400">
                        User ID
                    </p>

                    <p class="mt-1 text-xs font-semibold text-slate-700">
                        #{{ $user->id }}
                    </p>
                </div>

            </div>

        </div>

        <div class="rounded-xl border border-slate-100 bg-white p-5 shadow-sm">

            <h2 class="text-sm font-bold text-slate-800">
                Website Information
            </h2>

            @if($latestOrder)

                <div class="mt-5 space-y-4">

                    <div>
                        <p class="text-[9px] uppercase tracking-wide text-slate-400">
                            Domain
                        </p>

                        <p class="mt-1 text-xs font-semibold text-slate-700">
                            {{ $latestOrder->domain_name ?: 'Not configured' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[9px] uppercase tracking-wide text-slate-400">
                            Website Status
                        </p>

                        <p class="mt-1 text-xs font-semibold text-slate-700">
                            {{ ucfirst($latestWebsite?->status ?? 'Not created') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[9px] uppercase tracking-wide text-slate-400">
                            Order Number
                        </p>

                        <p class="mt-1 text-xs font-semibold text-slate-700">
                            {{ $latestOrder->order_number }}
                        </p>
                    </div>

                </div>

            @else

                <div class="mt-5 rounded-lg bg-slate-50 p-4">
                    <p class="text-xs text-slate-400">
                        User belum memiliki website atau pesanan.
                    </p>
                </div>

            @endif

        </div>

        <div class="rounded-xl border border-slate-100 bg-white p-5 shadow-sm">

            <h2 class="text-sm font-bold text-slate-800">
                Subscription
            </h2>

            @if($latestOrder)

                <div class="mt-5 grid gap-5 sm:grid-cols-2">

                    <div>
                        <p class="text-[9px] uppercase tracking-wide text-slate-400">
                            Plan
                        </p>

                        <p class="mt-1 text-xs font-semibold text-slate-700">
                            {{ $latestOrder->package?->name ?? '—' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[9px] uppercase tracking-wide text-slate-400">
                            Status
                        </p>

                        <span class="mt-1 inline-flex rounded-full px-2.5 py-1 text-[8px] font-semibold {{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>
                    </div>

                    <div>
                        <p class="text-[9px] uppercase tracking-wide text-slate-400">
                            Order Date
                        </p>

                        <p class="mt-1 text-xs font-semibold text-slate-700">
                            {{ $latestOrder->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[9px] uppercase tracking-wide text-slate-400">
                            Total
                        </p>

                        <p class="mt-1 text-xs font-semibold text-slate-700">
                            Rp {{ number_format($latestOrder->total_amount, 0, ',', '.') }}
                        </p>
                    </div>

                </div>

            @else

                <p class="mt-5 text-xs text-slate-400">
                    Belum ada subscription.
                </p>

            @endif

        </div>

        <div class="rounded-xl border border-slate-100 bg-white p-5 shadow-sm">

            <h2 class="text-sm font-bold text-slate-800">
                Admin Notes
            </h2>

            <div class="mt-5 rounded-lg bg-slate-50 p-4">

                <p class="text-[10px] leading-5 text-slate-500">
                    Fitur catatan admin belum memiliki kolom penyimpanan
                    pada database saat ini.
                </p>

                <p class="mt-2 text-[9px] text-slate-400">
                    UI disiapkan terlebih dahulu dan dapat dihubungkan ke
                    database pada tahap berikutnya.
                </p>

            </div>

        </div>

    </div>

    <div class="rounded-xl border border-slate-100 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-5 py-4">

            <h2 class="text-sm font-bold text-slate-800">
                Payment History
            </h2>

            <p class="mt-1 text-[10px] text-slate-400">
                Riwayat pembayaran user.
            </p>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full min-w-[650px]">

                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50">

                        <th class="px-5 py-3 text-left text-[8px] font-semibold uppercase tracking-wide text-slate-400">
                            Order
                        </th>

                        <th class="px-5 py-3 text-left text-[8px] font-semibold uppercase tracking-wide text-slate-400">
                            Method
                        </th>

                        <th class="px-5 py-3 text-left text-[8px] font-semibold uppercase tracking-wide text-slate-400">
                            Amount
                        </th>

                        <th class="px-5 py-3 text-left text-[8px] font-semibold uppercase tracking-wide text-slate-400">
                            Status
                        </th>

                        <th class="px-5 py-3 text-left text-[8px] font-semibold uppercase tracking-wide text-slate-400">
                            Date
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @forelse($user->orders->sortByDesc('created_at') as $order)

                        @php
                            $payment = $order->payment;
                        @endphp

                        <tr class="border-b border-slate-100 last:border-0">

                            <td class="px-5 py-4 text-[9px] font-semibold text-slate-700">
                                {{ $order->order_number }}
                            </td>

                            <td class="px-5 py-4 text-[9px] text-slate-500">
                                {{ $payment?->payment_method ?? $order->payment_method ?? '—' }}
                            </td>

                            <td class="px-5 py-4 text-[9px] font-semibold text-slate-700">
                                Rp {{ number_format($payment?->amount_paid ?? $order->total_amount, 0, ',', '.') }}
                            </td>

                            <td class="px-5 py-4">

                                @php
                                    $paymentStatus = $payment?->status ?? 'unpaid';

                                    $paymentClass = match ($paymentStatus) {
                                        'paid' => 'bg-emerald-50 text-emerald-600',
                                        'pending' => 'bg-amber-50 text-amber-600',
                                        'failed', 'expired' => 'bg-red-50 text-red-500',
                                        default => 'bg-slate-100 text-slate-500',
                                    };
                                @endphp

                                <span class="rounded-full px-2.5 py-1 text-[8px] font-semibold {{ $paymentClass }}">
                                    {{ ucfirst($paymentStatus) }}
                                </span>

                            </td>

                            <td class="px-5 py-4 text-[9px] text-slate-500">
                                {{ $order->created_at->format('d M Y') }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-xs text-slate-400">
                                Belum ada riwayat pembayaran.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection