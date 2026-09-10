@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#f8fafc] py-12 pt-32">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-center mb-16">
            <div class="flex items-center space-x-3 sm:space-x-4">

                <a href="{{ route('order.template') }}" class="flex items-center flex-col relative">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#057A55] text-white text-xs font-bold">✓</span>
                    <span class="absolute top-10 text-[10px] font-bold uppercase text-[#057A55]">Template</span>
                </a>

                <div class="w-12 sm:w-20 h-[2px] bg-[#057A55] -mt-5"></div>

                <a href="{{ route('order.domain') }}" class="flex items-center flex-col relative">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#057A55] text-white text-xs font-bold">✓</span>
                    <span class="absolute top-10 text-[10px] font-bold uppercase text-[#057A55]">Domain</span>
                </a>

                <div class="w-12 sm:w-20 h-[2px] bg-[#057A55] -mt-5"></div>

                <div class="flex items-center flex-col relative">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#0369a1] text-white text-xs font-bold ring-4 ring-sky-100">3</span>
                    <span class="absolute top-10 text-[10px] font-bold uppercase text-[#0369a1]">Paket</span>
                </div>

                <div class="w-12 sm:w-20 h-[2px] bg-slate-200 -mt-5"></div>

                <div class="flex items-center flex-col relative">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-200 text-slate-400 text-xs font-bold">4</span>
                    <span class="absolute top-10 text-[10px] font-bold uppercase text-slate-400">Checkout</span>
                </div>

            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

            <div class="lg:col-span-5 space-y-6">

                <div>
                    <h1 class="text-4xl font-black text-slate-900 leading-tight tracking-tight">
                        Choose Your <br>Growth Plan
                    </h1>

                    <p class="text-slate-500 text-sm mt-3 leading-relaxed pr-4">
                        Unlock professional features and premium support tailored for your specific business goals.
                    </p>
                </div>

                @if($selectedTemplate)

                    <div class="bg-white rounded-3xl border border-slate-200 p-4 shadow-sm">

                        <div class="bg-slate-900 rounded-2xl overflow-hidden mb-4 relative aspect-[4/3]">
                            <img
                                src="{{ asset($selectedTemplate->images->where('is_primary', true)->first()?->image_path ?? 'tech1.png') }}"
                                class="w-full h-full object-cover"
                                alt="{{ $selectedTemplate->name }}"
                            >
                        </div>

                        <div class="px-2 pb-2">

                            <span class="text-[10px] text-[#0369a1] font-black uppercase tracking-wider">
                                Selected Template
                            </span>

                            <div class="flex items-center justify-between mt-1">

                                <h3 class="font-bold text-slate-900 text-lg">
                                    {{ $selectedTemplate->name }}
                                </h3>

                                <a
                                    href="{{ route('order.template') }}"
                                    class="text-xs font-bold text-[#0369a1] hover:underline flex items-center gap-1"
                                >
                                    Change

                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                                        />
                                    </svg>
                                </a>

                            </div>

                        </div>

                    </div>

                @endif

                @if($selectedDomain)

                    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm flex items-center justify-between">

                        <div>

                            <span class="text-[10px] text-[#057A55] font-black uppercase tracking-wider">
                                Selected Domain
                            </span>

                            <h3 class="font-bold text-slate-900 text-lg mt-1">
                                {{ $selectedDomain }}
                            </h3>

                        </div>

                        <a
                            href="{{ route('order.domain') }}"
                            class="w-10 h-10 rounded-full bg-slate-50 text-slate-400 hover:bg-sky-50 hover:text-[#0369a1] flex items-center justify-center transition"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15.232 5.232 3.536m12.728-2.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                />
                            </svg>
                        </a>

                    </div>

                @endif

            </div>

            <div class="lg:col-span-7 space-y-4 mt-6 lg:mt-0">

                @foreach($packages as $pkg)

                    <div
                        x-data="{ expanded: false }"
                        class="bg-white rounded-3xl border-2 transition-all duration-300 overflow-hidden {{ $pkg->is_popular ? 'shadow-md' : 'shadow-sm' }}"
                        :class="expanded ? 'border-[#0369a1]' : 'border-slate-100 hover:border-slate-300'"
                    >

                        @if($pkg->is_popular)

                            <div class="bg-sky-50 px-6 py-2 border-b border-sky-100 flex items-center gap-2">

                                <svg class="w-4 h-4 text-[#0369a1]" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>

                                <span class="text-[10px] font-black text-[#0369a1] uppercase tracking-wider">
                                    Most Popular
                                </span>

                            </div>

                        @endif

                        <div class="p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center justify-between gap-6">

                            <div class="flex-1">

                                <h3 class="font-black text-slate-900 text-xl">
                                    {{ $pkg->name }}
                                </h3>

                                <p class="text-xs text-slate-500 mt-1 mb-4">
                                    {{ $pkg->short_description }}
                                </p>

                                <div class="text-3xl font-black text-slate-900 flex items-end gap-1">
                                    Rp {{ number_format($pkg->price_monthly, 0, ',', '.') }}

                                    <span class="text-xs font-bold text-slate-400 mb-1.5">
                                        / thn
                                    </span>
                                </div>

                            </div>

                            <div class="flex flex-col items-end gap-3 shrink-0 w-full sm:w-auto">

                                <form
                                    action="{{ route('order.package.store') }}"
                                    method="POST"
                                    class="w-full sm:w-auto"
                                >
                                    @csrf

                                    <input
                                        type="hidden"
                                        name="package_id"
                                        value="{{ $pkg->id }}"
                                    >

                                    <button
                                        type="submit"
                                        class="w-full sm:w-auto px-8 py-3 rounded-xl font-bold text-sm transition bg-[#0369a1] hover:bg-[#027ea8] text-white shadow-sm"
                                    >
                                        Select {{ explode(' ', $pkg->name)[1] ?? $pkg->name }}
                                    </button>

                                </form>

                                <button
                                    type="button"
                                    @click="expanded = !expanded"
                                    class="text-[11px] font-bold text-slate-500 hover:text-slate-800 flex items-center gap-1 transition"
                                >
                                    <span x-text="expanded ? 'Hide Features' : 'View Features'"></span>

                                    <svg
                                        class="w-3 h-3 transition-transform duration-300"
                                        :class="expanded ? 'rotate-180' : ''"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="3"
                                            d="M19 9l-7 7-7-7"
                                        />
                                    </svg>

                                </button>

                            </div>

                        </div>

                        <div x-show="expanded" x-collapse x-cloak>

                            <div class="px-6 sm:px-8 pb-8 pt-2">

                                <div class="h-px w-full bg-slate-100 mb-6"></div>

                                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-6">

                                    @foreach($pkg->features as $feature)

                                        <li class="flex items-center text-sm">

                                            @if($feature->pivot->is_included)

                                                <svg
                                                    class="w-4 h-4 text-[#057A55] mr-2 shrink-0"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="3"
                                                        d="M5 13l4 4L19 7"
                                                    />
                                                </svg>

                                                <span class="text-slate-700 font-medium">
                                                    {{ $feature->name }}
                                                </span>

                                            @else

                                                <svg
                                                    class="w-4 h-4 text-red-400 mr-2 shrink-0"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="3"
                                                        d="M6 18L18 6M6 6l12 12"
                                                    />
                                                </svg>

                                                <span class="text-slate-400">
                                                    {{ $feature->name }}
                                                </span>

                                            @endif

                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

@endsection