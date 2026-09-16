@extends('admin.layouts.app')

@section('title', 'Edit Template')

@section('content')

<div class="max-w-4xl">

    <div class="mb-6">

        <a
            href="{{ route('admin.templates.index') }}"
            class="text-xs text-[#0879b9]">
            ← Templates
        </a>

        <h1 class="mt-3 text-2xl font-bold text-slate-800">
            Edit Template
        </h1>

    </div>

    <div class="bg-white rounded-xl border border-slate-100 p-6">

        <form
            method="POST"
            action="{{ route('admin.templates.update', $template) }}">

            @method('PUT')

            @include('admin.templates.form')

            <div class="mt-7 flex justify-end gap-3">

                <a
                    href="{{ route('admin.templates.index') }}"
                    class="px-4 py-2.5 rounded-lg border border-slate-200 text-xs">
                    Cancel
                </a>

                <button
                    class="px-4 py-2.5 rounded-lg bg-[#0879b9] text-white text-xs font-semibold">
                    Update Template
                </button>

            </div>

        </form>

    </div>

</div>

@endsection