@extends('layouts.admin')

@section('title', 'Analytics | Admin Panel')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col gap-4 xl:flex-row xl:items-end xl:justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-800">
                Visitor Analytics
            </h1>

            <p class="mt-1 text-xs text-slate-500">
                Monitoring audience growth and engagement patterns.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <button class="rounded-lg bg-sky-600 px-3 py-2 text-[10px] font-semibold text-white">
                Last 30 Days
            </button>

            <button class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-[10px] text-slate-600">
                Last Quarter
            </button>

            <button class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-[10px] text-slate-600">
                Custom
            </button>

            <div class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-[10px] text-slate-500">
                {{ now()->subDays(29)->format('M d') }} - {{ now()->format('M d, Y') }}
            </div>
        </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <div class="rounded-xl border border-slate-100 bg-white p-5 shadow-sm">
            <div class="mb-4 flex items-start justify-between">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-sky-50 text-sky-600">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="8" r="3"/>
                        <path stroke-linecap="round" d="M5 20a7 7 0 0114 0"/>
                    </svg>
                </div>

                <span class="rounded-full bg-emerald-50 px-2 py-1 text-[8px] font-semibold text-emerald-600">
                    Visitors
                </span>
            </div>

            <p class="text-[10px] text-slate-400">
                Total Visitors
            </p>

            <p class="mt-1 text-xl font-bold text-slate-800">
                {{ number_format($totalVisitors) }}
            </p>
        </div>

        <div class="rounded-xl border border-slate-100 bg-white p-5 shadow-sm">
            <div class="mb-4 flex items-start justify-between">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-50 text-slate-600">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="12" r="8"/>
                        <path stroke-linecap="round" d="M12 8v4l2.5 2"/>
                    </svg>
                </div>

                <span class="rounded-full bg-emerald-50 px-2 py-1 text-[8px] font-semibold text-emerald-600">
                    Unique
                </span>
            </div>

            <p class="text-[10px] text-slate-400">
                Unique Visitors
            </p>

            <p class="mt-1 text-xl font-bold text-slate-800">
                {{ number_format($uniqueVisitors) }}
            </p>
        </div>

        <div class="rounded-xl border border-slate-100 bg-white p-5 shadow-sm">
            <div class="mb-4 flex items-start justify-between">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <rect x="4" y="5" width="16" height="14" rx="2"/>
                        <path stroke-linecap="round" d="M8 9h8M8 13h5"/>
                    </svg>
                </div>

                <span class="rounded-full bg-emerald-50 px-2 py-1 text-[8px] font-semibold text-emerald-600">
                    Active
                </span>
            </div>

            <p class="text-[10px] text-slate-400">
                Active Websites
            </p>

            <p class="mt-1 text-xl font-bold text-slate-800">
                {{ number_format($activeWebsites) }}
            </p>
        </div>

        <div class="rounded-xl border border-slate-100 bg-white p-5 shadow-sm">
            <div class="mb-4 flex items-start justify-between">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-sky-50 text-sky-600">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <rect x="3" y="5" width="18" height="14" rx="2"/>
                        <path stroke-linecap="round" d="M3 10h18"/>
                    </svg>
                </div>

                <span class="rounded-full bg-emerald-50 px-2 py-1 text-[8px] font-semibold text-emerald-600">
                    Paid
                </span>
            </div>

            <p class="text-[10px] text-slate-400">
                Revenue
            </p>

            <p class="mt-1 text-xl font-bold text-slate-800">
                Rp {{ number_format($revenue, 0, ',', '.') }}
            </p>
        </div>

    </div>

    <div class="grid gap-5 xl:grid-cols-[1.8fr_1fr]">

        <div class="rounded-xl border border-slate-100 bg-white p-5 shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <h2 class="text-sm font-bold text-slate-800">
                        Visitors Over Time
                    </h2>

                    <p class="mt-1 text-[10px] text-slate-400">
                        Traffic volume across selected period
                    </p>
                </div>

                <div class="flex items-center gap-4 text-[9px] text-slate-500">
                    <span class="flex items-center gap-1">
                        <span class="h-2 w-2 rounded-full bg-sky-600"></span>
                        Active
                    </span>

                    <span class="flex items-center gap-1">
                        <span class="h-2 w-2 rounded-full bg-sky-200"></span>
                        Previous
                    </span>
                </div>
            </div>

            <div class="relative mt-6 h-72 rounded-lg bg-slate-50 p-5">

                <div class="absolute inset-x-5 top-12 border-t border-slate-200"></div>
                <div class="absolute inset-x-5 top-28 border-t border-slate-200"></div>
                <div class="absolute inset-x-5 top-44 border-t border-slate-200"></div>
                <div class="absolute inset-x-5 bottom-12 border-t border-slate-200"></div>

                <svg
                    class="absolute inset-5 h-[calc(100%-2.5rem)] w-[calc(100%-2.5rem)]"
                    viewBox="0 0 800 280"
                    preserveAspectRatio="none"
                >
                    @php
                        $values = $visitorData->pluck('value')->toArray();
                        $maxValue = max($values ?: [1]);
                        $count = count($values);
                        $points = [];

                        foreach ($values as $index => $value) {
                            $x = $count > 1
                                ? ($index / ($count - 1)) * 780 + 10
                                : 400;

                            $y = 240 - (($value / max($maxValue, 1)) * 200);

                            $points[] = round($x, 2) . ',' . round($y, 2);
                        }

                        $polyline = implode(' ', $points);

                        $areaPoints = '10,240 ' . $polyline . ' 790,240';
                    @endphp

                    <polygon
                        points="{{ $areaPoints }}"
                        fill="currentColor"
                        class="text-sky-100"
                        opacity="0.7"
                    />

                    <polyline
                        points="{{ $polyline }}"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="4"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="text-sky-600"
                    />
                </svg>

                <div class="absolute bottom-2 left-5 right-5 flex justify-between text-[8px] text-slate-400">
                    @foreach($visitorData->take(6) as $data)
                        <span>{{ $data['label'] }}</span>
                    @endforeach

                    <span>{{ $visitorData->last()['label'] ?? now()->format('d M') }}</span>
                </div>
            </div>
        </div>

        <div class="space-y-5">

            <div class="rounded-xl border border-slate-100 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">
                            Device Breakdown
                        </h2>

                        <p class="mt-1 text-[10px] text-slate-400">
                            Visitor device distribution
                        </p>
                    </div>
                </div>

                <div class="flex justify-center py-6">
                    <div class="relative flex h-32 w-32 items-center justify-center rounded-full border-[10px] border-sky-100">
                        <div class="absolute inset-0 rounded-full border-[10px] border-sky-600 border-b-transparent border-l-transparent"></div>

                        <div class="text-center">
                            <div class="text-xl font-bold text-slate-700">
                                64%
                            </div>

                            <div class="text-[8px] uppercase tracking-wide text-slate-400">
                                Mobile
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-3 text-[9px]">
                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-2 text-slate-500">
                            <span class="h-2 w-2 rounded-full bg-sky-600"></span>
                            Mobile
                        </span>

                        <span class="font-medium text-slate-700">
                            64%
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-2 text-slate-500">
                            <span class="h-2 w-2 rounded-full bg-sky-200"></span>
                            Desktop
                        </span>

                        <span class="font-medium text-slate-700">
                            36%
                        </span>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-slate-100 bg-white p-5 shadow-sm">
                <h2 class="text-sm font-bold text-slate-800">
                    Traffic Sources
                </h2>

                <div class="mt-5 space-y-4">

                    <div>
                        <div class="mb-1 flex justify-between text-[9px]">
                            <span class="text-slate-500">Organic Search</span>
                            <span class="font-semibold text-slate-600">45%</span>
                        </div>

                        <div class="h-1.5 rounded-full bg-slate-100">
                            <div class="h-1.5 w-[45%] rounded-full bg-sky-600"></div>
                        </div>
                    </div>

                    <div>
                        <div class="mb-1 flex justify-between text-[9px]">
                            <span class="text-slate-500">Direct Traffic</span>
                            <span class="font-semibold text-slate-600">32%</span>
                        </div>

                        <div class="h-1.5 rounded-full bg-slate-100">
                            <div class="h-1.5 w-[32%] rounded-full bg-sky-400"></div>
                        </div>
                    </div>

                    <div>
                        <div class="mb-1 flex justify-between text-[9px]">
                            <span class="text-slate-500">Social Referral</span>
                            <span class="font-semibold text-slate-600">23%</span>
                        </div>

                        <div class="h-1.5 rounded-full bg-slate-100">
                            <div class="h-1.5 w-[23%] rounded-full bg-slate-300"></div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="rounded-xl border border-slate-100 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
            <div>
                <h2 class="text-sm font-bold text-slate-800">
                    Top Performing Content
                </h2>

                <p class="mt-1 text-[10px] text-slate-400">
                    Pages driving the highest engagement
                </p>
            </div>

            <div class="flex gap-2">
                <button class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-[9px] text-slate-600">
                    Filter
                </button>

                <button class="rounded-lg bg-sky-600 px-3 py-2 text-[9px] font-semibold text-white">
                    Export Report
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[700px]">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50">
                        <th class="px-5 py-3 text-left text-[8px] font-semibold uppercase tracking-wide text-slate-400">
                            Page Path
                        </th>

                        <th class="px-5 py-3 text-right text-[8px] font-semibold uppercase tracking-wide text-slate-400">
                            Pageviews
                        </th>

                        <th class="px-5 py-3 text-right text-[8px] font-semibold uppercase tracking-wide text-slate-400">
                            Unique Views
                        </th>

                        <th class="px-5 py-3 text-right text-[8px] font-semibold uppercase tracking-wide text-slate-400">
                            Avg. Time
                        </th>

                        <th class="px-5 py-3 text-right text-[8px] font-semibold uppercase tracking-wide text-slate-400">
                            Trend
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $contentRows = [
                            ['/homepage-digital-atelier', '42,910', '31,055', '2m 14s', 'up'],
                            ['/pricing-plans', '28,334', '20,119', '1m 45s', 'up'],
                            ['/blog/top-10-ux-tips', '15,702', '12,440', '4m 52s', 'down'],
                            ['/features/analytics-dashboard', '12,046', '9,870', '3m 08s', 'stable'],
                        ];
                    @endphp

                    @foreach($contentRows as $row)
                        <tr class="border-b border-slate-100 last:border-0">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3 text-[10px] font-medium text-slate-700">
                                    <span class="flex h-7 w-7 items-center justify-center rounded-md bg-slate-50">
                                        <svg class="h-3 w-3 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" d="M6 4h12v16H6z"/>
                                            <path stroke-linecap="round" d="M9 8h6M9 12h6"/>
                                        </svg>
                                    </span>

                                    {{ $row[0] }}
                                </div>
                            </td>

                            <td class="px-5 py-4 text-right text-[9px] text-slate-600">
                                {{ $row[1] }}
                            </td>

                            <td class="px-5 py-4 text-right text-[9px] text-slate-600">
                                {{ $row[2] }}
                            </td>

                            <td class="px-5 py-4 text-right text-[9px] text-slate-600">
                                {{ $row[3] }}
                            </td>

                            <td class="px-5 py-4 text-right">
                                @if($row[4] === 'up')
                                    <span class="text-emerald-500">↗</span>
                                @elseif($row[4] === 'down')
                                    <span class="text-red-400">↘</span>
                                @else
                                    <span class="text-slate-400">→</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-100 px-5 py-3 text-[8px] uppercase tracking-wide text-slate-400">
            Analytics overview based on available visitor data
        </div>
    </div>

</div>
@endsection