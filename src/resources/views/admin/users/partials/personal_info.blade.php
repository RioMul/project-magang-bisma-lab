<div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm flex flex-col h-full">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-[11px] font-bold uppercase tracking-widest text-[#0369a1]">
            Personal Info
        </h2>
        <svg class="h-5 w-5 text-[#0369a1]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
        </svg>
    </div>
    <div class="space-y-4">
        <div>
            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Full Name</p>
            <p class="text-sm font-semibold text-slate-800">{{ $user->name }}</p>
        </div>
        <div>
            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Email</p>
            <p class="break-all text-sm font-semibold text-slate-800">{{ $user->email }}</p>
        </div>
        <div>
            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Registered</p>
            <p class="text-sm font-semibold text-slate-800">{{ $user->created_at->format('d M Y') }}</p>
        </div>
        <div>
            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">User ID</p>
            <p class="text-sm font-semibold text-slate-800">#{{ $user->id }}</p>
        </div>
    </div>
</div>