@extends('admin.layouts.app')

@section('title', 'Edit Template')

@section('content')

<div
    class="min-h-[calc(100vh-120px)]"
    x-data="{
        activeSection: 'general',
        products: @js($templateData['body']['products'] ?? [])
    }"
>

    @include('admin.templates.partials.editor.topbar')

    @if($errors->any())

        <div class="mt-5 bg-rose-50 border border-rose-100 rounded-2xl px-5 py-4">

            <div class="flex items-start gap-3">

                <div class="w-8 h-8 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
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
                            d="M12 9v2m0 4h.01M10.29 3.86l-8.82 15a2 2 0 001.71 2.14h17.64a2 2 0 001.71-2.14l-8.82-15a2 2 0 00-3.42 0z"
                        />
                    </svg>
                </div>

                <div>

                    <p class="text-sm font-semibold text-rose-700">
                        Data belum dapat disimpan.
                    </p>

                    <ul class="mt-2 space-y-1 text-xs text-rose-600">

                        @foreach($errors->all() as $error)

                            <li>
                                • {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif

    @if(session('success'))

        <div class="mt-5 bg-emerald-50 border border-emerald-100 rounded-2xl px-5 py-4">

            <div class="flex items-center gap-3">

                <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
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
                            d="M5 13l4 4L19 7"
                        />
                    </svg>
                </div>

                <p class="text-sm font-semibold text-emerald-700">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif

    <div class="grid grid-cols-1 lg:grid-cols-[240px_minmax(0,1fr)] gap-5 mt-5">

        @include('admin.templates.partials.editor.sidebar')

        <main class="min-w-0">

            <form
                id="template-editor-form"
                method="POST"
                action="{{ route('admin.templates.update', $template) }}"
                class="space-y-5"
            >

                @csrf
                @method('PUT')

                <div
                    x-show="activeSection === 'general'"
                >
                    @include('admin.templates.partials.seactions.general')
                </div>

                <div
                    x-show="activeSection === 'header'"
                    style="display: none;"
                >
                    @include('admin.templates.partials.seactions.header')
                </div>

                <div
                    x-show="activeSection === 'hero'"
                    style="display: none;"
                >
                    @include('admin.templates.partials.seactions.hero')
                </div>

                <div
                    x-show="activeSection === 'products'"
                    style="display: none;"
                >
                    @include('admin.templates.partials.seactions.products')
                </div>

                <div
                    x-show="activeSection === 'contact'"
                    style="display: none;"
                >
                    @include('admin.templates.partials.seactions.contact')
                </div>

                <div
                    x-show="activeSection === 'footer'"
                    style="display: none;"
                >
                    @include('admin.templates.partials.seactions.footer')
                </div>

                <div
                    x-show="activeSection === 'seo'"
                    style="display: none;"
                >
                    @include('admin.templates.partials.seactions.seo')
                </div>

                <div
                    x-show="activeSection === 'appearance'"
                    style="display: none;"
                >
                    @include('admin.templates.partials.seactions.appearance')
                </div>

            </form>

        </main>

    </div>

</div>

@endsection