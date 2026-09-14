@extends('layouts.editor')

@section('title', $page['name'] . ' | Page Editor')

@section('content')

<div
    class="flex flex-col h-screen bg-[#f8fafc]"
    x-data="{ activePanel: 'general' }"
>

    <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-6 shrink-0">

        <div class="flex items-center gap-3 sm:gap-5 min-w-0">

            <a
                href="{{ route('client.pages.index') }}"
                class="flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-slate-900 transition shrink-0"
            >
                <svg
                    class="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19 12H5M12 19l-7-7 7-7"
                    />
                </svg>

                <span class="hidden sm:inline">
                    Back to Pages
                </span>
            </a>

            <div class="h-6 w-px bg-slate-200 hidden sm:block"></div>

            <div class="min-w-0">

                <h1 class="text-sm sm:text-base font-bold text-slate-800 truncate">
                    {{ $page['name'] }}
                </h1>

                <p class="text-[10px] text-slate-400 hidden sm:block">
                    Page Editor
                </p>

            </div>

        </div>

        <div class="flex items-center gap-2 sm:gap-4 shrink-0">

            <button
                type="button"
                class="hidden sm:flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-slate-800 transition"
            >
                <svg
                    class="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7"
                    />
                </svg>

                Preview
            </button>

            <button
                type="button"
                class="hidden sm:block text-xs font-semibold text-slate-500 hover:text-slate-800 transition"
            >
                Save Draft
            </button>

            <button
                type="button"
                class="px-4 sm:px-5 py-2 bg-[#0369a1] hover:bg-[#075985] text-white text-xs sm:text-sm font-bold rounded-lg shadow-sm transition"
            >
                Publish
            </button>

        </div>

    </header>

    <div class="flex flex-1 min-h-0 overflow-hidden">

        <aside class="hidden lg:flex w-60 xl:w-64 bg-white border-r border-slate-200 flex-col justify-between shrink-0">

            <div class="p-5">

                <div class="mb-8">

                    <h2 class="font-bold text-slate-800">
                        Page Editor
                    </h2>

                    <p class="text-xs text-slate-400 mt-1">
                        Editing: {{ $page['name'] }}
                    </p>

                </div>

                <nav class="space-y-2">

                    <button
                        type="button"
                        @click="activePanel = 'general'"
                        :class="activePanel === 'general'
                            ? 'bg-sky-50 text-[#0369a1] border border-sky-100'
                            : 'text-slate-500 hover:bg-slate-50 border border-transparent'"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition text-left"
                    >

                        <svg
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m0 0v10m6-16V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m0 0v10M6 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m0 0v10"
                            />
                        </svg>

                        General

                    </button>

                    <button
                        type="button"
                        @click="activePanel = 'seo'"
                        :class="activePanel === 'seo'
                            ? 'bg-sky-50 text-[#0369a1] border border-sky-100'
                            : 'text-slate-500 hover:bg-slate-50 border border-transparent'"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition text-left"
                    >

                        <svg
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <circle
                                cx="11"
                                cy="11"
                                r="6"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M20 20l-4.2-4.2"
                            />
                        </svg>

                        SEO

                    </button>

                </nav>

            </div>

            <div class="p-5">

                <a
                    href="#"
                    class="w-full flex items-center justify-center gap-2 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-sm rounded-xl transition"
                >

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                        />
                    </svg>

                    View Live Site

                </a>

            </div>

        </aside>

        <div class="lg:hidden flex bg-white border-b border-slate-200 shrink-0">

            <button
                type="button"
                @click="activePanel = 'general'"
                :class="activePanel === 'general'
                    ? 'text-[#0369a1] border-[#0369a1]'
                    : 'text-slate-500 border-transparent'"
                class="flex-1 py-3 text-xs font-bold border-b-2 transition"
            >
                General
            </button>

            <button
                type="button"
                @click="activePanel = 'seo'"
                :class="activePanel === 'seo'
                    ? 'text-[#0369a1] border-[#0369a1]'
                    : 'text-slate-500 border-transparent'"
                class="flex-1 py-3 text-xs font-bold border-b-2 transition"
            >
                SEO
            </button>

        </div>

        <main class="flex-1 min-w-0 overflow-y-auto">

            <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">

                <div
                    x-show="activePanel === 'general'"
                    x-cloak
                    class="space-y-6"
                >

                    <div>

                        <span class="text-[10px] font-bold text-[#0369a1] uppercase tracking-wider">
                            Content
                        </span>

                        <h2 class="text-xl sm:text-2xl font-bold text-slate-800 mt-1">
                            General Content
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Manage the main content displayed on this page.
                        </p>

                    </div>

                    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                        <div class="p-4 sm:p-5 border-b border-slate-100">

                            <div class="w-full h-40 sm:h-52 bg-slate-100 rounded-xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center">

                                <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-slate-400 mb-3">

                                    <svg
                                        class="w-5 h-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"
                                        />
                                        <circle
                                            cx="9"
                                            cy="8"
                                            r="1.5"
                                        />
                                        <rect
                                            x="3"
                                            y="4"
                                            width="18"
                                            height="16"
                                            rx="2"
                                        />
                                    </svg>

                                </div>

                                <p class="text-sm font-semibold text-slate-600">
                                    Add Featured Image
                                </p>

                                <p class="text-xs text-slate-400 mt-1">
                                    JPG, PNG, or WebP
                                </p>

                            </div>

                        </div>

                        <div class="border-b border-slate-100 bg-slate-50 px-3 py-2 overflow-x-auto">

                            <div class="flex items-center gap-1 min-w-max">

                                <button
                                    type="button"
                                    class="w-8 h-8 rounded-lg hover:bg-slate-200 text-slate-600 font-bold text-sm"
                                >
                                    B
                                </button>

                                <button
                                    type="button"
                                    class="w-8 h-8 rounded-lg hover:bg-slate-200 text-slate-600 italic text-sm"
                                >
                                    I
                                </button>

                                <div class="w-px h-5 bg-slate-300 mx-1"></div>

                                <button
                                    type="button"
                                    class="w-9 h-8 rounded-lg hover:bg-slate-200 text-slate-600 font-bold text-xs"
                                >
                                    H1
                                </button>

                                <button
                                    type="button"
                                    class="w-9 h-8 rounded-lg hover:bg-slate-200 text-slate-600 font-bold text-xs"
                                >
                                    H2
                                </button>

                                <div class="w-px h-5 bg-slate-300 mx-1"></div>

                                <button
                                    type="button"
                                    class="w-8 h-8 rounded-lg hover:bg-slate-200 text-slate-600"
                                >
                                    <svg
                                        class="w-4 h-4 mx-auto"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M4 6h16M4 12h16M4 18h16"
                                        />
                                    </svg>
                                </button>

                                <button
                                    type="button"
                                    class="w-8 h-8 rounded-lg hover:bg-slate-200 text-slate-600"
                                >
                                    <svg
                                        class="w-4 h-4 mx-auto"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"
                                        />
                                    </svg>
                                </button>

                            </div>

                        </div>

                        <div class="p-6 sm:p-8">

                            <input
                                type="text"
                                value="{{ $page['name'] }}"
                                class="w-full border-0 p-0 text-2xl sm:text-3xl font-black text-slate-800 focus:ring-0 placeholder:text-slate-300"
                                placeholder="Page title"
                            >

                            <textarea
                                rows="7"
                                class="w-full mt-5 border-0 p-0 resize-none text-sm sm:text-base leading-7 text-slate-600 focus:ring-0"
                                placeholder="Write your page content here..."
                            >The secret to a successful online presence isn't just about functionality; it's about the experience. Small business owners can use this space to communicate their products, services, and brand story.

