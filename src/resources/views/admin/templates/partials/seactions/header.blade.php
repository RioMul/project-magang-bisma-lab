@php
    $header = $templateData['header'] ?? [];
    $menu = $header['menu'] ?? [];
@endphp

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">

    <div class="mb-6">
        <span class="text-[10px] font-bold uppercase tracking-widest text-[#0369a1]">
            Header
        </span>

        <h2 class="mt-1 text-xl font-bold text-slate-900">
            Header & Navigation
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Atur identitas dan menu navigasi website.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Site Name
            </label>

            <input
                type="text"
                name="header[site_name]"
                value="{{ old('header.site_name', $header['site_name'] ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:border-[#0369a1] focus:ring-2 focus:ring-sky-100 outline-none"
            >
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Logo Text
            </label>

            <input
                type="text"
                name="header[logo_text]"
                value="{{ old('header.logo_text', $header['logo_text'] ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:border-[#0369a1] focus:ring-2 focus:ring-sky-100 outline-none"
            >
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Badge
            </label>

            <input
                type="text"
                name="header[badge]"
                value="{{ old('header.badge', $header['badge'] ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:border-[#0369a1] focus:ring-2 focus:ring-sky-100 outline-none"
            >
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Button Text
            </label>

            <input
                type="text"
                name="header[button_text]"
                value="{{ old('header.button_text', $header['button_text'] ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:border-[#0369a1] focus:ring-2 focus:ring-sky-100 outline-none"
            >
        </div>

    </div>

    <div class="mt-6">

        <div class="flex items-center justify-between mb-3">

            <div>
                <label class="block text-xs font-semibold text-slate-600">
                    Navigation Menu
                </label>

                <p class="text-[11px] text-slate-400 mt-1">
                    Maksimal menyesuaikan kebutuhan template.
                </p>
            </div>

        </div>

        <div class="space-y-3">

            @foreach($menu as $index => $item)

                <div class="flex items-center gap-3">

                    <span class="w-8 h-10 rounded-lg bg-slate-50 flex items-center justify-center text-xs font-semibold text-slate-400">
                        {{ $index + 1 }}
                    </span>

                    <input
                        type="text"
                        name="header[menu][{{ $index }}]"
                        value="{{ old("header.menu.$index", $item) }}"
                        class="flex-1 px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-[#0369a1] focus:ring-2 focus:ring-sky-100 outline-none"
                    >

                </div>

            @endforeach

            @if(empty($menu))

                <input
                    type="text"
                    name="header[menu][0]"
                    placeholder="Home"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm"
                >

            @endif

        </div>

    </div>

</div>