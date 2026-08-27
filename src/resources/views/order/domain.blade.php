@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-xs font-bold rounded-r-xl shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 text-xs font-bold rounded-r-xl shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-center mb-12">
            <div class="flex items-center space-x-3 sm:space-x-4">

                <a href="{{ route('order.template') }}"
                   class="flex items-center {{ session('order.template_id') ? 'text-emerald-600' : 'text-slate-400' }}">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full {{ session('order.template_id') ? 'bg-emerald-600 text-white' : 'bg-slate-200 text-slate-500' }} text-xs font-bold">
                        @if(session('order.template_id'))
                            ✓
                        @else
                            1
                        @endif
                    </span>
                    <span class="ml-2 text-xs font-semibold uppercase tracking-wider hidden sm:inline">
                        Template
                    </span>
                </a>

                <div class="w-8 sm:w-12 h-0.5 bg-slate-200"></div>

                <div class="flex items-center text-sky-900">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-sky-900 text-white text-xs font-bold ring-4 ring-sky-100">
                        2
                    </span>
                    <span class="ml-2 text-xs font-bold uppercase tracking-wider">
                        Domain
                    </span>
                </div>

                <div class="w-8 sm:w-12 h-0.5 bg-slate-200"></div>

                <a href="{{ route('order.package') }}"
                   class="flex items-center text-slate-400">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-200 text-slate-500 text-xs font-bold">
                        {{ session('order.package_id') ? '✓' : '3' }}
                    </span>
                    <span class="ml-2 text-xs font-semibold uppercase tracking-wider hidden sm:inline">
                        Paket
                    </span>
                </a>

                <div class="w-8 sm:w-12 h-0.5 bg-slate-200"></div>

                <div class="flex items-center text-slate-400">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-200 text-slate-500 text-xs font-bold">
                        4
                    </span>
                    <span class="ml-2 text-xs font-semibold uppercase tracking-wider hidden sm:inline">
                        Checkout
                    </span>
                </div>

            </div>
        </div>

        <div class="text-center max-w-xl mx-auto mb-8">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Cek Ketersediaan
                <span class="text-sky-900">Domain Anda</span>
            </h1>

            @if($selectedTemplate)
                <p class="text-slate-500 text-sm mt-2">
                    Template terpilih:
                    <span class="font-bold text-slate-800">
                        {{ $selectedTemplate->name }}
                    </span>
                </p>
            @else
                <p class="text-slate-500 text-sm mt-2">
                    Anda bebas mencari dan melihat harga domain terlebih dahulu.
                </p>
            @endif
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm space-y-6">

            <form action="{{ route('order.domain') }}"
                  method="GET"
                  class="flex gap-3">

                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 font-bold text-sm">
                        www.
                    </span>

                    <input
                        type="text"
                        name="q"
                        value="{{ $searchQuery ?? '' }}"
                        placeholder="contoh: tokombakhars"
                        required
                        class="w-full pl-14 pr-4 py-3 bg-white border border-slate-300 rounded-xl text-sm focus:ring-sky-900 focus:border-sky-900 font-medium"
                    >
                </div>

                <button type="submit"
                        class="bg-sky-900 hover:bg-sky-800 text-white font-bold text-xs uppercase tracking-wider px-6 py-3 rounded-xl shadow-sm transition">
                    Cek Domain
                </button>

            </form>

            @if(!empty($domainResults))

                <div class="pt-4 border-t border-slate-100 space-y-3">

                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">
                        Hasil Pengecekan untuk "{{ $searchQuery }}"
                    </h3>

                    <form id="domainForm"
                          action="{{ route('order.domain.store') }}"
                          method="POST"
                          class="space-y-3">

                        @csrf

                        @foreach($domainResults as $res)

                            <label class="flex items-center justify-between p-4 rounded-xl border {{ $res['available'] ? 'border-slate-200 bg-white hover:border-sky-900 cursor-pointer' : 'border-red-100 bg-red-50/40 opacity-75' }} transition">

                                <div class="flex items-center space-x-3">

                                    @if($res['available'])

                                        <input
                                            type="radio"
                                            name="selected_domain"
                                            value="{{ $res['domain'] }}"
                                            data-price="{{ $res['price'] }}"
                                            class="domain-radio text-sky-900 focus:ring-sky-900"
                                        >

                                    @else

                                        <span class="w-5 h-5 flex items-center justify-center rounded-full bg-red-100 text-red-600 text-xs font-bold">
                                            ✕
                                        </span>

                                    @endif

                                    <div>
                                        <p class="font-bold text-slate-900 text-sm">
                                            {{ $res['domain'] }}
                                        </p>

                                        <span class="text-xs {{ $res['available'] ? 'text-emerald-600 font-semibold' : 'text-red-500 font-medium' }}">
                                            {{ $res['available'] ? 'Tersedia' : 'Sudah dimiliki orang lain / Tidak tersedia' }}
                                        </span>
                                    </div>

                                </div>

                                <div class="text-right">

                                    @if($res['available'])

                                        <span class="text-sm font-extrabold text-slate-900">
                                            Rp {{ number_format($res['price'], 0, ',', '.') }}
                                        </span>

                                        <span class="text-[10px] text-slate-400 block">
                                            /tahun
                                        </span>

                                    @else

                                        <span class="text-xs font-bold text-red-400 uppercase tracking-wider">
                                            Terpakai
                                        </span>

                                    @endif

                                </div>

                            </label>

                        @endforeach

                        <input
                            type="hidden"
                            name="domain_price"
                            id="domain_price_input"
                        >

                        <div class="flex items-center justify-between pt-4">

                            <a href="{{ route('order.template') }}"
                               class="text-xs font-bold text-slate-500 hover:text-slate-800">
                                ← Lihat Template
                            </a>

                            <button type="button"
                                    id="selectDomainButton"
                                    class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider px-8 py-3 rounded-xl shadow-sm transition">
                                Pilih Domain →
                            </button>

                        </div>

                    </form>

                </div>

            @endif

            <div class="pt-4 text-center">
                <a href="{{ route('order.package') }}"
                   class="text-xs font-bold text-sky-900 hover:underline">
                    Atau lihat semua paket harga →
                </a>
            </div>

        </div>

    </div>
