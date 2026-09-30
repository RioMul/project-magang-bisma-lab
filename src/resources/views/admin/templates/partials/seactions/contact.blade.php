@php
    $sidebar = $templateData['sidebar'] ?? [];
@endphp

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">

    <div class="mb-6">
        <span class="text-[10px] font-bold uppercase tracking-widest text-[#0369a1]">
            Contact
        </span>

        <h2 class="mt-1 text-xl font-bold text-slate-900">
            Contact Information
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Atur informasi kontak dan sosial media.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Phone
            </label>

            <input
                type="text"
                name="sidebar[phone]"
                value="{{ old('sidebar.phone', $sidebar['phone'] ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"
            >
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Address
            </label>

            <input
                type="text"
                name="sidebar[address]"
                value="{{ old('sidebar.address', $sidebar['address'] ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"
            >
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                WhatsApp Number
            </label>

            <input
                type="text"
                name="sidebar[whatsapp]"
                value="{{ old('sidebar.whatsapp', $sidebar['whatsapp'] ?? '') }}"
                placeholder="6281234567890"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"
            >
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Instagram
            </label>

            <input
                type="text"
                name="sidebar[social_instagram]"
                value="{{ old('sidebar.social_instagram', $sidebar['social_instagram'] ?? '') }}"
                placeholder="@username"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"
            >
        </div>

    </div>

    <div class="mt-5">

        <label class="block text-xs font-semibold text-slate-600 mb-2">
            WhatsApp Message
        </label>

        <textarea
            name="sidebar[whatsapp_message]"
            rows="4"
            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"
        >{{ old('sidebar.whatsapp_message', $sidebar['whatsapp_message'] ?? '') }}</textarea>

    </div>

</div>