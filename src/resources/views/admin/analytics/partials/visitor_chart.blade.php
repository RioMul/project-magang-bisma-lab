@php
    $values = collect($visitorData)->pluck('value')->toArray();
    $maxValue = max(empty($values) ? [1] : $values);
    $count = count($values);
    $points = [];
    foreach ($values as $index => $value) {
        $x = $count > 1 ? ($index / ($count - 1)) * 960 + 20 : 500;
        $y = 260 - (($value / max($maxValue, 1)) * 200);
        $points[] = round($x, 2) . ',' . round($y, 2);
    }
    $polyline = implode(' ', $points);
@endphp

<div class="xl:col-span-2 bg-white rounded-xl border border-slate-100 p-6 shadow-sm flex flex-col relative overflow-hidden">
    <div class="flex items-start justify-between relative z-10 mb-6">
        <div>
            <h2 class="text-sm font-bold text-slate-800">Visitors Over Time</h2>
            <p class="text-[10px] text-slate-400 mt-1">Traffic volume across selected period</p>
        </div>
        <div class="flex items-center gap-3 text-[10px] font-bold text-slate-500">
            <div class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-[#0369a1]"></span> Active</div>
            <div class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-sky-300"></span> Previous</div>
        </div>
    </div>

    <div class="flex-1 relative w-full mt-2 min-h-[180px] flex items-end">
        <div class="absolute inset-0 flex flex-col justify-between pointer-events-none pb-5">
            <div class="w-full h-px bg-slate-50"></div>
            <div class="w-full h-px bg-slate-50"></div>
            <div class="w-full h-px bg-slate-50"></div>
            <div class="w-full h-px bg-slate-100"></div>
        </div>
        
        <svg class="w-full h-[160px] relative z-10 mb-5" preserveAspectRatio="none" viewBox="0 0 1000 300">
            <path d="M0,280 C100,260 150,230 250,230 C350,230 400,250 500,250 C600,250 650,150 750,150 C850,150 900,240 1000,240" fill="none" stroke="#7dd3fc" stroke-width="6" stroke-dasharray="12 12" stroke-linecap="round" stroke-linejoin="round" />
            <polyline points="{{ $polyline }}" fill="none" stroke="#0369a1" stroke-width="7" stroke-linejoin="round" stroke-linecap="round" />
        </svg>

        <div class="absolute bottom-0 inset-x-0 flex justify-between text-[8px] font-bold text-slate-400 uppercase tracking-wider">
            @foreach(collect($visitorData)->take(5) as $data)
                <span>{{ $data['label'] }}</span>
            @endforeach
        </div>
    </div>
</div>