Start your journey by defining the tone of your page and giving your visitors useful information about your business.</textarea>

                            <div class="mt-6 p-4 rounded-xl bg-sky-50 border border-sky-100">

                                <p class="text-xs font-semibold text-slate-700">
                                    Content preview
                                </p>

                                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                    Changes made here will represent the main content of the selected page.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                <div
                    x-show="activePanel === 'seo'"
                    x-cloak
                    class="space-y-6"
                >

                    <div>

                        <span class="text-[10px] font-bold text-[#0369a1] uppercase tracking-wider">
                            Search Engine Optimization
                        </span>

                        <h2 class="text-xl sm:text-2xl font-bold text-slate-800 mt-1">
                            SEO Settings
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Configure how this page appears in search engines.
                        </p>

                    </div>

                    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-5 sm:p-6 space-y-6">

                        <div>

                            <label class="block text-xs font-bold text-slate-600 mb-2">
                                URL Slug
                            </label>

                            <div class="flex">

                                <span class="flex items-center px-3 bg-slate-100 border border-r-0 border-slate-200 rounded-l-xl text-xs text-slate-400">
                                    /pages/
                                </span>

                                <input
                                    type="text"
                                    value="{{ $page['slug'] }}"
                                    class="flex-1 px-4 py-3 border border-slate-200 rounded-r-xl text-sm text-slate-700 focus:border-[#0369a1] focus:ring-2 focus:ring-sky-50"
                                >

                            </div>

                        </div>

                        <div>

                            <label class="block text-xs font-bold text-slate-600 mb-2">
                                Meta Title
                            </label>

                            <textarea
                                rows="2"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm text-slate-700 focus:border-[#0369a1] focus:ring-2 focus:ring-sky-50 resize-none"
                            >{{ $page['meta_title'] }}</textarea>

                            <p class="text-[10px] text-slate-400 mt-1">
                                Recommended length: around 50–60 characters.
                            </p>

                        </div>

                        <div>

                            <label class="block text-xs font-bold text-slate-600 mb-2">
                                Meta Description
                            </label>

                            <textarea
                                rows="5"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm text-slate-700 focus:border-[#0369a1] focus:ring-2 focus:ring-sky-50 resize-none"
                            >{{ $page['meta_description'] }}</textarea>

                            <p class="text-[10px] text-slate-400 mt-1">
                                Write a short description that explains the page content.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </main>

        <aside class="hidden xl:block w-72 bg-white border-l border-slate-200 overflow-y-auto shrink-0">

            <div class="p-5 space-y-7">

                <div>

                    <div class="flex items-center justify-between mb-4">

                        <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                            Status & Visibility
                        </h3>

                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                    </div>

                    <div class="flex items-center justify-between py-3 border-b border-slate-100">

                        <span class="text-sm text-slate-600">
                            Status
                        </span>

                        <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-500 text-[10px] font-bold uppercase">
                            {{ $page['status'] }}
                        </span>

                    </div>

                    <div class="flex items-center justify-between py-3">

                        <span class="text-sm text-slate-600">
                            Visibility
                        </span>

                        <span class="text-xs font-semibold text-slate-500">
                            {{ $page['visibility'] }}
                        </span>

                    </div>

                </div>

                <div>

                    <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-3">
                        Page Information
                    </h3>

                    <div class="space-y-3">

                        <div class="p-3 bg-slate-50 rounded-xl">

                            <p class="text-[10px] text-slate-400 uppercase font-bold">
                                Page Name
                            </p>

                            <p class="text-sm font-semibold text-slate-700 mt-1 truncate">
                                {{ $page['name'] }}
                            </p>

                        </div>

                        <div class="p-3 bg-slate-50 rounded-xl">

                            <p class="text-[10px] text-slate-400 uppercase font-bold">
                                URL
                            </p>

                            <p class="text-sm font-semibold text-slate-700 mt-1 truncate">
                                /{{ $page['slug'] }}
                            </p>

                        </div>

                    </div>

                </div>

                <div>

                    <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-3">
                        SEO Preview
                    </h3>

                    <div class="border border-slate-200 rounded-xl p-4">

                        <p class="text-sm font-semibold text-[#0369a1] line-clamp-2">
                            {{ $page['meta_title'] }}
                        </p>

                        <p class="text-[11px] text-emerald-600 mt-1 truncate">
                            bismalabs.com/pages/{{ $page['slug'] }}
                        </p>

                        <p class="text-[11px] text-slate-500 mt-2 leading-relaxed line-clamp-3">
                            {{ $page['meta_description'] }}
                        </p>

                    </div>

                </div>

            </div>

        </aside>

    </div>

</div>

@endsection