{{-- DOMAIN FORMS --}}
<div class="mb-8">
    <h2 class="text-xl font-bold text-slate-800 tracking-tight">Domain Settings</h2>
    <p class="text-[11px] text-slate-500 mt-2 leading-relaxed">
        Configure your main domain and connection status.
    </p>
</div>
<div class="space-y-6">
    <div>
        <label class="block text-[11px] font-bold text-slate-500 mb-2">Domain Name</label>
        <input type="text" name="domain_name" value="{{ old('domain_name', $website['domain']['name']) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-700 outline-none focus:border-[#0369a1] focus:ring-2 focus:ring-sky-50 transition shadow-sm">
    </div>
    <div>
        <label class="block text-[11px] font-bold text-slate-500 mb-2">Domain Status</label>
        <input type="text" name="domain_status" value="{{ old('domain_status', $website['domain']['status']) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-700 outline-none focus:border-[#0369a1] focus:ring-2 focus:ring-sky-50 transition shadow-sm">
    </div>
</div>