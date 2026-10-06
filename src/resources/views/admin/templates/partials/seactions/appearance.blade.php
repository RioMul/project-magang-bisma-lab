@php
    $style = $templateData['style'] ?? [];
@endphp

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">

    <div class="mb-6">
        <span class="text-[10px] font-bold uppercase tracking-widest text-[#0369a1]">
            Appearance
        </span>

        <h2 class="mt-1 text-xl font-bold text-slate-900">
            Colors & Appearance
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Atur warna utama yang digunakan oleh template.
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

       <div>

    <label class="block text-xs font-semibold text-slate-600 mb-2">
        Primary Color
    </label>

    <div class="flex gap-3">

        <input
            type="color"
            value="{{ $style['primary'] ?? '#0369a1' }}"
            class="w-12 h-12 rounded-xl border border-slate-200 p-1 bg-white cursor-pointer"
            oninput="this.nextElementSibling.value = this.value"
        >
        <input
            type="text"
            name="style[primary]"
            value="{{ old('style.primary', $style['primary'] ?? '#0369a1') }}"
            class="flex-1 px-4 py-3 rounded-xl border border-slate-200 text-sm"
        >
    </div>
</div>

        <div>

            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Secondary Color
            </label>

            <div class="flex gap-3">

                <input
                    type="color"
                    value="{{ $style['secondary'] ?? '#f1f5f9' }}"
                    class="w-12 h-12 rounded-xl border border-slate-200 p-1 bg-white cursor-pointer"
                    oninput="this.nextElementSibling.value = this.value"
                >

                <input
                    type="text"
                    name="style[secondary]"
                    value="{{ old('style.secondary', $style['secondary'] ?? '#f1f5f9') }}"
                    class="flex-1 px-4 py-3 rounded-xl border border-slate-200 text-sm"
                >

            </div>

        </div>

        <div>

            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Background Color
            </label>

            <div class="flex gap-3">

                <input
                    type="color"
                    value="{{ $style['background'] ?? '#f5f5f5' }}"
                    class="w-12 h-12 rounded-xl border border-slate-200 p-1 bg-white cursor-pointer"
                    oninput="this.nextElementSibling.value = this.value"
                >

                <input
                    type="text"
                    name="style[background]"
                    value="{{ old('style.background', $style['background'] ?? '#f5f5f5') }}"
                    class="flex-1 px-4 py-3 rounded-xl border border-slate-200 text-sm"
                >

            </div>

        </div>

        <div>

            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Text Color
            </label>

            <div class="flex gap-3">

                <input
                    type="color"
                    value="{{ $style['text'] ?? '#1e293b' }}"
                    class="w-12 h-12 rounded-xl border border-slate-200 p-1 bg-white cursor-pointer"
                    oninput="this.nextElementSibling.value = this.value"
                >

                <input
                    type="text"
                    name="style[text]"
                    value="{{ old('style.text', $style['text'] ?? '#1e293b') }}"
                    class="flex-1 px-4 py-3 rounded-xl border border-slate-200 text-sm"
                >

            </div>

        </div>

    </div>

</div>