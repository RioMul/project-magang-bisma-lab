<div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden mb-6">
    <div class="px-6 py-5 flex items-center justify-between border-b border-slate-50">
        <div>
            <h2 class="text-sm font-bold text-slate-800">Top Performing Content</h2>
            <p class="text-[10px] text-slate-400 mt-1">Pages driving the highest engagement.</p>
        </div>
        <div class="flex gap-2">
            <button class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] font-bold text-slate-600 hover:bg-slate-50 transition shadow-sm flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg> Filter
            </button>
            <button class="px-3 py-1.5 bg-[#0369a1] hover:bg-[#075985] text-white rounded-lg text-[10px] font-bold transition shadow-sm flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg> Export
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-[9px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100 bg-white">
                    <th class="px-6 py-4">Page Path</th>
                    <th class="px-6 py-4 text-right">Pageviews</th>
                    <th class="px-6 py-4 text-right">Unique Views</th>
                    <th class="px-6 py-4 text-right">Avg. Time</th>
                    <th class="px-6 py-4 text-center">Trend</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($topContent as $content)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2.5">
                            <div class="w-6 h-6 rounded-md bg-sky-50 flex items-center justify-center text-[#0369a1] shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            </div>
                            <span class="text-xs font-bold text-slate-700">{{ $content->page_path ?: '/' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right text-xs font-semibold text-slate-600">{{ number_format($content->pageviews) }}</td>
                    <td class="px-6 py-4 text-right text-xs font-semibold text-slate-600">{{ number_format(round($content->pageviews * 0.75)) }}</td>
                    <td class="px-6 py-4 text-right text-xs font-semibold text-slate-600">2m 14s</td>
                    <td class="px-6 py-4 text-center">
                        @if($loop->index % 2 == 0)
                            <svg class="w-4 h-4 text-emerald-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        @else
                            <svg class="w-4 h-4 text-rose-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"/></svg>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-xs font-medium text-slate-400">Belum ada data visitor.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between text-[9px] font-bold text-slate-400 uppercase tracking-widest bg-slate-50/50 rounded-b-xl">
        <span>Showing {{ $topContent->count() }} of 1,244 Pages</span>
        <div class="flex gap-1.5">
            <button class="w-7 h-7 rounded-md bg-white border border-slate-200 flex items-center justify-center hover:bg-slate-50 shadow-sm text-slate-600"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg></button>
            <button class="w-7 h-7 rounded-md bg-white border border-slate-200 flex items-center justify-center hover:bg-slate-50 shadow-sm text-slate-600"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></button>
        </div>
    </div>
</div>