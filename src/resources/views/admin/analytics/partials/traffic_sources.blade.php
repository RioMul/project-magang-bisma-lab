<div class="bg-white rounded-xl border border-slate-100 p-6 shadow-sm">
    <h2 class="text-sm font-bold text-slate-800 mb-5">Traffic Sources</h2>
    
    <div class="space-y-4">
        @foreach(collect($trafficSources)->take(3) as $source)
        <div>
            <div class="flex justify-between items-end mb-1.5">
                <span class="text-[10px] font-bold text-slate-600">{{ $source['name'] }}</span>
                <span class="text-[10px] font-black text-slate-800">{{ $source['percentage'] }}%</span>
            </div>
            <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-[#0369a1] rounded-full" style="width: {{ $source['percentage'] }}%"></div>
            </div>
        </div>
        @endforeach
    </div>
</div>