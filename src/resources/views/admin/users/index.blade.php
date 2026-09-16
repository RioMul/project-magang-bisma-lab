@extends('layouts.admin')

@section('title', 'Users | Admin Panel')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">
                User Directory
            </h1>

            <p class="mt-1 text-xs text-slate-500">
                Monitor and manage all active digital retailers across the platform.
            </p>
        </div>

        <div class="flex gap-2">
            <button class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-[10px] font-medium text-slate-600">
                Export CSV
            </button>

            <a
                href="{{ route('admin.users.create') }}"
                class="rounded-lg bg-sky-600 px-3 py-2 text-[10px] font-semibold text-white hover:bg-sky-700"
            >
                + New User
            </a>
        </div>
    </div>

    <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-6">

        @php
            $totalUsers = \App\Models\User::where('is_admin', false)->count();

            $activeUsers = \App\Models\User::where('is_admin', false)
                ->whereHas('orders', fn ($query) => $query->where('status', 'paid'))
                ->count();

            $pendingUsers = \App\Models\User::where('is_admin', false)
                ->whereHas('orders', fn ($query) => $query->where('status', 'pending'))
                ->count();

            $expiredUsers = \App\Models\User::where('is_admin', false)
                ->whereHas('orders', fn ($query) => $query->where('status', 'expired'))
                ->count();

            $newUsers = \App\Models\User::where('is_admin', false)
                ->whereDate('created_at', '>=', now()->subDays(30))
                ->count();
        @endphp

        <div class="rounded-xl border border-slate-100 bg-white p-4 shadow-sm">
            <p class="text-[8px] uppercase tracking-wide text-slate-400">
                Total Users
            </p>

            <p class="mt-1 text-lg font-bold text-slate-800">
                {{ number_format($totalUsers) }}
            </p>
        </div>

        <div class="rounded-xl border border-slate-100 bg-white p-4 shadow-sm">
            <p class="text-[8px] uppercase tracking-wide text-slate-400">
                Active
            </p>

            <p class="mt-1 text-lg font-bold text-slate-800">
                {{ number_format($activeUsers) }}
            </p>
        </div>

        <div class="rounded-xl border border-slate-100 bg-white p-4 shadow-sm">
            <p class="text-[8px] uppercase tracking-wide text-slate-400">
                Pending
            </p>

            <p class="mt-1 text-lg font-bold text-slate-800">
                {{ number_format($pendingUsers) }}
            </p>
        </div>

        <div class="rounded-xl border border-slate-100 bg-white p-4 shadow-sm">
            <p class="text-[8px] uppercase tracking-wide text-slate-400">
                Expired
            </p>

            <p class="mt-1 text-lg font-bold text-slate-800">
                {{ number_format($expiredUsers) }}
            </p>
        </div>

        <div class="rounded-xl border border-slate-100 bg-white p-4 shadow-sm">
            <p class="text-[8px] uppercase tracking-wide text-slate-400">
                New
            </p>

            <p class="mt-1 text-lg font-bold text-slate-800">
                {{ number_format($newUsers) }}
            </p>
        </div>

        <div class="rounded-xl border border-slate-100 bg-white p-4 shadow-sm">
            <p class="text-[8px] uppercase tracking-wide text-slate-400">
                Paying
            </p>

            <p class="mt-1 text-lg font-bold text-slate-800">
                {{ number_format($activeUsers) }}
            </p>
        </div>
    </div>

    <div class="rounded-xl border border-slate-100 bg-white p-4 shadow-sm">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col gap-2 lg:flex-row">

            <div class="flex flex-1 items-center gap-2 rounded-lg bg-slate-50 px-3 py-2">
                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <circle cx="11" cy="11" r="7"/>
                    <path stroke-linecap="round" d="M20 20l-4-4"/>
                </svg>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by name, email or domain..."
                    class="w-full border-0 bg-transparent p-0 text-[10px] text-slate-600 outline-none focus:ring-0"
                >
            </div>

            <select class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-[10px] text-slate-500">
                <option>Status: All</option>
                <option>Active</option>
                <option>Pending</option>
                <option>Expired</option>
            </select>

            <select class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-[10px] text-slate-500">
                <option>Plan: All</option>
            </select>

            <button
                type="submit"
                class="rounded-lg bg-sky-600 px-4 py-2 text-[10px] font-semibold text-white"
            >
                Search
            </button>

            <a
                href="{{ route('admin.users.index') }}"
                class="rounded-lg px-3 py-2 text-[10px] font-semibold text-sky-600"
            >
                Reset Filters
            </a>

        </form>
    </div>

    @if(session('success'))
        <div class="rounded-lg border border-emerald-100 bg-emerald-50 px-4 py-3 text-xs text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-xl border border-slate-100 bg-white shadow-sm">

        <div class="overflow-x-auto">
            <table class="w-full min-w-[950px]">

                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50">
                        <th class="w-10 px-4 py-3"></th>

                        <th class="px-4 py-3 text-left text-[8px] font-semibold uppercase tracking-wide text-slate-400">
                            Name & Identity
                        </th>

                        <th class="px-4 py-3 text-left text-[8px] font-semibold uppercase tracking-wide text-slate-400">
                            Website / Domain
                        </th>

                        <th class="px-4 py-3 text-left text-[8px] font-semibold uppercase tracking-wide text-slate-400">
                            Plan
                        </th>

                        <th class="px-4 py-3 text-left text-[8px] font-semibold uppercase tracking-wide text-slate-400">
                            Status
                        </th>

                        <th class="px-4 py-3 text-left text-[8px] font-semibold uppercase tracking-wide text-slate-400">
                            Payment
                        </th>

                        <th class="px-4 py-3 text-right text-[8px] font-semibold uppercase tracking-wide text-slate-400">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($users as $user)

                        @php
                            $latestOrder = $user->orders->first();
                            $latestPayment = $latestOrder?->payment;

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

                        <tr class="border-b border-slate-100 last:border-0 hover:bg-slate-50/60">

                            <td class="px-4 py-4">
                                <input
                                    type="checkbox"
                                    class="rounded border-slate-300 text-sky-600 focus:ring-sky-500"
                                >
                            </td>

                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-100 text-xs font-bold text-slate-600">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>

                                    <div>
                                        <a
                                            href="{{ route('admin.users.show', $user) }}"
                                            class="text-[10px] font-semibold text-slate-700 hover:text-sky-600"
                                        >
                                            {{ $user->name }}
                                        </a>

                                        <p class="mt-1 text-[8px] text-slate-400">
                                            {{ $user->email }}
                                        </p>
                                    </div>

                                </div>
                            </td>

                            <td class="px-4 py-4">
                                @if($latestOrder?->domain_name)
                                    <p class="text-[9px] font-medium text-slate-700">
                                        {{ $latestOrder->domain_name }}
                                    </p>

                                    <p class="mt-1 text-[8px] text-slate-400">
                                        Created {{ $latestOrder->created_at->format('d M Y') }}
                                    </p>
                                @else
                                    <span class="text-[9px] text-slate-400">
                                        No website
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-4">
                                @if($latestOrder?->package)
                                    <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[8px] font-semibold text-slate-600">
                                        {{ $latestOrder->package->name }}
                                    </span>
                                @else
                                    <span class="text-[9px] text-slate-400">
                                        -
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-4">
                                <span class="rounded-full px-2.5 py-1 text-[8px] font-semibold {{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>

                            <td class="px-4 py-4">
                                @if($latestPayment)
                                    <p class="text-[9px] font-medium text-slate-700">
                                        Rp {{ number_format($latestPayment->amount_paid, 0, ',', '.') }}
                                    </p>

                                    <p class="mt-1 text-[8px] text-slate-400">
                                        {{ ucfirst($latestPayment->status) }}
                                    </p>
                                @else
                                    <span class="text-[9px] text-slate-400">
                                        No payment
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-4 text-right">
                                <a
                                    href="{{ route('admin.users.show', $user) }}"
                                    class="rounded-lg border border-slate-200 px-3 py-1.5 text-[8px] font-medium text-slate-600 hover:border-sky-200 hover:text-sky-600"
                                >
                                    View Detail
                                </a>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center">
                                <p class="text-sm font-semibold text-slate-600">
                                    No users found
                                </p>

                                <p class="mt-1 text-xs text-slate-400">
                                    Belum ada customer yang sesuai dengan pencarian.
                                </p>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

        <div class="border-t border-slate-100 px-5 py-4">
            {{ $users->links() }}
        </div>

    </div>

</div>
@endsection