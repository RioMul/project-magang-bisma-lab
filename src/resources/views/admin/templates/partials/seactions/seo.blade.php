@php
    $seo = $templateData['seo'] ?? [];
@endphp

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">

    <div class="mb-6">
        <span class="text-[10px] font-bold uppercase tracking-widest text-[#0369a1]">
            SEO
        </span>

        <h2 class="mt-1 text-xl font-bold text-slate-900">
            Search Engine Optimization
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Atur informasi SEO untuk membantu mesin pencari memahami website.
        </p>
    </div>

    <div class="space-y-5">

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                SEO Title
            </label>

            <input
                type="text"
                name="seo[title]"
                value="{{ old('seo.title', $seo['title'] ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"
            >
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                SEO Description
            </label>

            <textarea
                name="seo[description]"
                rows="4"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"
            >{{ old('seo.description', $seo['description'] ?? '') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Keywords
            </label>

            <textarea
                name="seo[keywords]"
                rows="3"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"
            >{{ old('seo.keywords', $seo['keywords'] ?? '') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Open Graph Image
            </label>

            <input
                type="text"
                name="seo[og_image]"
                value="{{ old('seo.og_image', $seo['og_image'] ?? '') }}"
                placeholder="tech1.png"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"
            >
        </div>

    </div>

</div>