@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-center mb-12">
            <div class="flex items-center space-x-3 sm:space-x-4">
                <a href="{{ route('order.template') }}" class="flex items-center {{ session('order.template_id') ? 'text-emerald-600' : 'text-slate-400' }}">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full {{ session('order.template_id') ? 'bg-emerald-600 text-white' : 'bg-slate-200 text-slate-500' }} text-xs font-bold">{{ session('order.template_id') ? '✓' : '1' }}</span>
                    <span class="ml-2 text-xs font-semibold uppercase tracking-wider hidden sm:inline">Template</span>
                </a>
                <div class="w-8 sm:w-12 h-0.5 bg-slate-200"></div>

                <a href="{{ route('order.domain') }}" class="flex items-center {{ session('order.domain') ? 'text-emerald-600' : 'text-slate-400' }}">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full {{ session('order.domain') ? 'bg-emerald-600 text-white' : 'bg-slate-200 text-slate-500' }} text-xs font-bold">{{ session('order.domain') ? '✓' : '2' }}</span>
                    <span class="ml-2 text-xs font-semibold uppercase tracking-wider hidden sm:inline">Domain</span>
                </a>
                <div class="w-8 sm:w-12 h-0.5 bg-slate-200"></div>

                <div class="flex items-center text-sky-900">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-sky-900 text-white text-xs font-bold ring-4 ring-sky-100">3</span>
                    <span class="ml-2 text-xs font-bold uppercase tracking-wider">Paket</span>
                </div>
                <div class="w-8 sm:w-12 h-0.5 bg-slate-200"></div>

                <div class="flex items-center text-slate-400">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-200 text-slate-500 text-xs font-bold">4</span>
                    <span class="ml-2 text-xs font-semibold uppercase tracking-wider hidden sm:inline">Checkout</span>
                </div>
            </div>
        </div>

        <form id="packageForm" action="{{ route('order.package.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <div class="lg:col-span-5 space-y-6">
                    <div>
                        <h1 class="text-3xl font-extrabold text-slate-900 leading-tight">Choose Your<br><span class="text-sky-900">Growth Plan</span></h1>
                        <p class="text-slate-500 text-sm mt-2">Pilih paket langganan yang sesuai dengan kebutuhan bisnis Anda.</p>
                    </div>

                    @if($selectedTemplate)
                        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                            <div class="aspect-[16/10] bg-slate-900 rounded-xl overflow-hidden mb-4 relative">
                                <img src="{{ asset($selectedTemplate->images->where('is_primary', true)->first()->image_path ?? 'tech1.png') }}" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='{{ asset('tech1.png') }}';">
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <div>
                                    <span class="text-slate-400 uppercase font-medium">Selected Template</span>
                                    <p class="font-bold text-slate-800 text-sm mt-0.5">{{ $selectedTemplate->name }}</p>
                                </div>
                                <a href="{{ route('order.template') }}" class="text-sky-900 font-semibold hover:underline">Change →</a>
                            </div>
                        </div>
                    @endif

                    @if($selectedDomain)
                        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-4 text-xs flex items-center justify-between">
                            <div><span class="text-emerald-600 font-bold uppercase tracking-wider block">Domain Terpilih</span><span class="font-extrabold text-slate-800 text-sm">{{ $selectedDomain }}</span></div>
                            <a href="{{ route('order.domain') }}" class="text-emerald-700 font-bold hover:underline">Ubah →</a>
                        </div>
                    @endif
                </div>

                <div class="lg:col-span-7 space-y-4">
                    @foreach($packages as $pkg)
                        <label class="block relative cursor-pointer">
                            <input type="radio" name="package_id" value="{{ $pkg->id }}" class="peer sr-only" {{ ($selectedPackageId == $pkg->id || (!$selectedPackageId && $pkg->is_popular)) ? 'checked' : '' }}>
                            <div class="p-5 bg-white rounded-2xl border-2 border-slate-200 peer-checked:border-sky-900 peer-checked:bg-sky-50/20 transition-all shadow-sm">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center space-x-2">
                                        <h3 class="font-bold text-slate-900 text-lg">{{ $pkg->name }}</h3>
                                        @if($pkg->is_popular)<span class="bg-sky-100 text-sky-800 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider">Most Popular</span>@endif
                                    </div>
                                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 text-slate-700 peer-checked:bg-sky-900 peer-checked:text-white transition">Select</span>
                                </div>
                                <p class="text-xs text-slate-500 mb-4">{{ $pkg->short_description }}</p>
                                <div class="text-2xl font-extrabold text-slate-900 mb-5">Rp {{ number_format($pkg->price_annually, 0, ',', '.') }}<span class="text-xs font-normal text-slate-500">/tahun</span></div>
                                <ul class="space-y-3 border-t border-slate-100 pt-4">
                                    @foreach($pkg->features as $feature)
                                        <li class="flex items-center text-sm">
                                            @if($feature->pivot->is_included)
                                                <svg class="w-5 h-5 text-emerald-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                <span class="text-slate-700 font-medium">{{ $feature->name }} @if($feature->pivot->limit_value)<span class="font-bold text-slate-900">({{ $feature->pivot->limit_value }})</span>@endif</span>
                                            @else
                                                <svg class="w-5 h-5 text-slate-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                <span class="text-slate-400 line-through">{{ $feature->name }}</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </label>
                    @endforeach
                    <div class="pt-4 flex justify-end">
                        <button type="button" id="selectPackageButton" class="w-full sm:w-auto bg-sky-900 hover:bg-sky-800 text-white px-8 py-3 rounded-xl font-semibold text-sm shadow-md transition flex items-center justify-center space-x-2">
                            <span>Pilih Paket & Lanjutkan</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
const selectPackageButton = document.getElementById('selectPackageButton');
if (selectPackageButton) {
    selectPackageButton.addEventListener('click', function() {
        const selectedPackage = document.querySelector('input[name="package_id"]:checked');
        if (!selectedPackage) {
            alert('Silakan pilih paket terlebih dahulu.');
            return;
        }
        @if(session('order.template_id')) document.getElementById('packageForm').submit(); @else alert('Silakan pilih template terlebih dahulu!'); window.location.href="{{ route('order.template') }}"; @endif
    });
}
</script>
@endsection