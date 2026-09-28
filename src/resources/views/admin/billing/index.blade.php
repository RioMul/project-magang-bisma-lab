@extends('admin.layouts.app') 

@section('title', 'Billing') 

@section('content') 
<div class="max-w-[1400px] space-y-6">     
    
    {{-- HEADER --}}
    <div class="flex flex-col gap-4 xl:flex-row xl:items-end xl:justify-between mb-8">
        <div>
            <h1 class="text-[28px] font-bold tracking-tight text-slate-900 leading-tight">Dashboard Overview</h1>
            <p class="mt-1 text-sm text-slate-500 font-medium">Welcome back, here's what's happening today.</p>
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

    {{-- STATS CARDS --}}
    @include('admin.billing.partials.billing_summary')

    {{-- MOCKUP CHARTS SECTION --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
        {{-- Line Chart: Tren Pembayaran --}}
        <div class="xl:col-span-2 bg-white rounded-3xl border border-slate-100 p-8 shadow-sm flex flex-col relative overflow-hidden">
            <div class="flex items-start justify-between relative z-10 mb-8">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Tren Pembayaran Tagihan</h2>
                    <p class="text-xs text-slate-400 mt-1">Daily paid invoice overview</p>
                </div>
                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-50 border border-slate-100 text-[10px] font-bold text-slate-600 uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-[#0369a1]"></span> Paid
                </span>
            </div>
            <div class="flex-1 relative w-full mt-4 min-h-[200px] flex items-end">
                <div class="absolute inset-0 flex flex-col justify-between pointer-events-none pb-6">
                    <div class="w-full h-px bg-slate-50"></div>
                    <div class="w-full h-px bg-slate-50"></div>
                    <div class="w-full h-px bg-slate-50"></div>
                    <div class="w-full h-px bg-slate-100"></div>
                </div>
                <svg class="w-full h-[180px] relative z-10 drop-shadow-sm mb-6" preserveAspectRatio="none" viewBox="0 0 1000 300">
                    <defs>
                        <linearGradient id="billingGradient" x1="0" x2="0" y1="0" y2="1">
                            <stop offset="0%" stop-color="#0284c7" stop-opacity="0.2" />
                            <stop offset="100%" stop-color="#0284c7" stop-opacity="0" />
                        </linearGradient>
                    </defs>
                    <path d="M0,250 C100,250 150,180 200,100 C250,20 300,90 350,100 C400,110 450,160 500,160 C550,160 600,80 650,60 C700,40 750,80 800,80 C850,80 900,40 1000,50 L1000,300 L0,300 Z" fill="url(#billingGradient)" />
                    <path d="M0,250 C100,250 150,180 200,100 C250,20 300,90 350,100 C400,110 450,160 500,160 C550,160 600,80 650,60 C700,40 750,80 800,80 C850,80 900,40 1000,50" fill="none" stroke="#0369a1" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </div>

        {{-- Bar Chart: Sumber Tagihan --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-8 shadow-sm">
            <h2 class="text-base font-bold text-slate-900 mb-6">Sumber Tagihan</h2>
            <div class="space-y-6">
                <div>
                    <div class="flex justify-between items-end mb-2">
                        <span class="text-xs font-semibold text-slate-600">User Baru</span>
                        <span class="text-xs font-bold text-slate-900">45%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-[#0369a1] rounded-full" style="width: 45%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-end mb-2">
                        <span class="text-xs font-semibold text-slate-600">User 2th +</span>
                        <span class="text-xs font-bold text-slate-900">32%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-sky-400 rounded-full" style="width: 32%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-end mb-2">
                        <span class="text-xs font-semibold text-slate-600">User 3th +</span>
                        <span class="text-xs font-bold text-slate-900">12%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-slate-300 rounded-full" style="width: 12%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-end mb-2">
                        <span class="text-xs font-semibold text-slate-600">User 5th +</span>
                        <span class="text-xs font-bold text-slate-900">11%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-slate-200 rounded-full" style="width: 11%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLE SECTION --}}
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden mb-8">
        <div class="px-8 py-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between border-b border-slate-50">
            <h2 class="text-lg font-bold text-slate-900">Recent Orders</h2>
            
            {{-- SEARCH & FILTER FORM --}}
            <form method="GET" action="{{ route('admin.billing.index') }}" class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
                <div class="relative w-full sm:w-64">
                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="7"/>
                        <path stroke-linecap="round" d="M21 21l-4.35-4.35"/>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search invoice..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-xs text-slate-700 outline-none transition focus:border-[#0369a1] focus:bg-white focus:ring-2 focus:ring-sky-50 shadow-sm">
                </div>
                <select name="status" onchange="this.form.submit()" class="w-full sm:w-auto rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-600 outline-none shadow-sm cursor-pointer hover:bg-slate-50 transition focus:border-[#0369a1]">
                    <option value="">All Status</option>
                    <option value="paid" @selected(request('status') === 'paid')>Paid</option>
                    <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                    <option value="failed" @selected(request('status') === 'failed')>Failed</option>
                    <option value="expired" @selected(request('status') === 'expired')>Expired</option>
                </select>
                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.billing.index') }}" class="text-xs font-bold text-slate-400 hover:text-rose-500 transition px-2">Reset</a>
                @endif
            </form>
        </div>

        @include('admin.billing.partials.payment_table')
    </div>

</div> 
@endsection