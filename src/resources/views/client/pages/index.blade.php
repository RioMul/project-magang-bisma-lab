@extends('layouts.client')

@section('title', 'Halaman | Bisma Labs')

@section('content')

<div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-5">

    <div>
        <h1 class="text-2xl sm:text-3xl font-bold text-slate-800 tracking-tight">
            Halaman
        </h1>

        <p class="text-sm text-slate-500 mt-2 max-w-xl">
            Manage your website's architecture and content structure in one place.
        </p>
    </div>

    <button
        type="button"
        class="inline-flex items-center justify-center gap-2 bg-[#0369a1] hover:bg-[#075985] text-white px-5 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition"
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
                d="M12 4v16m8-8H4"
            />
        </svg>

        Create Page
    </button>

</div>

<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full min-w-[760px] text-left">

            <thead class="bg-slate-50 border-b border-slate-100">

                <tr class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">

                    <th class="px-6 py-4">
                        Page Name
                    </th>

                    <th class="px-6 py-4">
                        URL Slug
                    </th>

                    <th class="px-6 py-4">
                        Last Modified
                    </th>

                    <th class="px-6 py-4">
                        Status
                    </th>

                    <th class="px-6 py-4 text-right">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($pages as $page)

                    <tr class="hover:bg-slate-50/70 transition">

                        <td class="px-6 py-4">

                            <p class="font-semibold text-sm text-slate-800">
                                {{ $page['name'] }}
                            </p>

                        </td>

                        <td class="px-6 py-4">

                            <span class="text-sm text-slate-500">
                                {{ $page['slug'] }}
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <span class="text-sm text-slate-500">
                                {{ $page['updated_at'] }}
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            @if($page['status'] === 'Published')

                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">

                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                    Published

                                </span>

                            @else

                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500 border border-slate-200">

                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>

                                    Draft

                                </span>

                            @endif

                        </td>

                        <td class="px-6 py-4">

                            <div class="flex items-center justify-end gap-1">

                                <a
                                    href="{{ route('client.pages.edit', $page['id']) }}"
                                    title="Edit Page"
                                    class="w-9 h-9 flex items-center justify-center rounded-lg text-[#0369a1] hover:bg-sky-50 transition"
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
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                        />
                                    </svg>

                                </a>

                                <button
                                    type="button"
                                    title="Delete Page"
                                    class="w-9 h-9 flex items-center justify-center rounded-lg text-red-400 hover:bg-red-50 hover:text-red-500 transition"
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
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                        />
                                    </svg>

                                </button>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="px-6 py-12 text-center">

                            <div class="flex flex-col items-center">

                                <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center mb-3">

                                    <svg
                                        class="w-6 h-6 text-slate-400"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6 4h9l3 3v13H6V4z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 11h6M9 15h4"
                                        />
                                    </svg>

                                </div>

                                <p class="text-sm font-semibold text-slate-700">
                                    Belum ada halaman
                                </p>

                                <p class="text-xs text-slate-400 mt-1">
                                    Buat halaman pertama untuk website Anda.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<div class="mt-6 bg-white border border-slate-200 rounded-2xl shadow-sm p-5 sm:p-6">

    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">

        <div class="flex items-center gap-4">

            <div class="flex -space-x-3 shrink-0">

                <div class="w-9 h-9 rounded-full border-2 border-white bg-slate-800"></div>

                <div class="w-9 h-9 rounded-full border-2 border-white bg-slate-300"></div>

                <div class="w-9 h-9 rounded-full border-2 border-white bg-[#0369a1] text-white flex items-center justify-center text-[10px] font-bold">
                    +2
                </div>

            </div>

            <div>

                <p class="text-sm font-semibold text-slate-700">
                    Active collaborators
                </p>

                <p class="text-xs text-slate-400 mt-0.5">
                    Working on your website pages.
                </p>

            </div>

        </div>

        <div class="grid grid-cols-3 divide-x divide-slate-200">

            <div class="px-5 sm:px-8 text-center">

                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">
                    Total Pages
                </p>

                <p class="text-xl font-bold text-[#0369a1] mt-1">
                    {{ count($pages) }}
                </p>

            </div>

            <div class="px-5 sm:px-8 text-center">

                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">
                    Live Links
                </p>

                <p class="text-xl font-bold text-emerald-500 mt-1">
                    {{ collect($pages)->where('status', 'Published')->count() }}
                </p>

            </div>

            <div class="px-5 sm:px-8 text-center">

                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">
                    SEO Score
                </p>

                <p class="text-xl font-bold text-slate-800 mt-1">
                    94%
                </p>

            </div>

        </div>

    </div>

</div>

@endsection