</div>

<div id="domainWarningModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 px-4">

    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl">

        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-amber-100 text-amber-600 text-xl mb-4">
            !
        </div>

        <h3 class="text-lg font-extrabold text-slate-900">
            Pilih Template Terlebih Dahulu
        </h3>

        <p class="text-sm text-slate-500 mt-2 leading-relaxed">
            Anda tetap dapat melihat harga dan mencari domain, tetapi untuk melanjutkan pesanan Anda harus memilih template terlebih dahulu.
        </p>

        <div class="flex gap-3 mt-6">

            <button type="button"
                    id="closeDomainWarning"
                    class="flex-1 border border-slate-200 hover:bg-slate-50 text-slate-600 py-3 rounded-xl text-xs font-bold">
                Lanjut Browsing
            </button>

            <a href="{{ route('order.template') }}"
               class="flex-1 bg-sky-900 hover:bg-sky-800 text-white text-center py-3 rounded-xl text-xs font-bold">
                Pilih Template
            </a>

        </div>

    </div>
</div>

<script>
document.querySelectorAll('.domain-radio').forEach(function(radio) {
    radio.addEventListener('change', function() {
        document.getElementById('domain_price_input').value =
            this.dataset.price;
    });
});

const selectDomainButton =
    document.getElementById('selectDomainButton');

const domainWarningModal =
    document.getElementById('domainWarningModal');

const closeDomainWarning =
    document.getElementById('closeDomainWarning');

if (selectDomainButton) {
    selectDomainButton.addEventListener('click', function() {
        const selectedDomain =
            document.querySelector(
                'input[name="selected_domain"]:checked'
            );

        if (!selectedDomain) {
            alert('Silakan pilih domain terlebih dahulu.');
            return;
        }

        @if(session('order.template_id'))
            document.getElementById('domainForm').submit();
        @else
            domainWarningModal.classList.remove('hidden');
            domainWarningModal.classList.add('flex');
        @endif
    });
}

if (closeDomainWarning) {
    closeDomainWarning.addEventListener('click', function() {
        domainWarningModal.classList.add('hidden');
        domainWarningModal.classList.remove('flex');
    });
}
</script>
@endsection