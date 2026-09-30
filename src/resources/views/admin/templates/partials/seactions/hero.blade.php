@php
    $body = $templateData['body'] ?? [];
@endphp

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">

    <div class="mb-6">
        <span class="text-[10px] font-bold uppercase tracking-widest text-[#0369a1]">
            Hero
        </span>

        <h2 class="mt-1 text-xl font-bold text-slate-900">
            Hero Section
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Atur konten utama yang pertama kali dilihat pengunjung.
        </p>
    </div>

    <div class="space-y-5">

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Hero Title
            </label>

            <input
                type="text"
                name="body[hero_title]"
                value="{{ old('body.hero_title', $body['hero_title'] ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:border-[#0369a1] focus:ring-2 focus:ring-sky-100 outline-none"
            >
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Hero Highlight
            </label>

            <input
                type="text"
                name="body[hero_highlight]"
                value="{{ old('body.hero_highlight', $body['hero_highlight'] ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:border-[#0369a1] focus:ring-2 focus:ring-sky-100 outline-none"
            >

            <p class="mt-1.5 text-[11px] text-slate-400">
                Teks yang ingin ditonjolkan pada hero.
            </p>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Hero Description
            </label>

            <textarea
                name="body[hero_description]"
                rows="4"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:border-[#0369a1] focus:ring-2 focus:ring-sky-100 outline-none"
            >{{ old('body.hero_description', $body['hero_description'] ?? '') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-2">
                    Button Text
                </label>

                <input
                    type="text"
                    name="body[button_text]"
                    value="{{ old('body.button_text', $body['button_text'] ?? '') }}"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:border-[#0369a1] focus:ring-2 focus:ring-sky-100 outline-none"
                >
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-2">
                    Hero Image
                </label>

                <input
                    type="text"
                    name="body[hero_image]"
                    value="{{ old('body.hero_image', $body['hero_image'] ?? '') }}"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:border-[#0369a1] focus:ring-2 focus:ring-sky-100 outline-none"
                >

                <p class="mt-1.5 text-[11px] text-slate-400">
                    Contoh: tech1.png
                </p>
            </div>

        </div>

        <div class="border-t border-slate-100 pt-6">

            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Promo Title
            </label>

            <input
                type="text"
                name="body[promo_title]"
                value="{{ old('body.promo_title', $body['promo_title'] ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"
            >

        </div>

        <div>

            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Promo Description
            </label>

            <textarea
                name="body[promo_description]"
                rows="3"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"
            >{{ old('body.promo_description', $body['promo_description'] ?? '') }}</textarea>

        </div>

        <div>

            <label class="block text-xs font-semibold text-slate-600 mb-3">
                Categories
            </label>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                @foreach(($body['categories'] ?? []) as $index => $category)

                    <input
                        type="text"
                        name="body[categories][{{ $index }}]"
                        value="{{ old("body.categories.$index", $category) }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm"
                    >

                @endforeach

            </div>

        </div>

    </div>

</div>