@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- HEADER SECTION --}}
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-[28px] font-bold tracking-tight text-slate-900 leading-tight">
            Dashboard Overview
        </h1>
        <p class="mt-1 text-sm text-slate-500 font-medium">
            Welcome back, here's what's happening today.
        </p>
    </div>

    <div class="flex items-center gap-3">
        <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition shadow-sm">
            <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            Last 30 Days
        </button>

        <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#0369a1] hover:bg-[#075985] text-white text-sm font-semibold transition shadow-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Export
        </button>
    </div>
</div>

{{-- STATS GRID --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

    {{-- Card 1: Total Users --}}
    <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[11px] font-bold">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                12%
            </span>
        </div>
        <div class="mt-4">
            <p class="text-sm font-medium text-slate-500">Total Users</p>
            <h3 class="text-3xl font-bold text-slate-900 mt-1">{{ number_format($totalUsers) }}</h3>
        </div>
    </div>

    {{-- Card 2: Active Websites --}}
    <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="9"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.6 9h16.8M3.6 15h16.8M12 3v18"/>
                </svg>
            </div>
            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[11px] font-bold">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                5%
            </span>
        </div>
        <div class="mt-4">
            <p class="text-sm font-medium text-slate-500">Active Websites</p>
            <h3 class="text-3xl font-bold text-slate-900 mt-1">{{ number_format($activeWebsites) }}</h3>
        </div>
    </div>

    {{-- Card 3: Monthly Revenue --}}
    <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="6" width="20" height="12" rx="2" ry="2"/>
                    <circle cx="12" cy="12" r="2"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12h.01M18 12h.01"/>
                </svg>
            </div>
            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[11px] font-bold">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                18%
            </span>
        </div>
        <div class="mt-4">
            <p class="text-sm font-medium text-slate-500">Monthly Revenue</p>
            <h3 class="text-3xl font-bold text-slate-900 mt-1">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</h3>
        </div>
    </div>

    {{-- Card 4: Expired Subscriptions --}}
    <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l4 4m0-4l-4 4"/>
                </svg>
            </div>
            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-rose-50 text-rose-600 text-[11px] font-bold">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"/></svg>
                2%
            </span>
        </div>
        <div class="mt-4">
            <p class="text-sm font-medium text-slate-500">Expired Subscriptions</p>
            <h3 class="text-3xl font-bold text-slate-900 mt-1">{{ number_format($expiredOrders) }}</h3>
        </div>
    </div>

</div>

{{-- CHARTS SECTION --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

    {{-- Revenue Line Chart (Mockup Visual) --}}
    <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-100 p-8 shadow-sm flex flex-col relative overflow-hidden">
        <div class="flex items-start justify-between relative z-10 mb-8">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Revenue Over Time</h2>
                <p class="text-xs text-slate-400 mt-1">Daily earning report overview</p>
            </div>
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-sky-50 text-xs font-bold text-sky-700 uppercase tracking-wider">
                <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                Earnings
            </span>
        </div>

        <div class="flex-1 relative w-full mt-4 min-h-[200px] flex items-end">
            {{-- Horizontal Grid Lines --}}
            <div class="absolute inset-0 flex flex-col justify-between pointer-events-none">
                <div class="w-full h-px bg-slate-50"></div>
                <div class="w-full h-px bg-slate-50"></div>
                <div class="w-full h-px bg-slate-50"></div>
                <div class="w-full h-px bg-slate-100"></div>
            </div>
            {{-- Smooth Line Chart SVG Mockup (Matches Design) --}}
            <svg class="w-full h-[180px] relative z-10 drop-shadow-sm" preserveAspectRatio="none" viewBox="0 0 1000 300">
                <defs>
                    <linearGradient id="gradientArea" x1="0" x2="0" y1="0" y2="1">
                        <stop offset="0%" stop-color="#0284c7" stop-opacity="0.2" />
                        <stop offset="100%" stop-color="#0284c7" stop-opacity="0" />
                    </linearGradient>
                </defs>
                <path d="M0,250 C100,250 150,180 200,100 C250,20 300,90 350,100 C400,110 450,160 500,160 C550,160 600,80 650,60 C700,40 750,80 800,80 C850,80 900,40 1000,50 L1000,300 L0,300 Z" fill="url(#gradientArea)" />
                <path d="M0,250 C100,250 150,180 200,100 C250,20 300,90 350,100 C400,110 450,160 500,160 C550,160 600,80 650,60 C700,40 750,80 800,80 C850,80 900,40 1000,50" fill="none" stroke="#0284c7" stroke-width="4" stroke-linecap="round" />
            </svg>
        </div>
    </div>

    {{-- User Growth Bar Chart --}}
    <div class="bg-white rounded-3xl border border-slate-100 p-8 shadow-sm flex flex-col">
        <h2 class="text-lg font-bold text-slate-900">User Growth</h2>
        
        <div class="flex items-center justify-between mt-6">
            <span class="text-sm font-medium text-slate-500">This Month</span>
            <span class="text-sm font-bold text-[#0369a1]">+{{ number_format($monthlyUsers ?? 2410) }}</span>
        </div>

        <div class="flex-1 mt-8 flex items-end justify-between gap-4 px-2">
            {{-- Bars (Mockup Visual) --}}
            <div class="w-12 h-[45%] bg-slate-100 rounded-t-xl transition-all hover:bg-slate-200 cursor-pointer"></div>
            <div class="w-12 h-[35%] bg-slate-100 rounded-t-xl transition-all hover:bg-slate-200 cursor-pointer"></div>
            <div class="w-12 h-[75%] bg-[#93c5fd] rounded-t-xl transition-all hover:bg-[#60a5fa] cursor-pointer shadow-sm relative">
                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-1.5 h-1.5 rounded-full bg-[#3b82f6]"></div>
            </div>
            <div class="w-12 h-[65%] bg-slate-100 rounded-t-xl transition-all hover:bg-slate-200 cursor-pointer"></div>
        </div>

        <div class="flex items-center justify-between mt-4 px-3 text-xs font-semibold text-slate-400">
            <span>Mon</span>
            <span>Wed</span>
            <span>Fri</span>
            <span>Sun</span>
        </div>
    </div>

</div>

{{-- RECENT ORDERS TABLE --}}
<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden mb-8">

    <div class="px-8 py-6 flex items-center justify-between">
        <h2 class="text-lg font-bold text-slate-900">Recent Orders</h2>
        <a href="{{ route('admin.orders.index') }}" class="text-sm font-semibold text-[#0369a1] hover:text-[#075985] transition">
            View All Orders
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-[11px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100">
                    <th class="px-8 py-4">Order ID</th>
                    <th class="px-8 py-4">Customer</th>
                    <th class="px-8 py-4">Plan</th>
                    <th class="px-8 py-4">Amount</th>
                    <th class="px-8 py-4">Date</th>
                    <th class="px-8 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                
                @forelse($recentOrders as $order)
                <tr class="hover:bg-slate-50/50 transition">
                    
                    {{-- Order ID --}}
                    <td class="px-8 py-5">
                        <span class="text-sm font-bold text-slate-700">#BSM-{{ $order->order_number }}</span>
                    </td>

                    {{-- Customer (Avatar + Name) --}}
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-3">
                            @php
                                $initials = collect(explode(' ', $order->customer_name))->map(fn($n) => substr($n, 0, 1))->take(2)->join('');
                                $colors = ['bg-sky-100 text-sky-600', 'bg-emerald-100 text-emerald-600', 'bg-blue-100 text-blue-600', 'bg-rose-100 text-rose-600'];
                                $randomColor = $colors[strlen($order->customer_name) % 4];
                            @endphp
                            <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-bold uppercase {{ $randomColor }} shrink-0">
                                {{ $initials }}
                            </div>
                            <span class="text-sm font-semibold text-slate-700">{{ $order->customer_name }}</span>
                        </div>
                    </td>

                    {{-- Plan Badge --}}
                    <td class="px-8 py-5">
                        @php 
                            $planName = $order->package?->name ?? '-'; 
                            $planLetter = substr($planName, 0, 1);
                        @endphp
                        <span class="inline-flex items-center justify-center w-8 h-6 rounded-md bg-sky-50 text-sky-600 text-xs font-bold">
                            {{ $planLetter }}
                        </span>
                    </td>

                    {{-- Amount --}}
                    <td class="px-8 py-5">
                        <span class="text-sm font-bold text-slate-700">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </td>

                    {{-- Date --}}
                    <td class="px-8 py-5">
                        <div class="flex flex-col">
                            <span class="text-sm text-slate-500 font-medium">{{ $order->created_at->format('M d,') }}</span>
                            <span class="text-sm text-slate-500 font-medium">{{ $order->created_at->format('Y') }}</span>
                        </div>
                    </td>

                    {{-- Status --}}
                    <td class="px-8 py-5">
                        @if($order->status === 'paid')
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-600 text-[11px] font-bold">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Paid
                            </span>
                        @elseif($order->status === 'pending')
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 border border-blue-100 text-blue-600 text-[11px] font-bold">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                Processing
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-50 border border-rose-100 text-rose-600 text-[11px] font-bold">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                {{ ucfirst($order->status) }}
                            </span>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-8 py-10 text-center text-sm text-slate-400">
                        Belum ada order.
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</div>

@endsection