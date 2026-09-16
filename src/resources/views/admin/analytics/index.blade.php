@extends('admin.layouts.app') 

@section('title', 'Analytics') 

@section('content') 
<div class="space-y-5">     
    
    {{-- HEADER & FILTER --}}
    <div class="flex flex-col gap-4 xl:flex-row xl:items-end xl:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Visitor Analytics</h1>
            <p class="mt-1 text-xs text-slate-500 font-medium">Monitoring audience growth and engagement patterns.</p>
        </div>
        
        <div class="w-full xl:w-auto overflow-x-auto pb-2 xl:pb-0">
            <div class="inline-flex items-center gap-1 bg-white border border-slate-100 rounded-lg p-1 shadow-sm min-w-max">
                <button class="px-3 py-1.5 rounded-md bg-sky-50 text-[#0369a1] text-[10px] font-bold whitespace-nowrap">Last 30 Days</button>
                <button class="px-3 py-1.5 rounded-md text-slate-500 hover:bg-slate-50 text-[10px] font-semibold whitespace-nowrap transition">Last Quarter</button>
                <button class="px-3 py-1.5 rounded-md text-slate-500 hover:bg-slate-50 text-[10px] font-semibold whitespace-nowrap transition">Custom</button>
                <div class="w-px h-4 bg-slate-200 mx-1"></div>
                <button class="px-3 py-1.5 text-slate-600 text-[10px] font-semibold flex items-center gap-1.5 whitespace-nowrap hover:bg-slate-50 rounded-md transition">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    {{ $startDate->format('M d') }} - {{ $endDate->format('M d, Y') }}
                </button>
            </div>
        </div>
    </div>

    {{-- MEMANGGIL KOMPONEN STATS CARD --}}
    @include('admin.analytics.partials.stats')

    {{-- MIDDLE SECTION: CHARTS --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 mb-5">
        
        {{-- LINE CHART --}}
        @include('admin.analytics.partials.visitor_chart')

        {{-- RIGHT SIDE CHARTS --}}
        <div class="space-y-5">
            @include('admin.analytics.partials.device_breakdown')
            @include('admin.analytics.partials.traffic_sources')
        </div>
    </div>

    {{-- BOTTOM TABLE --}}
    @include('admin.analytics.partials.top_content')

</div> 
@endsection