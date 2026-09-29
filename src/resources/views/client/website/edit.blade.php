<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $website['header']['site_name'] ?? 'Website Editor' }}
        | Bisma Labs
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        [x-cloak] {
            display: none !important;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 5px;
        }
    </style>

</head>

<body
    class="bg-white text-slate-800 antialiased h-screen flex flex-col overflow-hidden"
    x-data="websiteEditor()"
>

<header class="h-[68px] bg-white border-b border-slate-200 flex items-center justify-between px-5 lg:px-8 shrink-0 z-30">

    <div class="flex items-center gap-8 h-full min-w-0">

        <a
            href="{{ route('dashboard') }}"
            class="font-extrabold text-slate-900 text-lg whitespace-nowrap"
        >
            Bisma Labs
        </a>

        <nav class="hidden md:flex items-center gap-7 h-full">

            <button
                type="button"
                @click="activeTab = 'editor'"
                :class="activeTab === 'editor'
                    ? 'text-[#0369a1] border-b-2 border-[#0369a1]'
                    : 'text-slate-400 hover:text-slate-700'"
                class="h-full text-xs font-bold transition"
            >
                Editor
            </button>

            <button
                type="button"
                @click="activeTab = 'seo'"
                :class="activeTab === 'seo'
                    ? 'text-[#0369a1] border-b-2 border-[#0369a1]'
                    : 'text-slate-400 hover:text-slate-700'"
                class="h-full text-xs font-bold transition"
            >
                SEO
            </button>

            <button
                type="button"
                @click="activeTab = 'domain'"
                :class="activeTab === 'domain'
                    ? 'text-[#0369a1] border-b-2 border-[#0369a1]'
                    : 'text-slate-400 hover:text-slate-700'"
                class="h-full text-xs font-bold transition"
            >
                Domain
            </button>

        </nav>

    </div>

    <div class="flex items-center gap-2 sm:gap-5">

        <a
            href="{{ route('client.website.preview') }}"
            target="_blank"
            class="hidden sm:block text-xs font-bold text-slate-500 hover:text-slate-900 transition"
        >
            Preview Website
        </a>

        <button
            type="submit"
            form="website-editor-form"
            class="px-5 sm:px-7 py-2.5 rounded-xl bg-[#0369a1] hover:bg-[#075985] text-white text-xs font-bold transition"
        >
            Save
        </button>

    </div>

</header>

