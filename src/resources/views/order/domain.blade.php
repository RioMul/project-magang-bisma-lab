@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8fafc] py-12 pt-32">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- STEPPER --}}
        <div class="flex items-center justify-center mb-16">
            <div class="flex items-center space-x-3 sm:space-x-4">
                <a href="{{ route('order.template') }}" class="flex items-center flex-col relative">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#057A55] text-white text-xs font-bold">✓</span>
                    <span class="absolute top-10 text-[10px] font-bold uppercase text-[#057A55]">Template</span>
                </a>
                <div class="w-12 sm:w-20 h-[2px] bg-[#057A55] -mt-5"></div>

                <div class="flex items-center flex-col relative">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#0369a1] text-white text-xs font-bold ring-4 ring-sky-100">2</span>
                    <span class="absolute top-10 text-[10px] font-bold uppercase text-[#0369a1]">Domain</span>
                </div>
                <div class="w-12 sm:w-20 h-[2px] bg-slate-200 -mt-5"></div>

                <div class="flex items-center flex-col relative">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-200 text-slate-400 text-xs font-bold">3</span>
                    <span class="absolute top-10 text-[10px] font-bold uppercase text-slate-400">Paket</span>
                </div>
                <div class="w-12 sm:w-20 h-[2px] bg-slate-200 -mt-5"></div>

                <div class="flex items-center flex-col relative">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-200 text-slate-400 text-xs font-bold">4</span>
                    <span class="absolute top-10 text-[10px] font-bold uppercase text-slate-400">Bayar</span>
                </div>
            </div>
        </div>

        <div class="text-center max-w-2xl mx-auto mb-10">
            <h1 class="text-4xl font-extrabold text-slate-900 leading-tight">
                Find the perfect name for your <br><span class="text-[#0369a1]">next big idea</span>
            </h1>
            <p class="text-slate-500 text-sm mt-4">Secure your digital identity in seconds. Simple, transparent pricing with no hidden fees.</p>
        </div>

        <div class="max-w-3xl mx-auto mb-6">
            <form action="{{ route('order.domain') }}" method="GET" class="relative flex items-center shadow-sm rounded-xl bg-white border border-slate-200 overflow-hidden">
                <span class="pl-5 text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" name="q" value="{{ $searchQuery }}" placeholder="namabisnis.com" class="w-full pl-3 pr-4 py-4 text-base border-none focus:ring-0">
                <button type="submit" class="bg-[#0369a1] hover:bg-[#027ea8] text-white font-bold px-8 py-3 rounded-lg mr-1.5 transition">Search</button>
            </form>
        </div>

        <div class="flex items-center justify-center gap-6 text-[11px] font-bold text-slate-500 mb-16">
            <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-[#0369a1]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Instant Activation</span>
            <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-[#0369a1]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg> Privacy Protection</span>
            <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-[#0369a1]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg> 24/7 Support</span>
        </div>

        @if(count($domainResults) > 0)
            <div class="max-w-3xl mx-auto mb-20">
                <div class="flex justify-between items-end mb-4">
                    <div>
                        <h2 class="text-xl font-extrabold text-slate-900">Available Extensions</h2>
                        <p class="text-xs text-slate-500">Best matches for your search</p>
                    </div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">SORTED BY POPULARITY</span>
                </div>

                <div class="space-y-4">
                    @foreach($domainResults as $result)
                        <div class="bg-white border border-slate-200 rounded-2xl p-5 flex items-center justify-between shadow-sm hover:shadow-md transition">
                            <div class="flex items-center gap-5">
                                <div class="w-16 h-12 rounded-lg {{ $result['popular'] ? 'bg-sky-50 text-[#0369a1]' : 'bg-slate-50 text-slate-500' }} flex items-center justify-center font-black text-lg border {{ $result['popular'] ? 'border-sky-100' : 'border-slate-200' }}">
                                    {{ $result['ext'] }}
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-900 text-lg">{{ $result['domain'] }}</h3>
                                    <p class="text-xs text-slate-500">
                                        {{ $result['ext'] === '.com' ? 'The gold standard for business' : ($result['ext'] === '.id' ? 'Perfect for Indonesian brands' : 'Ideal for network & tech projects') }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-6">
                                <div class="text-right">
                                    <div class="font-black text-slate-900 text-lg">Rp {{ number_format($result['price'], 0, ',', '.') }}</div>
                                    <div class="text-[10px] text-slate-400 uppercase font-bold">per year</div>
                                </div>
                                <form action="{{ route('order.domain.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="selected_domain" value="{{ $result['domain'] }}">
                                    <input type="hidden" name="domain_price" value="{{ $result['price'] }}">
                                    <button type="submit" class="px-6 py-2.5 rounded-lg font-bold text-sm transition bg-[#0369a1] hover:bg-[#027ea8] text-white shadow-sm">
                                        Select
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto border-t border-slate-200 pt-16 pb-10">
            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
                <div class="w-12 h-12 bg-sky-50 text-[#0369a1] rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Domain Privacy</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Protect your personal info from spammers and scammers with built-in WHOIS privacy protection.</p>
            </div>
            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Easy Setup</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Connect your domain to your Bisma Labs project with a single click. No DNS headaches.</p>
            </div>
            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Auto-Renewal</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Never lose your brand. We'll handle renewals automatically so you can focus on growing.</p>
            </div>
        </div>

    </div>
</div>
@endsection