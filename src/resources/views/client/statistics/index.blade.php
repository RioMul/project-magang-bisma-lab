@extends('layouts.client')

@section('title', 'Visitor Analytics | Bisma Labs')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col xl:flex-row xl:items-end xl:justify-between gap-4">

        <div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">
                Analytics
            </p>

            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-1">
                Visitor Analytics
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Monitor audiens, kunjungan, dan pola engagement website Anda.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-2">

            <button class="w-full sm:w-auto px-3 py-2.5 rounded-xl bg-cyan-50 text-[#0396c7] text-xs font-bold">
                Last 30 Days
            </button>

            <button class="w-full sm:w-auto px-3 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-500 text-xs font-semibold">
                Last Quarter
            </button>

            <button class="w-full sm:w-auto px-3 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-500 text-xs font-semibold">
                Custom
            </button>

        </div>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <div class="flex items-center justify-between">
                <div class="w-9 h-9 rounded-xl bg-cyan-50 text-[#0396c7] flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19a6 6 0 10-12 0M9 13a4 4 0 100-8 4 4 0 000 8zM16 11a3 3 0 100-6M17 19h4a4 4 0 00-3-3.87"/>
                    </svg>
                </div>
            </div>

            <p class="text-xs font-medium text-slate-400 mt-4">Total Visitors</p>
            <p class="text-2xl font-bold text-slate-900 mt-1">
                {{ number_format($totalVisitors) }}
            </p>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <div class="flex items-center justify-between">
                <div class="w-9 h-9 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="8"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 2"/>
                    </svg>
                </div>
            </div>

            <p class="text-xs font-medium text-slate-400 mt-4">Unique Visitors</p>
            <p class="text-2xl font-bold text-slate-900 mt-1">
                {{ number_format($uniqueVisitors) }}
            </p>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <div class="flex items-center justify-between">
                <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 12h16"/>
                    </svg>
                </div>
            </div>

            <p class="text-xs font-medium text-slate-400 mt-4">Bounce Rate</p>
            <p class="text-2xl font-bold text-slate-900 mt-1">
                {{ number_format($bounceRate, 1) }}%
            </p>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <div class="flex items-center justify-between">
                <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="8"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2"/>
                    </svg>
                </div>
            </div>

            <p class="text-xs font-medium text-slate-400 mt-4">Avg. Session</p>
            <p class="text-2xl font-bold text-slate-900 mt-1">
                {{ $averageSession }}
            </p>
        </div>

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

        <div class="xl:col-span-2 bg-white border border-slate-200 rounded-2xl p-5 sm:p-6">

            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Visitors Over Time
                    </h2>
                    <p class="text-xs text-slate-400 mt-1">
                        Traffic website selama 30 hari terakhir.
                    </p>
                </div>

                <div class="flex items-center gap-4 text-xs text-slate-400">
                    <span class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-[#0396c7]"></span>
                        Active
                    </span>
                </div>
            </div>

            <div class="mt-6 overflow-x-auto">
                <svg
                    viewBox="0 0 800 300"
                    class="w-full min-w-[650px] h-[280px]"
                    preserveAspectRatio="none">

                    <line x1="40" y1="40" x2="780" y2="40" stroke="#e2e8f0" stroke-width="1"/>
                    <line x1="40" y1="110" x2="780" y2="110" stroke="#e2e8f0" stroke-width="1"/>
                    <line x1="40" y1="180" x2="780" y2="180" stroke="#e2e8f0" stroke-width="1"/>
                    <line x1="40" y1="250" x2="780" y2="250" stroke="#e2e8f0" stroke-width="1"/>

                    @php
                        $maxVisitors = max(collect($chart)->max('visitors'), 1);
                        $points = collect($chart)->values()->map(function ($item, $index) use ($maxVisitors, $chart) {
                            $x = 40 + ($index * (740 / max(count($chart) - 1, 1)));
                            $y = 250 - (($item['visitors'] / $maxVisitors) * 190);
                            return round($x, 2) . ',' . round($y, 2);
                        })->implode(' ');
                    @endphp

                    <polyline
                        points="{{ $points }}"
                        fill="none"
                        stroke="#0396c7"
                        stroke-width="5"
                        stroke-linecap="round"
                        stroke-linejoin="round"/>

                </svg>
            </div>

        </div>

        <div class="space-y-5">

            <div class="bg-white border border-slate-200 rounded-2xl p-5">
                <h2 class="text-base font-bold text-slate-900">
                    Device Breakdown
                </h2>

                @php
                    $deviceTotal = max($mobile + $desktop, 1);
                    $mobilePercent = round(($mobile / $deviceTotal) * 100);
                    $desktopPercent = 100 - $mobilePercent;
                @endphp

                <div class="flex justify-center py-6">
                    <div
                        class="w-28 h-28 rounded-full flex items-center justify-center"
                        style="background: conic-gradient(#0396c7 {{ $mobilePercent }}%, #dbeafe 0);">

                        <div class="w-20 h-20 rounded-full bg-white flex flex-col items-center justify-center">
                            <span class="text-lg font-bold text-slate-800">
                                {{ $mobilePercent }}%
                            </span>
                            <span class="text-[9px] text-slate-400">
                                MOBILE
                            </span>
                        </div>
                    </div>
                </div>

                <div class="space-y-3 text-xs">

                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-2 text-slate-500">
                            <span class="w-2 h-2 rounded-full bg-[#0396c7]"></span>
                            Mobile
                        </span>
                        <span class="font-semibold text-slate-700">
                            {{ number_format($mobile) }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-2 text-slate-500">
                            <span class="w-2 h-2 rounded-full bg-blue-100"></span>
                            Desktop
                        </span>
                        <span class="font-semibold text-slate-700">
                            {{ number_format($desktop) }}
                        </span>
                    </div>

                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-5">

                <h2 class="text-base font-bold text-slate-900">
                    Traffic Sources
                </h2>

                @php
                    $sources = [
                        ['name' => 'Organic Search', 'percent' => 0],
                        ['name' => 'Direct Traffic', 'percent' => 0],
                        ['name' => 'Social Referral', 'percent' => 0],
                    ];
                @endphp

                <div class="space-y-5 mt-5">

                    @foreach($sources as $source)

                        <div>
                            <div class="flex justify-between text-[10px] mb-2">
                                <span class="text-slate-500">{{ $source['name'] }}</span>
                                <span class="font-semibold text-slate-700">{{ $source['percent'] }}%</span>
                            </div>

                            <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                <div
                                    class="h-full bg-[#0396c7] rounded-full"
                                    style="width: {{ $source['percent'] }}%">
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">

        <div class="px-5 sm:px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <div>
                <h2 class="text-lg font-bold text-slate-900">
                    Top Performing Content
                </h2>

                <p class="text-xs text-slate-400 mt-1">
                    Halaman dengan jumlah kunjungan tertinggi.
                </p>
            </div>

            <button class="w-full sm:w-auto px-4 py-2.5 rounded-xl bg-[#0396c7] text-white text-xs font-bold hover:bg-[#027ea7] transition">
                Export Report
            </button>

        </div>

        @if($topPages->isEmpty())

            <div class="px-6 py-12 text-center">
                <div class="w-12 h-12 mx-auto rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 5h14M5 12h14M5 19h8"/>
                    </svg>
                </div>

                <p class="font-semibold text-slate-700 mt-4">
                    Belum ada data pengunjung
                </p>

                <p class="text-sm text-slate-400 mt-1">
                    Data akan muncul setelah website mulai menerima kunjungan.
                </p>
            </div>

        @else

            <div class="overflow-x-auto">
                <table class="w-full min-w-[680px] text-left">

                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-5 py-3 text-[10px] text-slate-400 uppercase tracking-wider">Page Path</th>
                            <th class="px-5 py-3 text-[10px] text-slate-400 uppercase tracking-wider">Page Views</th>
                            <th class="px-5 py-3 text-[10px] text-slate-400 uppercase tracking-wider">Unique Views</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @foreach($topPages as $page)

                            <tr class="hover:bg-slate-50 transition">

                                <td class="px-5 py-4">
                                    <span class="text-sm font-medium text-slate-700">
                                        {{ $page['path'] }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 text-sm text-slate-600">
                                    {{ number_format($page['views']) }}
                                </td>

                                <td class="px-5 py-4 text-sm text-slate-600">
                                    {{ number_format($page['unique']) }}
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