<main class="flex-1 flex overflow-hidden">

    <aside class="hidden md:flex w-56 bg-white border-r border-slate-100 flex-col justify-between py-7 px-4 shrink-0">

        <div>

            <div class="px-2 mb-7">

                <h2 class="text-sm font-bold text-slate-800">
                    Atelier Editor
                </h2>

                <p class="text-[10px] text-slate-400 mt-1">
                    {{ $website['header']['site_name'] ?? 'Site Settings' }}
                </p>

            </div>

            <nav
                class="space-y-1"
                x-show="activeTab === 'editor'"
                x-cloak
            >

                @foreach([
                    'header' => 'Header',
                    'body' => 'Body',
                    'sidebar' => 'Sidebar',
                    'footer' => 'Footer'
                ] as $key => $label)

                    <button
                        type="button"
                        @click="activeSection = '{{ $key }}'"
                        :class="activeSection === '{{ $key }}'
                            ? 'bg-sky-50 text-[#0369a1] border border-sky-100'
                            : 'text-slate-500 hover:bg-slate-50 border border-transparent'"
                        class="w-full text-left px-4 py-2.5 rounded-xl text-xs font-bold transition"
                    >
                        {{ $label }}
                    </button>

                @endforeach

            </nav>

        </div>

        <div class="space-y-3">

            <a
                href="{{ route('dashboard') }}"
                class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-[#0369a1] hover:bg-[#075985] text-white text-xs font-bold transition"
            >

                <svg
                    class="w-3.5 h-3.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2.5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                    />
                </svg>

                Kembali

            </a>

            <div class="flex justify-center">

                <button
                    type="button"
                    class="w-9 h-9 rounded-full border border-slate-200 flex items-center justify-center text-slate-500"
                >
                    ?

                </button>

            </div>

        </div>

    </aside>

    <div class="md:hidden absolute top-[82px] left-3 z-20">

        <select
            x-model="activeSection"
            class="bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs font-bold shadow-sm"
        >
            <option value="header">Header</option>
            <option value="body">Body</option>
            <option value="sidebar">Sidebar</option>
            <option value="footer">Footer</option>
        </select>

    </div>

    <div class="w-full lg:w-[430px] bg-slate-50 border-r border-slate-100 overflow-y-auto custom-scrollbar shrink-0">

        <form
            id="website-editor-form"
            method="POST"
            action="{{ route('client.website.update') }}"
            enctype="multipart/form-data"
            class="p-5 sm:p-7 lg:p-8"
        >

            @csrf
            @method('PUT')

            <input
                type="hidden"
                name="tab"
                :value="activeTab"
            >

            <input
                type="hidden"
                name="section"
                :value="activeSection"
            >

            @if(session('success'))

                <div class="mb-5 rounded-xl bg-emerald-50 border border-emerald-100 px-4 py-3 text-xs font-semibold text-emerald-700">
                    {{ session('success') }}
                </div>

            @endif

            @if($errors->any())

                <div class="mb-5 rounded-xl bg-red-50 border border-red-100 px-4 py-3 text-xs text-red-600">

                    @foreach($errors->all() as $error)

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif

            <div
                x-show="activeTab === 'editor' && activeSection === 'header'"
                x-cloak
            >

                <h2 class="text-xl font-bold text-slate-800">
                    Header Settings
                </h2>

                <p class="text-[11px] text-slate-500 mt-2 leading-relaxed">
                    Atur identitas dan navigasi utama website.
                </p>

                <div class="space-y-5 mt-7">

                    <div>

                        <label class="field-label">
                            Business Name
                        </label>

                        <input
                            type="text"
                            name="site_name"
                            value="{{ old('site_name', $website['header']['site_name'] ?? '') }}"
                            class="field-input"
                        >

                    </div>

                    <div>

                        <label class="field-label">
                            Logo Text
                        </label>

                        <input
                            type="text"
                            name="logo_text"
                            value="{{ old('logo_text', $website['header']['logo_text'] ?? '') }}"
                            class="field-input"
                        >

                    </div>

                    <div>

                        <label class="field-label">
                            Badge
                        </label>

                        <input
                            type="text"
                            name="badge"
                            value="{{ old('badge', $website['header']['badge'] ?? '') }}"
                            class="field-input"
                        >

                    </div>

                    <div>

                        <label class="field-label">
                            Button Text
                        </label>

                        <input
                            type="text"
                            name="button_text"
                            value="{{ old('button_text', $website['header']['button_text'] ?? '') }}"
                            class="field-input"
                        >

                    </div>

                </div>

            </div>

            <div
                x-show="activeTab === 'editor' && activeSection === 'body'"
                x-cloak
            >

                <h2 class="text-xl font-bold text-slate-800">
                    Body Settings
                </h2>

                <p class="text-[11px] text-slate-500 mt-2 leading-relaxed">
                    Kelola konten utama, hero section, promo dan warna template.
                </p>

                <div class="space-y-5 mt-7">

                    <div>

                        <label class="field-label">
                            Hero Title
                        </label>

                        <textarea
                            name="hero_title"
                            rows="3"
                            class="field-input resize-none"
                        >{{ old('hero_title', $website['body']['hero_title'] ?? '') }}</textarea>

                    </div>

                    <div>

                        <label class="field-label">
                            Highlight
                        </label>

                        <input
                            type="text"
                            name="hero_highlight"
                            value="{{ old('hero_highlight', $website['body']['hero_highlight'] ?? '') }}"
                            class="field-input"
                        >

                    </div>

                    <div>

                        <label class="field-label">
                            Description
                        </label>

                        <textarea
                            name="hero_description"
                            rows="5"
                            class="field-input resize-none"
                        >{{ old('hero_description', $website['body']['hero_description'] ?? '') }}</textarea>

                    </div>

                    <div>

                        <label class="field-label">
                            Button Text
                        </label>

                        <input
                            type="text"
                            name="button_text"
                            value="{{ old('button_text', $website['body']['button_text'] ?? '') }}"
                            class="field-input"
                        >

                    </div>

                    <div>

                        <label class="field-label">
                            Promo Title
                        </label>

                        <input
                            type="text"
                            name="promo_title"
                            value="{{ old('promo_title', $website['body']['promo_title'] ?? '') }}"
                            class="field-input"
                        >

                    </div>

                    <div>

                        <label class="field-label">
                            Promo Description
                        </label>

                        <textarea
                            name="promo_description"
                            rows="4"
                            class="field-input resize-none"
                        >{{ old('promo_description', $website['body']['promo_description'] ?? '') }}</textarea>

                    </div>

                    <div>

                        <label class="field-label">
                            Theme Color
                        </label>

                        <div class="flex gap-3">

                            <input
                                type="color"
                                name="theme_primary"
                                value="{{ $website['style']['primary'] ?? '#0369a1' }}"
                                class="w-14 h-11 rounded-xl border border-slate-200 bg-white p-1"
                            >

                            <input
                                type="text"
                                value="{{ $website['style']['primary'] ?? '#0369a1' }}"
                                readonly
                                class="field-input flex-1"
                            >

                        </div>

                    </div>

                    <div>

                        <label class="field-label">
                            Hero Image
                        </label>

                        <input
                            type="file"
                            name="hero_image"
                            accept="image/*"
                            class="w-full text-xs text-slate-500"
                        >

                        <p class="text-[10px] text-slate-400 mt-2">
                            JPG, PNG, WebP. Maksimal 4MB.
                        </p>

                    </div>

                </div>

            </div>

            <div
                x-show="activeTab === 'editor' && activeSection === 'sidebar'"
                x-cloak
            >

                <h2 class="text-xl font-bold text-slate-800">
                    Sidebar Settings
                </h2>

                <p class="text-[11px] text-slate-500 mt-2 leading-relaxed">
                    Atur informasi kontak dan kanal komunikasi bisnis.
                </p>

                <div class="space-y-5 mt-7">

                    <div>

                        <label class="field-label">
                            Phone Number
                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone', $website['sidebar']['phone'] ?? '') }}"
                            class="field-input"
                        >

                    </div>

                    <div>

                        <label class="field-label">
                            Business Address
                        </label>

                        <textarea
                            name="address"
                            rows="4"
                            class="field-input resize-none"
                        >{{ old('address', $website['sidebar']['address'] ?? '') }}</textarea>

                    </div>

                    <div>

                        <label class="field-label">
                            WhatsApp
                        </label>

                        <input
                            type="text"
                            name="whatsapp"
                            value="{{ old('whatsapp', $website['sidebar']['whatsapp'] ?? '') }}"
                            class="field-input"
                        >

                    </div>

                    <div>

                        <label class="field-label">
                            WhatsApp Message
                        </label>

                        <textarea
                            name="whatsapp_message"
                            rows="3"
                            class="field-input resize-none"
                        >{{ old('whatsapp_message', $website['sidebar']['whatsapp_message'] ?? '') }}</textarea>

                    </div>

                    <div>

                        <label class="field-label">
                            Instagram
                        </label>

                        <input
                            type="text"
                            name="social_instagram"
                            value="{{ old('social_instagram', $website['sidebar']['social_instagram'] ?? '') }}"
                            class="field-input"
                        >

                    </div>

                </div>

            </div>

            <div
                x-show="activeTab === 'editor' && activeSection === 'footer'"
                x-cloak
            >

                <h2 class="text-xl font-bold text-slate-800">
                    Footer Settings
                </h2>

                <p class="text-[11px] text-slate-500 mt-2 leading-relaxed">
                    Atur informasi bagian bawah website.
                </p>

                <div class="space-y-5 mt-7">

                    <div>

                        <label class="field-label">
                            Footer Description
                        </label>

                        <textarea
                            name="footer_description"
                            rows="5"
                            class="field-input resize-none"
                        >{{ old('footer_description', $website['footer']['description'] ?? '') }}</textarea>

                    </div>

                    <div>

                        <label class="field-label">
                            Copyright
                        </label>

                        <input
                            type="text"
                            name="copyright"
                            value="{{ old('copyright', $website['footer']['copyright'] ?? '') }}"
                            class="field-input"
                        >

                    </div>

                </div>

            </div>

            <div
                x-show="activeTab === 'seo'"
                x-cloak
            >

                <h2 class="text-xl font-bold text-slate-800">
                    SEO Configuration
                </h2>

                <p class="text-[11px] text-slate-500 mt-2 leading-relaxed">
                    Kelola informasi SEO website Anda.
                </p>

                <div class="space-y-5 mt-7">

                    <div>

                        <label class="field-label">
                            Meta Title
                        </label>

                        <input
                            type="text"
                            name="seo_title"
                            value="{{ old('seo_title', $website['seo']['title'] ?? '') }}"
                            class="field-input"
                        >

                    </div>

                    <div>

                        <label class="field-label">
                            Meta Description
                        </label>

                        <textarea
                            name="seo_description"
                            rows="5"
                            class="field-input resize-none"
                        >{{ old('seo_description', $website['seo']['description'] ?? '') }}</textarea>

                    </div>

                    <div>

                        <label class="field-label">
                            Keywords
                        </label>

                        <textarea
                            name="seo_keywords"
                            rows="4"
                            class="field-input resize-none"
                        >{{ old('seo_keywords', $website['seo']['keywords'] ?? '') }}</textarea>

                    </div>

                </div>

            </div>

            <div
                x-show="activeTab === 'domain'"
                x-cloak
            >

                <h2 class="text-xl font-bold text-slate-800">
                    Domain Settings
                </h2>

                <p class="text-[11px] text-slate-500 mt-2 leading-relaxed">
                    Domain yang digunakan oleh website Anda.
                </p>

                <div class="space-y-5 mt-7">

                    <div>

                        <label class="field-label">
                            Domain Name
                        </label>

                        <input
                            type="text"
                            name="domain_name"
                            value="{{ old('domain_name', $website['domain']['name'] ?? '') }}"
                            class="field-input"
                        >

                    </div>

                    <div>

                        <label class="field-label">
                            Connection Status
                        </label>

                        <div class="px-4 py-3 rounded-xl bg-emerald-50 border border-emerald-100 text-xs font-bold text-emerald-600">
                            {{ $website['domain']['status'] ?? 'Not Connected' }}
                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>

    <section class="flex-1 bg-slate-100 overflow-hidden p-3 sm:p-5 lg:p-7">

        <div class="h-full bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">

            <div class="h-11 border-b border-slate-100 flex items-center px-4 gap-3 shrink-0">

                <div class="flex gap-1.5">

                    <span class="w-2.5 h-2.5 rounded-full bg-red-300"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-yellow-300"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-green-300"></span>

                </div>

                <div class="flex-1 flex justify-center">

                    <div class="bg-slate-50 border border-slate-100 rounded-full px-6 py-1.5 text-[9px] font-bold text-slate-400">
                        {{ $website['domain']['name'] ?? 'yourwebsite.com' }}
                    </div>

                </div>

            </div>

            <div class="flex-1 overflow-hidden bg-white">

                <iframe
                    src="{{ route('client.website.preview') }}"
                    class="w-full h-full border-0"
                    title="Website Preview"
                ></iframe>

            </div>

        </div>

    </section>

</main>

<style>
    .field-label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 8px;
    }

    .field-input {
        width: 100%;
        padding: 11px 14px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        background: white;
        font-size: 12px;
        font-weight: 600;
        color: #475569;
        outline: none;
        transition: .2s;
    }

    .field-input:focus {
        border-color: #0369a1;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, .08);
    }
</style>

<script>
    document.addEventListener('alpine:init', () => {

        Alpine.data('websiteEditor', () => ({

            activeTab: @js($tab),

            activeSection: @js($section),

        }));

    });
</script>

</body>
</html>