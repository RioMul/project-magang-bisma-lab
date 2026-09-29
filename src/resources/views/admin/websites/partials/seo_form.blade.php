{{-- SEO FORMS --}}
<div class="mb-8">
    <h2 class="text-xl font-bold text-slate-800 tracking-tight">SEO Settings</h2>
    <p class="text-[11px] text-slate-500 mt-2 leading-relaxed">
        Configure your search engine optimization parameters.
    </p>
</div>
<div class="space-y-6">
    <div>
        <label class="block text-[11px] font-bold text-slate-500 mb-2">SEO Title</label>
        <input type="text" name="seo_title" value="{{ old('seo_title', $website['seo']['title']) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-700 outline-none focus:border-[#0369a1] focus:ring-2 focus:ring-sky-50 transition shadow-sm">
    </div>
    <div>
        <label class="block text-[11px] font-bold text-slate-500 mb-2">SEO Description</label>
        <textarea name="seo_description" rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-xs font-medium text-slate-600 outline-none focus:border-[#0369a1] focus:ring-2 focus:ring-sky-50 transition shadow-sm resize-none">{{ old('seo_description', $website['seo']['description']) }}</textarea>
    </div>
    <div>
        <label class="block text-[11px] font-bold text-slate-500 mb-2">SEO Keywords</label>
        <input type="text" name="seo_keywords" value="{{ old('seo_keywords', $website['seo']['keywords']) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-700 outline-none focus:border-[#0369a1] focus:ring-2 focus:ring-sky-50 transition shadow-sm">
    </div>
    <div>
        <label class="block text-[11px] font-bold text-slate-500 mb-2">OG Image Path</label>
        <input type="text" name="og_image" value="{{ old('og_image', $website['seo']['og_image']) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-700 outline-none focus:border-[#0369a1] focus:ring-2 focus:ring-sky-50 transition shadow-sm">
    </div>
</div>