@php
    $footer = $templateData['footer'] ?? [];
    $links = $footer['links'] ?? [];
@endphp

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">

    <div class="mb-6">
        <span class="text-[10px] font-bold uppercase tracking-widest text-[#0369a1]">
            Footer
        </span>

        <h2 class="mt-1 text-xl font-bold text-slate-900">
            Footer Information
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Atur informasi yang tampil pada bagian footer website.
        </p>
    </div>

    <div>

        <label class="block text-xs font-semibold text-slate-600 mb-2">
            Description
        </label>

        <textarea
            name="footer[description]"
            rows="4"
            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"
        >{{ old('footer.description', $footer['description'] ?? '') }}</textarea>

    </div>

    <div class="mt-5">

        <label class="block text-xs font-semibold text-slate-600 mb-3">
            Footer Links
        </label>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

            @foreach($links as $index => $link)

                <input
                    type="text"
                    name="footer[links][{{ $index }}]"
                    value="{{ old("footer.links.$index", $link) }}"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm"
                >

            @endforeach

            @if(empty($links))

                <input
                    type="text"
                    name="footer[links][0]"
                    placeholder="Tentang Kami"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm"
                >

            @endif

        </div>

    </div>

    <div class="mt-5">

        <label class="block text-xs font-semibold text-slate-600 mb-2">
            Copyright
        </label>

        <input
            type="text"
            name="footer[copyright]"
            value="{{ old('footer.copyright', $footer['copyright'] ?? '') }}"
            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"
        >

    </div>

</div>