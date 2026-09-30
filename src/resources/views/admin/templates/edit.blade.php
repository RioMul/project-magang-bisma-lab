@extends('admin.layouts.app')

@section('title', 'Edit Template')

@section('content')

<div
    class="min-h-[calc(100vh-120px)]"
    x-data="{ activeSection: 'general' }"
>

    @include('admin.templates.partials.editor.topbar')

    <div class="grid grid-cols-1 lg:grid-cols-[240px_minmax(0,1fr)] gap-5 mt-5">

        @include('admin.templates.partials.editor.sidebar')

        <main class="min-w-0">

            <div
                x-show="activeSection === 'general'"
                class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6"
            >
                <div class="mb-6">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#0369a1]">
                        General
                    </span>

                    <h2 class="mt-1 text-xl font-bold text-slate-900">
                        General Information
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Atur informasi dasar template.
                    </p>
                </div>

                @include('admin.templates.form')
            </div>

            <div
                x-show="activeSection !== 'general'"
                style="display: none;"
                class="bg-white rounded-2xl border border-slate-100 shadow-sm min-h-[500px] flex items-center justify-center"
            >
                <div class="text-center max-w-md px-6">

                    <div class="w-14 h-14 rounded-2xl bg-sky-50 text-[#0369a1] flex items-center justify-center mx-auto mb-4">
                        <svg
                            class="w-7 h-7"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 6v12m6-6H6"
                            />
                        </svg>
                    </div>

                    <h2 class="text-lg font-bold text-slate-800">
                        Template Editor
                    </h2>

                    <p class="mt-2 text-sm leading-relaxed text-slate-500">
                        Section
                        <span
                            class="font-semibold text-slate-700"
                            x-text="activeSection.charAt(0).toUpperCase() + activeSection.slice(1)"
                        ></span>
                        akan kita isi pada tahap berikutnya.
                    </p>

                </div>
            </div>

        </main>

    </div>

</div>

@endsection