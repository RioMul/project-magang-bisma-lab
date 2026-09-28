@extends('admin.layouts.app')

@section('title', 'Websites')

@section('content')

<div class="w-full max-w-[1400px] space-y-6">

    @include('admin.websites.partials.website_summary')

    <div class="rounded-2xl border border-slate-100 bg-white shadow-sm">

        <div class="flex flex-col gap-4 border-b border-slate-100 px-5 py-5 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h1 class="text-base font-bold text-slate-800 sm:text-lg">
                    Website Directory
                </h1>

                <p class="mt-1 text-[10px] text-slate-400 sm:text-xs">
                    Monitor all websites created by clients.
                </p>

            </div>

            <div class="text-[10px] text-slate-400">
                {{ $websites->total() }} websites
            </div>

        </div>

        <div class="border-b border-slate-100 bg-slate-50/60 p-3">

            <form
                method="GET"
                action="{{ route('admin.websites.index') }}"
                class="flex flex-col gap-2.5 lg:flex-row"
            >

                <div class="relative flex-1">

                    <svg
                        class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <circle
                            cx="11"
                            cy="11"
                            r="7"
                        />

                        <path
                            stroke-linecap="round"
                            d="M21 21l-4.35-4.35"
                        />
                    </svg>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by domain, name, or email..."
                        class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-4 text-xs text-slate-700 outline-none transition focus:border-sky-300 focus:ring-2 focus:ring-sky-50"
                    >

                </div>

                <select
                    name="status"
                    onchange="this.form.submit()"
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-xs font-medium text-slate-600 outline-none lg:w-44"
                >

                    <option value="">
                        Status: All
                    </option>

                    <option
                        value="active"
                        @selected(request('status') === 'active')
                    >
                        Active
                    </option>

                    <option
                        value="published"
                        @selected(request('status') === 'published')
                    >
                        Published
                    </option>

                    <option
                        value="building"
                        @selected(request('status') === 'building')
                    >
                        Building
                    </option>

                    <option
                        value="expired"
                        @selected(request('status') === 'expired')
                    >
                        Expired
                    </option>

                </select>

                <button
                    type="submit"
                    class="rounded-xl bg-[#0879b9] px-5 py-3 text-xs font-semibold text-white transition hover:bg-[#075f91]"
                >
                    Search
                </button>

                @if(request()->hasAny(['search', 'status']))

                    <a
                        href="{{ route('admin.websites.index') }}"
                        class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-center text-xs font-semibold text-slate-500 transition hover:bg-slate-50"
                    >
                        Reset
                    </a>

                @endif

            </form>

        </div>

        @include('admin.websites.partials.website_table')

    </div>

</div>

@endsection