@extends('admin.layouts.app')

@section('title', 'Websites')

@section('content')

@php
    $currentTab = $tab ?? 'editor';
    $currentSection = $section ?? 'header';

    $editorSections = [
        'header' => [
            'label' => 'Header',
            'description' => 'Atur identitas dan tombol utama website.',
        ],
        'body' => [
            'label' => 'Body',
            'description' => 'Atur hero, masalah, solusi, dan CTA.',
        ],
        'sidebar' => [
            'label' => 'Sidebar',
            'description' => 'Atur informasi kontak website.',
        ],
        'footer' => [
            'label' => 'Footer',
            'description' => 'Atur informasi bagian bawah website.',
        ],
    ];
@endphp

<div class="w-full max-w-[1500px]">

    <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-xl font-bold text-slate-800">
                Website Editor
            </h1>

            <p class="mt-1 text-xs text-slate-400">
                Kelola konten website utama Bisma Labs.
            </p>
        </div>

        <a
            href="{{ route('home') }}"
            target="_blank"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-semibold text-slate-600 shadow-sm transition hover:border-sky-200 hover:text-sky-600"
        >
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 3h6v6" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14L21 3" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6" />
            </svg>

            Preview Website
        </a>

    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-white">

            <div class="flex flex-wrap items-center justify-between gap-3 px-5 pt-4">

                <div class="flex items-center gap-2">

                    <a
                        href="{{ route('admin.websites.index', ['tab' => 'editor', 'section' => $currentSection]) }}"
                        class="rounded-lg px-4 py-2.5 text-xs font-semibold transition {{ $currentTab === 'editor' ? 'bg-sky-50 text-sky-600' : 'text-slate-500 hover:bg-slate-50' }}"
                    >
                        Editor
                    </a>

                    <a
                        href="{{ route('admin.websites.index', ['tab' => 'seo', 'section' => $currentSection]) }}"
                        class="rounded-lg px-4 py-2.5 text-xs font-semibold transition {{ $currentTab === 'seo' ? 'bg-sky-50 text-sky-600' : 'text-slate-500 hover:bg-slate-50' }}"
                    >
                        SEO
                    </a>

                    <a
                        href="{{ route('admin.websites.index', ['tab' => 'domain', 'section' => $currentSection]) }}"
                        class="rounded-lg px-4 py-2.5 text-xs font-semibold transition {{ $currentTab === 'domain' ? 'bg-sky-50 text-sky-600' : 'text-slate-500 hover:bg-slate-50' }}"
                    >
                        Domain
                    </a>

                </div>

                @if($currentTab === 'editor')
                    <div class="text-[10px] text-slate-400">
                        Website utama
                    </div>
                @endif

            </div>

        </div>

        @if($currentTab === 'editor')

            <div class="grid min-h-[720px] grid-cols-1 lg:grid-cols-[220px_minmax(0,1fr)_420px]">

                <aside class="border-b border-slate-200 bg-[#fafbfd] lg:border-b-0 lg:border-r">

                    <div class="border-b border-slate-200 px-5 py-5">

                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Atelier Editor
                        </div>

                        <div class="mt-1 text-sm font-bold text-slate-800">
                            Site Settings
                        </div>

                    </div>

                    <div class="p-3">

                        @foreach($editorSections as $key => $item)

                            <a
                                href="{{ route('admin.websites.index', ['tab' => 'editor', 'section' => $key]) }}"
                                class="mb-1 flex items-center gap-3 rounded-xl px-3 py-3 transition {{ $currentSection === $key ? 'bg-white text-sky-600 shadow-sm ring-1 ring-slate-100' : 'text-slate-500 hover:bg-white hover:text-slate-700' }}"
                            >

                                @if($key === 'header')

                                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" d="M4 6h16M4 12h10M4 18h7" />
                                    </svg>

                                @elseif($key === 'body')

                                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <rect x="4" y="4" width="16" height="16" rx="2" />
                                        <path stroke-linecap="round" d="M8 9h8M8 13h5M8 17h7" />
                                    </svg>

                                @elseif($key === 'sidebar')

                                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <rect x="4" y="4" width="16" height="16" rx="2" />
                                        <path stroke-linecap="round" d="M8 4v16" />
                                    </svg>

                                @else

                                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" d="M4 18h16M4 6h16M4 12h16" />
                                    </svg>

                                @endif

                                <span class="text-xs font-semibold">
                                    {{ $item['label'] }}
                                </span>

                            </a>

                        @endforeach

                    </div>

                    <div class="mt-auto hidden border-t border-slate-200 p-4 lg:block">

                        <a
                            href="{{ route('home') }}"
                            class="flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-sky-600"
                        >
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>

                            Kembali
                        </a>

                    </div>

                </aside>

                <main class="min-w-0 bg-white">

                    <form
                        action="{{ route('admin.websites.update') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="h-full"
                    >

                        @csrf
                        @method('PUT')

                        <input type="hidden" name="tab" value="editor">
                        <input type="hidden" name="section" value="{{ $currentSection }}">

                        <div class="border-b border-slate-200 px-6 py-5 sm:px-8">

                            <div class="flex items-center justify-between gap-4">

                                <div>

                                    <h2 class="text-base font-bold text-slate-800">
                                        General Settings
                                    </h2>

                                    <p class="mt-1 text-[11px] text-slate-400">
                                        {{ $editorSections[$currentSection]['description'] }}
                                    </p>

                                </div>

                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-2 rounded-xl bg-[#0879b9] px-4 py-2.5 text-xs font-bold text-white transition hover:bg-[#075f91]"
                                >
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12l4 4L19 6" />
                                    </svg>

                                    Save
                                </button>

                            </div>

                        </div>

                        <div class="space-y-6 px-6 py-6 sm:px-8">

                            @if($currentSection === 'header')

                                <div class="space-y-5">

                                    <div>
                                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                                            Business Name
                                        </label>

                                        <input
                                            type="text"
                                            name="site_name"
                                            value="{{ old('site_name', $website['header']['site_name']) }}"
                                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                        >
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                                            Header Badge
                                        </label>

                                        <input
                                            type="text"
                                            name="badge"
                                            value="{{ old('badge', $website['header']['badge']) }}"
                                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                        >
                                    </div>

                                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                                        <div>
                                            <label class="mb-2 block text-xs font-semibold text-slate-600">
                                                Button Text
                                            </label>

                                            <input
                                                type="text"
                                                name="button_text"
                                                value="{{ old('button_text', $website['header']['button_text']) }}"
                                                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                            >
                                        </div>

                                        <div>
                                            <label class="mb-2 block text-xs font-semibold text-slate-600">
                                                Button Link
                                            </label>

                                            <input
                                                type="text"
                                                name="button_link"
                                                value="{{ old('button_link', $website['header']['button_link']) }}"
                                                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                            >
                                        </div>

                                    </div>

                                </div>

                            @elseif($currentSection === 'body')

                                <div class="space-y-6">

                                    <div class="rounded-2xl border border-slate-100 bg-slate-50/70 p-5">

                                        <div class="mb-5">
                                            <h3 class="text-sm font-bold text-slate-700">
                                                Hero Section
                                            </h3>

                                            <p class="mt-1 text-[10px] text-slate-400">
                                                Konten utama yang pertama kali dilihat pengunjung.
                                            </p>
                                        </div>

                                        <div class="space-y-5">

                                            <div>
                                                <label class="mb-2 block text-xs font-semibold text-slate-600">
                                                    Hero Title
                                                </label>

                                                <input
                                                    type="text"
                                                    name="hero_title"
                                                    value="{{ old('hero_title', $website['body']['hero_title']) }}"
                                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                                >
                                            </div>

                                            <div>
                                                <label class="mb-2 block text-xs font-semibold text-slate-600">
                                                    Highlight Text
                                                </label>

                                                <input
                                                    type="text"
                                                    name="hero_highlight"
                                                    value="{{ old('hero_highlight', $website['body']['hero_highlight']) }}"
                                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                                >
                                            </div>

                                            <div>
                                                <label class="mb-2 block text-xs font-semibold text-slate-600">
                                                    Description
                                                </label>

                                                <textarea
                                                    name="hero_description"
                                                    rows="4"
                                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                                >{{ old('hero_description', $website['body']['hero_description']) }}</textarea>
                                            </div>

                                            <div>
                                                <label class="mb-2 block text-xs font-semibold text-slate-600">
                                                    Upload Hero Image
                                                </label>

                                                <input
                                                    type="file"
                                                    name="hero_image"
                                                    accept="image/*"
                                                    class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-xs text-slate-500 file:mr-4 file:rounded-lg file:border-0 file:bg-sky-50 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-sky-600"
                                                >

                                                <p class="mt-2 text-[10px] text-slate-400">
                                                    Maksimal 4 MB.
                                                </p>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="rounded-2xl border border-slate-100 bg-slate-50/70 p-5">

                                        <div class="mb-5">
                                            <h3 class="text-sm font-bold text-slate-700">
                                                Problem Section
                                            </h3>
                                        </div>

                                        <div class="space-y-5">

                                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                                                <div>
                                                    <label class="mb-2 block text-xs font-semibold text-slate-600">
                                                        Problem 1 Title
                                                    </label>

                                                    <input
                                                        type="text"
                                                        name="problem_1_title"
                                                        value="{{ old('problem_1_title', $website['body']['problem_1_title']) }}"
                                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                                    >
                                                </div>

                                                <div>
                                                    <label class="mb-2 block text-xs font-semibold text-slate-600">
                                                        Problem 2 Title
                                                    </label>

                                                    <input
                                                        type="text"
                                                        name="problem_2_title"
                                                        value="{{ old('problem_2_title', $website['body']['problem_2_title']) }}"
                                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                                    >
                                                </div>

                                            </div>

                                            <div>
                                                <label class="mb-2 block text-xs font-semibold text-slate-600">
                                                    Problem 1 Description
                                                </label>

                                                <textarea
                                                    name="problem_1_description"
                                                    rows="3"
                                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                                >{{ old('problem_1_description', $website['body']['problem_1_description']) }}</textarea>
                                            </div>

                                            <div>
                                                <label class="mb-2 block text-xs font-semibold text-slate-600">
                                                    Problem 2 Description
                                                </label>

                                                <textarea
                                                    name="problem_2_description"
                                                    rows="3"
                                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                                >{{ old('problem_2_description', $website['body']['problem_2_description']) }}</textarea>
                                            </div>

                                            <div>
                                                <label class="mb-2 block text-xs font-semibold text-slate-600">
                                                    Problem 3 Title
                                                </label>

                                                <input
                                                    type="text"
                                                    name="problem_3_title"
                                                    value="{{ old('problem_3_title', $website['body']['problem_3_title']) }}"
                                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                                >
                                            </div>

                                            <div>
                                                <label class="mb-2 block text-xs font-semibold text-slate-600">
                                                    Problem 3 Description
                                                </label>

                                                <textarea
                                                    name="problem_3_description"
                                                    rows="3"
                                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                                >{{ old('problem_3_description', $website['body']['problem_3_description']) }}</textarea>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="rounded-2xl border border-slate-100 bg-slate-50/70 p-5">

                                        <div class="mb-5">
                                            <h3 class="text-sm font-bold text-slate-700">
                                                Solution & CTA
                                            </h3>
                                        </div>

                                        <div class="space-y-5">

                                            <div>
                                                <label class="mb-2 block text-xs font-semibold text-slate-600">
                                                    Solution Title
                                                </label>

                                                <input
                                                    type="text"
                                                    name="solution_title"
                                                    value="{{ old('solution_title', $website['body']['solution_title']) }}"
                                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                                >
                                            </div>

                                            <div>
                                                <label class="mb-2 block text-xs font-semibold text-slate-600">
                                                    Solution Description
                                                </label>

                                                <textarea
                                                    name="solution_description"
                                                    rows="4"
                                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                                >{{ old('solution_description', $website['body']['solution_description']) }}</textarea>
                                            </div>

                                            <div>
                                                <label class="mb-2 block text-xs font-semibold text-slate-600">
                                                    CTA Title
                                                </label>

                                                <input
                                                    type="text"
                                                    name="cta_title"
                                                    value="{{ old('cta_title', $website['body']['cta_title']) }}"
                                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                                >
                                            </div>

                                            <div>
                                                <label class="mb-2 block text-xs font-semibold text-slate-600">
                                                    CTA Description
                                                </label>

                                                <textarea
                                                    name="cta_description"
                                                    rows="4"
                                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                                >{{ old('cta_description', $website['body']['cta_description']) }}</textarea>
                                            </div>

                                            <div>
                                                <label class="mb-2 block text-xs font-semibold text-slate-600">
                                                    CTA Button Text
                                                </label>

                                                <input
                                                    type="text"
                                                    name="cta_button_text"
                                                    value="{{ old('cta_button_text', $website['body']['cta_button_text']) }}"
                                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                                >
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @elseif($currentSection === 'sidebar')

                                <div class="space-y-5">

                                    <div>
                                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                                            Phone Number
                                        </label>

                                        <input
                                            type="text"
                                            name="phone"
                                            value="{{ old('phone', $website['sidebar']['phone']) }}"
                                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                        >
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                                            Business Address
                                        </label>

                                        <textarea
                                            name="address"
                                            rows="3"
                                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                        >{{ old('address', $website['sidebar']['address']) }}</textarea>
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                                            WhatsApp Number
                                        </label>

                                        <input
                                            type="text"
                                            name="whatsapp"
                                            value="{{ old('whatsapp', $website['sidebar']['whatsapp']) }}"
                                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                        >
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                                            WhatsApp Message
                                        </label>

                                        <textarea
                                            name="whatsapp_message"
                                            rows="3"
                                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                        >{{ old('whatsapp_message', $website['sidebar']['whatsapp_message']) }}</textarea>
                                    </div>

                                </div>

                            @elseif($currentSection === 'footer')

                                <div class="space-y-5">

                                    <div>
                                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                                            Footer Description
                                        </label>

                                        <textarea
                                            name="footer_description"
                                            rows="4"
                                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                        >{{ old('footer_description', $website['footer']['description']) }}</textarea>
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                                            Copyright
                                        </label>

                                        <input
                                            type="text"
                                            name="copyright"
                                            value="{{ old('copyright', $website['footer']['copyright']) }}"
                                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                                        >
                                    </div>

                                </div>

                            @endif

                        </div>

                    </form>

                </main>

                <section class="border-t border-slate-200 bg-[#f6f8fb] lg:border-l lg:border-t-0">

                    <div class="flex items-center justify-between border-b border-slate-200 bg-white px-4 py-3">

                        <div class="text-xs font-bold text-slate-700">
                            Live Preview
                        </div>

                        <div class="flex items-center gap-1 rounded-lg border border-slate-200 bg-slate-50 p-1">

                            <button
                                type="button"
                                data-preview="desktop"
                                class="preview-mode rounded-md bg-white px-2.5 py-1.5 text-[10px] font-semibold text-slate-700 shadow-sm"
                            >
                                Desktop
                            </button>

                            <button
                                type="button"
                                data-preview="mobile"
                                class="preview-mode rounded-md px-2.5 py-1.5 text-[10px] font-semibold text-slate-400"
                            >
                                Mobile
                            </button>

                        </div>

                    </div>

                    <div class="flex h-[calc(100%-49px)] items-start justify-center overflow-auto p-4 sm:p-6">

                        <div
                            id="preview-frame-wrapper"
                            class="w-full overflow-hidden rounded-xl border border-slate-200 bg-white shadow-lg transition-all duration-300"
                        >
                            <iframe
                                id="preview-frame"
                                src="{{ route('home') }}"
                                title="Website Preview"
                                class="h-[650px] w-full border-0 bg-white"
                            ></iframe>
                        </div>

                    </div>

                </section>

            </div>

        @elseif($currentTab === 'seo')

            <form
                action="{{ route('admin.websites.update') }}"
                method="POST"
                class="max-w-4xl p-6 sm:p-8"
            >

                @csrf
                @method('PUT')

                <input type="hidden" name="tab" value="seo">
                <input type="hidden" name="section" value="{{ $currentSection }}">

                <div class="flex items-center justify-between gap-4 border-b border-slate-100 pb-5">

                    <div>
                        <h2 class="text-base font-bold text-slate-800">
                            SEO Settings
                        </h2>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Atur informasi yang digunakan oleh mesin pencari.
                        </p>
                    </div>

                    <button
                        type="submit"
                        class="rounded-xl bg-[#0879b9] px-4 py-2.5 text-xs font-bold text-white hover:bg-[#075f91]"
                    >
                        Save
                    </button>

                </div>

                <div class="mt-6 space-y-5">

                    <div>
                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Meta Title
                        </label>

                        <input
                            type="text"
                            name="seo_title"
                            value="{{ old('seo_title', $website['seo']['title']) }}"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Meta Description
                        </label>

                        <textarea
                            name="seo_description"
                            rows="4"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                        >{{ old('seo_description', $website['seo']['description']) }}</textarea>
                    </div>

                    <div>
                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Keywords
                        </label>

                        <textarea
                            name="seo_keywords"
                            rows="3"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                        >{{ old('seo_keywords', $website['seo']['keywords']) }}</textarea>
                    </div>

                    <div>
                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Open Graph Image
                        </label>

                        <input
                            type="text"
                            name="og_image"
                            value="{{ old('og_image', $website['seo']['og_image']) }}"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                        >
                    </div>

                </div>

            </form>

        @else

            <form
                action="{{ route('admin.websites.update') }}"
                method="POST"
                class="max-w-4xl p-6 sm:p-8"
            >

                @csrf
                @method('PUT')

                <input type="hidden" name="tab" value="domain">
                <input type="hidden" name="section" value="{{ $currentSection }}">

                <div class="flex items-center justify-between gap-4 border-b border-slate-100 pb-5">

                    <div>
                        <h2 class="text-base font-bold text-slate-800">
                            Domain Settings
                        </h2>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Informasi domain website utama Bisma Labs.
                        </p>
                    </div>

                    <button
                        type="submit"
                        class="rounded-xl bg-[#0879b9] px-4 py-2.5 text-xs font-bold text-white hover:bg-[#075f91]"
                    >
                        Save
                    </button>

                </div>

                <div class="mt-6 space-y-5">

                    <div>
                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Domain
                        </label>

                        <input
                            type="text"
                            name="domain_name"
                            value="{{ old('domain_name', $website['domain']['name']) }}"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Status
                        </label>

                        <select
                            name="domain_status"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                        >
                            <option value="Connected" @selected($website['domain']['status'] === 'Connected')>
                                Connected
                            </option>

                            <option value="Pending" @selected($website['domain']['status'] === 'Pending')>
                                Pending
                            </option>

                            <option value="Not Connected" @selected($website['domain']['status'] === 'Not Connected')>
                                Not Connected
                            </option>
                        </select>
                    </div>

                </div>

            </form>

        @endif

    </div>

</div>

@if($errors->any())

    <div class="fixed bottom-5 right-5 z-50 max-w-sm rounded-xl border border-red-100 bg-white p-4 shadow-xl">

        <div class="text-xs font-bold text-red-600">
            Terdapat kesalahan:
        </div>

        <ul class="mt-2 space-y-1 text-[10px] text-red-500">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>

@endif

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const wrapper = document.getElementById('preview-frame-wrapper');
        const buttons = document.querySelectorAll('.preview-mode');

        if (!wrapper || !buttons.length) {
            return;
        }

        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                const mode = button.dataset.preview;

                buttons.forEach(function (item) {
                    item.classList.remove('bg-white', 'text-slate-700', 'shadow-sm');
                    item.classList.add('text-slate-400');
                });

                button.classList.remove('text-slate-400');
                button.classList.add('bg-white', 'text-slate-700', 'shadow-sm');

                if (mode === 'mobile') {
                    wrapper.classList.remove('w-full');
                    wrapper.classList.add('w-[375px]', 'max-w-full');
                } else {
                    wrapper.classList.remove('w-[375px]', 'max-w-full');
                    wrapper.classList.add('w-full');
                }
            });
        });
    });
</script>

@endpush

@endsection