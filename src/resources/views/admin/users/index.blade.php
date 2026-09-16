@extends('admin.layouts.app') 

@section('title', 'Users') 

@section('content') 
<div class="space-y-6">     
    
    {{-- HEADER --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-[28px] font-bold tracking-tight text-slate-900 leading-tight">
                User Directory
            </h1>
            <p class="mt-1 text-sm text-slate-500 font-medium">
                Monitor and manage all active digital ateliers across the platform.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition shadow-sm">
                <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Export CSV
            </button>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#0369a1] hover:bg-[#075985] text-white text-sm font-semibold transition shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                New User
            </a>
        </div>
    </div>

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
        {{-- Card 1: Total Users --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-5 shadow-sm">
            <div class="flex items-center justify-between mb-3 text-slate-400">
                <span class="text-[10px] font-bold uppercase tracking-wider">Total Users</span>
                <svg class="w-4 h-4 text-[#0369a1]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <div class="flex items-end gap-2">
                <h3 class="text-2xl font-bold text-slate-900">{{ number_format($totalUsers) }}</h3>
                <span class="text-[11px] font-bold text-emerald-500 mb-1 flex items-center">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    8%
                </span>
            </div>
        </div>

        {{-- Card 2: Active --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-5 shadow-sm">
            <div class="flex items-center justify-between mb-3 text-slate-400">
                <span class="text-[10px] font-bold uppercase tracking-wider">Active</span>
                <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="flex items-end gap-2">
                <h3 class="text-2xl font-bold text-slate-900">{{ number_format($activeUsers) }}</h3>
                <span class="text-[11px] font-bold text-emerald-500 mb-1 flex items-center">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    12%
                </span>
            </div>
        </div>

        {{-- Card 3: Pending --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-5 shadow-sm">
            <div class="flex items-center justify-between mb-3 text-slate-400">
                <span class="text-[10px] font-bold uppercase tracking-wider">Pending</span>
                <svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="flex items-end gap-2">
                <h3 class="text-2xl font-bold text-slate-900">{{ number_format($pendingUsers) }}</h3>
                <span class="text-[11px] font-bold text-rose-500 mb-1 flex items-center">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"/></svg>
                    2%
                </span>
            </div>
        </div>

        {{-- Card 4: Expired --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-5 shadow-sm">
            <div class="flex items-center justify-between mb-3 text-slate-400">
                <span class="text-[10px] font-bold uppercase tracking-wider">Expired</span>
                <svg class="w-4 h-4 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div class="flex items-end gap-2">
                <h3 class="text-2xl font-bold text-slate-900">{{ number_format($expiredUsers) }}</h3>
                <span class="text-[11px] font-bold text-rose-500 mb-1 flex items-center">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"/></svg>
                    5%
                </span>
            </div>
        </div>

        {{-- Card 5: New --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-5 shadow-sm">
            <div class="flex items-center justify-between mb-3 text-slate-400">
                <span class="text-[10px] font-bold uppercase tracking-wider">New</span>
                <svg class="w-4 h-4 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
            </div>
            <div class="flex items-end gap-2">
                <h3 class="text-2xl font-bold text-slate-900">{{ number_format($newUsers) }}</h3>
                <span class="text-[11px] font-bold text-emerald-500 mb-1 flex items-center">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    24%
                </span>
            </div>
        </div>

        {{-- Card 6: Paying --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-5 shadow-sm">
            <div class="flex items-center justify-between mb-3 text-slate-400">
                <span class="text-[10px] font-bold uppercase tracking-wider">Paying</span>
                <svg class="w-4 h-4 text-[#0369a1]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <div class="flex items-end gap-2">
                <h3 class="text-2xl font-bold text-slate-900">{{ number_format($payingUsers) }}</h3>
                <span class="text-[11px] font-bold text-emerald-500 mb-1 flex items-center">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    7%
                </span>
            </div>
        </div>
    </div>

    {{-- FILTER ROW --}}
    <form method="GET" action="{{ route('admin.users.index') }}" class="bg-slate-50/70 p-2.5 rounded-2xl border border-slate-100 flex flex-col xl:flex-row items-center gap-3 mb-8 shadow-sm">
        
        <div class="relative w-full xl:flex-1 bg-white rounded-xl shadow-sm border border-slate-200">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="7"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or domain..." class="w-full pl-10 pr-4 py-3 bg-transparent border-0 text-sm text-slate-700 placeholder:text-slate-400 focus:ring-0 outline-none rounded-xl">
        </div>

        <select name="status" onchange="this.form.submit()" class="w-full xl:w-44 px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 focus:ring-0 outline-none shadow-sm cursor-pointer hover:bg-slate-50 transition">
            <option value="">Status: All</option>
            <option value="paid" @selected(request('status') === 'paid')>Active</option>
            <option value="pending" @selected(request('status') === 'pending')>Pending</option>
            <option value="expired" @selected(request('status') === 'expired')>Expired</option>
            <option value="new" @selected(request('status') === 'new')>New</option>
        </select>

        <select name="plan" onchange="this.form.submit()" class="w-full xl:w-44 px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 focus:ring-0 outline-none shadow-sm cursor-pointer hover:bg-slate-50 transition">
            <option value="">Plan: All</option>
            @foreach($packages as $package)
                <option value="{{ $package->id }}" @selected((string) request('plan') === (string) $package->id)>Plan {{ $package->name }}</option>
            @endforeach
        </select>

        <div class="w-full xl:w-40 px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-600 shadow-sm flex items-center justify-between cursor-not-allowed">
            <span>Date: Today</span>
        </div>

        <a href="{{ route('admin.users.index') }}" class="px-6 py-3 text-sm font-bold text-[#0369a1] hover:text-[#075985] whitespace-nowrap transition">
            Reset Filters
        </a>
    </form>

    {{-- TABLE --}}
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[10px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100 bg-white">
                        <th class="px-8 py-5 w-12 text-center">
                            <input type="checkbox" class="rounded border-slate-300 text-sky-600 focus:ring-sky-500">
                        </th>
                        <th class="px-6 py-5">Name & Identity</th>
                        <th class="px-6 py-5">Website/Domain</th>
                        <th class="px-6 py-5">Plan</th>
                        <th class="px-6 py-5">Status</th>
                        <th class="px-6 py-5">Payment</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($users as $user)
                        @php
                            $latestOrder = $user->orders->first();
                            $latestPayment = $latestOrder?->payment;
                            $status = $latestOrder?->status ?? 'new';
                        @endphp
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-8 py-5 text-center">
                                <input type="checkbox" class="rounded border-slate-300 text-sky-600 focus:ring-sky-500">
                            </td>

                            {{-- Avatar + Identity --}}
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-slate-800 text-white flex items-center justify-center font-bold text-sm shrink-0 overflow-hidden shadow-sm">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=1e293b&color=fff" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-slate-800">{{ $user->name }}</div>
                                        <div class="text-[11px] font-medium text-slate-500 mt-0.5">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            {{-- Website/Domain --}}
                            <td class="px-6 py-5">
                                @if($latestOrder?->domain_name)
                                    <a href="http://{{ $latestOrder->domain_name }}" target="_blank" class="text-sm font-semibold text-[#0369a1] hover:text-[#075985] hover:underline transition">{{ $latestOrder->domain_name }}</a>
                                    <div class="text-[11px] font-medium text-slate-400 mt-0.5">Created: {{ $latestOrder->created_at->format('d M Y') }}</div>
                                @else
                                    <span class="text-sm text-slate-400">-</span>
                                @endif
                            </td>

                            {{-- Plan --}}
                            <td class="px-6 py-5">
                                @if($latestOrder?->package)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold uppercase tracking-wide">
                                        Plan {{ $latestOrder->package->name }}
                                    </span>
                                @else
                                    <span class="text-sm text-slate-400">-</span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-5">
                                @if($status === 'paid')
                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-600 text-[11px] font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                                    </span>
                                @elseif($status === 'pending')
                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-50 border border-amber-100 text-amber-600 text-[11px] font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                                    </span>
                                @elseif($status === 'expired' || $status === 'failed')
                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-50 border border-rose-100 text-rose-600 text-[11px] font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Expired
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-50 border border-sky-100 text-sky-600 text-[11px] font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span> New
                                    </span>
                                @endif
                            </td>

                            {{-- Payment --}}
                            <td class="px-6 py-5">
                                @if($latestPayment || $latestOrder)
                                    <div class="text-sm font-bold text-slate-700">Rp {{ number_format($latestPayment->amount_paid ?? $latestOrder->total_amount, 0, ',', '.') }}</div>
                                    <div class="text-[11px] font-medium text-slate-400 mt-0.5">
                                        {{ $status === 'paid' ? 'Last: ' . ($latestPayment?->created_at->format('d M Y') ?? $latestOrder->created_at->format('d M Y')) : 'Awaiting Verification' }}
                                    </div>
                                @else
                                    <span class="text-sm text-slate-400">-</span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="px-8 py-5 text-right">
                                <a href="{{ route('admin.users.show', $user) }}" class="inline-flex items-center px-4 py-2 rounded-xl border border-slate-200 bg-white text-[11px] font-bold text-[#0369a1] hover:border-sky-200 hover:bg-sky-50 transition shadow-sm">
                                    View Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-sm font-medium text-slate-400">
                                No users found matching your criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination & Footer --}}
        <div class="px-8 py-5 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4 bg-slate-50/50 rounded-b-3xl">
            <div class="flex items-center gap-6 text-[11px] text-slate-500 font-semibold uppercase tracking-wide">
                <div class="flex items-center gap-2">
                    <span>Rows per page:</span>
                    <span class="font-bold text-slate-700 bg-white border border-slate-200 px-2.5 py-1 rounded-md shadow-sm">10</span>
                </div>
                <span>Showing {{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }} of {{ number_format($users->total()) }} users</span>
            </div>
            
            <div class="w-full md:w-auto">
                {{ $users->links() }}
            </div>
        </div>
    </div>

</div> 
@endsection