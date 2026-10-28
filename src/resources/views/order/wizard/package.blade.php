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

        @if(session('error'))
            <div class="mb-6 p-4 rounded-2xl border border-rose-200 bg-rose-50 text-rose-700 text-sm font-bold">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-5 space-y-6">
                <div>
                    <h1 class="text-4xl font-black text-slate-900 leading-tight tracking-tight">
                        Pilih Paket Website
                    </h1>
                    <p class="text-slate-500 text-sm mt-3 leading-relaxed">
                        Pilih masa paket. Semua kartu paket akan menampilkan harga untuk periode yang dipilih.
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
                                Template Terpilih
                            </span>
                            <div class="flex items-center justify-between mt-1">
                                <h3 class="font-bold text-slate-900 text-lg">
                                    {{ $selectedTemplate->name }}
                                </h3>
                                <a href="{{ route('order.template') }}"
                                   class="text-xs font-bold text-[#0369a1] hover:underline">
                                    Ganti
                                </a>
                            </div>
                            <p class="text-sm text-slate-500 mt-2">
                                Harga sekali per website:
                                <strong class="text-slate-800">
                                    Rp {{ number_format((float) $selectedTemplate->price, 0, ',', '.') }}
                                </strong>
                            </p>
                        </div>
                    </div>
                @endif

                @if($selectedDomain)
                    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
                        <span class="text-[10px] text-[#057A55] font-black uppercase tracking-wider">
                            Domain Terpilih
                        </span>
                        <h3 class="font-bold text-slate-900 text-lg mt-1">
                            {{ $selectedDomain }}
                        </h3>
                        <p class="text-xs text-slate-500 mt-1">
                            Perkiraan tahunan:
                            Rp {{ number_format((float) $selectedDomainPrice, 0, ',', '.') }}
                        </p>
                        <a href="{{ route('order.domain') }}"
                           class="inline-block text-xs font-bold text-[#0369a1] hover:underline mt-2">
                            Ganti domain
                        </a>
                    </div>
                @endif
            </div>

            <div
                class="lg:col-span-7 space-y-5 mt-6 lg:mt-0"
                x-data="{ period: {{ in_array((int) $selectedBillingPeriodMonths, [1, 6, 12], true) ? (int) $selectedBillingPeriodMonths : 12 }} }"
            >
                <div class="bg-white rounded-3xl border border-slate-200 p-5 sm:p-6 shadow-sm">
                    <p class="text-xs font-black uppercase tracking-wider text-slate-500 mb-4">
                        Periode Berlangganan
                    </p>

                    <div class="grid grid-cols-3 gap-2 p-1.5 rounded-2xl bg-slate-100">
                        <button
                            type="button"
                            @click="period = 1"
                            :class="period === 1 ? 'bg-white text-[#0369a1] shadow-sm' : 'text-slate-500 hover:text-slate-800'"
                            class="py-3 px-2 rounded-xl text-xs sm:text-sm font-black transition"
                        >
                            1 Bulan
                        </button>

                        <button
                            type="button"
                            @click="period = 6"
                            :class="period === 6 ? 'bg-white text-[#0369a1] shadow-sm' : 'text-slate-500 hover:text-slate-800'"
                            class="py-3 px-2 rounded-xl text-xs sm:text-sm font-black transition"
                        >
                            6 Bulan
                        </button>

                        <button
                            type="button"
                            @click="period = 12"
                            :class="period === 12 ? 'bg-white text-[#0369a1] shadow-sm' : 'text-slate-500 hover:text-slate-800'"
                            class="py-3 px-2 rounded-xl text-xs sm:text-sm font-black transition"
                        >
                            1 Tahun
                        </button>
                    </div>

                    <p class="text-[11px] text-slate-400 mt-3">
                        Enam bulan dihitung setengah harga tahunan. Biaya domain tetap tahunan.
                    </p>
                </div>

                @foreach($packages as $pkg)
                    @php
                        $monthlyPrice = (float) $pkg->price_monthly;
                        $annualPrice = (float) $pkg->price_annually;
                        $sixMonthPrice = round($annualPrice / 2, 2);
                    @endphp

                    <div
                        x-data="{ expanded: false }"
                        class="bg-white rounded-3xl border-2 overflow-hidden {{ $pkg->is_popular ? 'shadow-md' : 'shadow-sm' }}"
                        :class="expanded ? 'border-[#0369a1]' : 'border-slate-100 hover:border-slate-300'"
                    >
                        @if($pkg->is_popular)
                            <div class="bg-sky-50 px-6 py-2 border-b border-sky-100">
                                <span class="text-[10px] font-black text-[#0369a1] uppercase tracking-wider">
                                    Paling Populer
                                </span>
                            </div>
                        @endif

                        <div class="p-6 sm:p-8">
                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                                <div>
                                    <h2 class="font-black text-slate-900 text-xl">
                                        {{ $pkg->name }}
                                    </h2>
                                    <p class="text-xs text-slate-500 mt-1">
                                        {{ $pkg->short_description }}
                                    </p>
                                </div>

                                <div class="sm:text-right">
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider"
                                       x-text="period === 1 ? 'Per bulan' : (period === 6 ? '6 bulan' : '1 tahun')">
                                    </p>
                                    <p class="text-2xl font-black text-slate-900 mt-1">
                                        Rp
                                        <span
                                            x-text="new Intl.NumberFormat('id-ID').format(
                                                period === 1
                                                    ? {{ json_encode($monthlyPrice) }}
                                                    : (period === 6
                                                        ? {{ json_encode($sixMonthPrice) }}
                                                        : {{ json_encode($annualPrice) }})
                                            )"
                                        ></span>
                                    </p>
                                </div>
                            </div>

                            <form
                                action="{{ route('order.package.store') }}"
                                method="POST"
                                class="mt-5"
                            >
                                @csrf
                                <input type="hidden" name="package_id" value="{{ $pkg->id }}">
                                <input type="hidden" name="billing_period_months" :value="period">

                                <button
                                    type="submit"
                                    class="w-full px-6 py-3.5 rounded-xl font-bold text-sm bg-[#0369a1] hover:bg-[#075985] text-white transition shadow-sm"
                                >
                                    Pilih {{ $pkg->name }}
                                </button>
                            </form>

                            <button
                                type="button"
                                @click="expanded = !expanded"
                                class="mt-4 text-[11px] font-bold text-slate-500 hover:text-slate-800 flex items-center gap-1"
                            >
                                <span x-text="expanded ? 'Sembunyikan fitur' : 'Lihat fitur'"></span>
                                <svg
                                    class="w-3 h-3 transition-transform"
                                    :class="expanded ? 'rotate-180' : ''"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="expanded" x-collapse x-cloak class="pt-5">
                                <div class="h-px bg-slate-100 mb-5"></div>
                                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-6">
                                    @foreach($pkg->features as $feature)
                                        <li class="flex items-center text-sm">
                                            @if($feature->pivot->is_included)
                                                <span class="text-emerald-600 mr-2">✓</span>
                                                <span class="text-slate-700 font-medium">{{ $feature->name }}</span>
                                            @else
                                                <span class="text-rose-400 mr-2">×</span>
                                                <span class="text-slate-400">{{ $feature->name }}</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach

                @error('billing_period_months')
                    <p class="text-sm text-rose-600">{{ $message }}</p>
                @enderror

                @error('package_id')
                    <p class="text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection