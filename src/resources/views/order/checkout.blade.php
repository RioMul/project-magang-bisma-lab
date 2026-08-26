@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8fafc] py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Stepper Component -->
        <div class="flex items-center justify-center mb-16">
            <div class="flex items-center space-x-3 sm:space-x-4">
                <div class="flex items-center flex-col relative">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#057A55] text-white text-xs font-bold z-10 relative">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </span>
                    <span class="absolute top-10 text-[10px] font-bold uppercase tracking-wider text-[#057A55]">Template</span>
                </div>
                <div class="w-12 sm:w-20 h-[2px] bg-[#057A55] -mt-5"></div>

                <div class="flex items-center flex-col relative">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#057A55] text-white text-xs font-bold z-10 relative">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </span>
                    <span class="absolute top-10 text-[10px] font-bold uppercase tracking-wider text-[#057A55]">Domain</span>
                </div>
                <div class="w-12 sm:w-20 h-[2px] bg-[#057A55] -mt-5"></div>

                <div class="flex items-center flex-col relative">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#057A55] text-white text-xs font-bold z-10 relative">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </span>
                    <span class="absolute top-10 text-[10px] font-bold uppercase tracking-wider text-[#057A55]">Paket</span>
                </div>
                <div class="w-12 sm:w-20 h-[2px] bg-[#057A55] -mt-5"></div>

                <div class="flex items-center flex-col relative">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#0369a1] text-white text-xs font-bold ring-4 ring-sky-100 z-10 relative">4</span>
                    <span class="absolute top-10 text-[10px] font-bold uppercase tracking-wider text-[#0369a1]">Checkout</span>
                </div>
            </div>
        </div>

        <!-- Header Title -->
        <div class="max-w-6xl mx-auto mb-10">
            <h1 class="text-4xl font-light text-slate-800 tracking-tight mb-2">
                Complete your <span class="font-medium text-slate-900">purchase</span>
            </h1>
            <p class="text-slate-500 text-sm max-w-lg leading-relaxed">
                Refine your digital presence with our handcrafted tools. Secure and seamless checkout for modern creators.
            </p>
        </div>

        <form action="{{ route('order.checkout.process') }}" method="POST">
            @csrf

            <!-- PENAMPIL ERROR JIKA ADA -->
            @if ($errors->any())
                <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm font-bold rounded-r-xl shadow-sm">
                    <ul class="list-disc list-inside px-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

                <!-- SISI KIRI: METODE PEMBAYARAN -->
                <div class="lg:col-span-7 space-y-6">
                    
                    <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-8 h-8 bg-sky-50 text-[#0369a1] rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <h2 class="text-lg font-bold text-slate-800">Payment Method</h2>
                        </div>

                        <div class="space-y-3">
                            <!-- Bank Transfer -->
                            <label class="flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:bg-sky-50/50 cursor-pointer transition group">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-10 bg-slate-100 rounded flex items-center justify-center text-slate-500 group-hover:text-[#0369a1] transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm">Bank Transfer (VA)</p>
                                        <span class="text-[11px] text-slate-500">BCA, Mandiri, BNI, BRI</span>
                                    </div>
                                </div>
                                <input type="radio" name="payment_method" value="bank_transfer" class="w-6 h-6 text-[#0369a1] border-slate-300 focus:ring-[#0369a1] bg-slate-50 cursor-pointer" checked>
                            </label>

                            <!-- Credit Card -->
                            <label class="flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:bg-sky-50/50 cursor-pointer transition group">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-10 bg-slate-100 rounded flex items-center justify-center text-slate-500 group-hover:text-[#0369a1] transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm">Credit Card</p>
                                        <span class="text-[11px] text-slate-500">Visa, Mastercard, JCB</span>
                                    </div>
                                </div>
                                <input type="radio" name="payment_method" value="credit_card" class="w-6 h-6 text-[#0369a1] border-slate-300 focus:ring-[#0369a1] bg-slate-50 cursor-pointer">
                            </label>

                            <!-- E-Wallet -->
                            <label class="flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:bg-sky-50/50 cursor-pointer transition group">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-10 bg-slate-100 rounded flex items-center justify-center text-slate-500 group-hover:text-[#0369a1] transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm">E-Wallet</p>
                                        <span class="text-[11px] text-slate-500">OVO, DANA, LinkAja</span>
                                    </div>
                                </div>
                                <input type="radio" name="payment_method" value="ewallet" class="w-6 h-6 text-[#0369a1] border-slate-300 focus:ring-[#0369a1] bg-slate-50 cursor-pointer">
                            </label>

                            <!-- QRIS -->
                            <label class="flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:bg-sky-50/50 cursor-pointer transition group">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-10 bg-slate-100 rounded flex items-center justify-center text-slate-500 group-hover:text-[#0369a1] transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm">QRIS</p>
                                        <span class="text-[11px] text-slate-500">Scan using any payment app</span>
                                    </div>
                                </div>
                                <input type="radio" name="payment_method" value="qris" class="w-6 h-6 text-[#0369a1] border-slate-300 focus:ring-[#0369a1] bg-slate-50 cursor-pointer">
                            </label>
                        </div>
                    </div>

                    <!-- Box Secure Checkout -->
                    <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
                        <div class="flex items-center space-x-3 mb-5">
                            <div class="text-[#0369a1]">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <h3 class="font-bold text-slate-800 text-lg">Secure Checkout</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                                <p class="font-semibold text-slate-800 text-[13px] mb-1">Encrypted Transaction</p>
                                <p class="text-[11px] text-slate-500 leading-relaxed">Your data is protected by industry-standard 256-bit SSL encryption for 100% security.</p>
                            </div>
                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                                <p class="font-semibold text-slate-800 text-[13px] mb-1">Verified Provider</p>
                                <p class="text-[11px] text-slate-500 leading-relaxed">Transactions are processed securely via world-class payment gateways.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SISI KANAN: ORDER SUMMARY -->
                <div class="lg:col-span-5 sticky top-6">
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                        
                        <div class="p-8 space-y-8">
                            <h2 class="text-lg font-bold text-slate-800">Order Summary</h2>

                            <!-- Thumbnail Section -->
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-900 flex-shrink-0">
                                    <img src="{{ asset($template->preview_image ?? 'tech1.png') }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-[#0369a1] uppercase tracking-wider">Template</span>
                                    <h4 class="font-bold text-slate-800 text-sm mt-0.5">{{ $template->name ?? 'Artisan Bakehouse' }}</h4>
                                    <span class="text-[11px] text-slate-500">Tahunan</span>
                                </div>
                            </div>

                            <hr class="border-slate-100">

                            <!-- Line Items -->
                            <div class="space-y-4 text-sm">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $package->name ?? 'Professional Plan' }}</p>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Billed Annually</p>
                                    </div>
                                    <span class="font-bold text-slate-800">Rp {{ number_format($package->price ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $domain ?? 'namabisnis.com' }}</p>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Domain Registration (1yr)</p>
                                    </div>
                                    <span class="font-bold text-slate-800">Rp {{ number_format($domainPrice ?? 150000, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <hr class="border-slate-100">

                            <!-- Total -->
                            <div class="flex justify-between items-end">
                                <span class="font-bold text-slate-800 text-base mb-1">Total Amount</span>
                                <div class="text-right">
                                    <span class="font-extrabold text-[#0369a1] text-3xl block">Rp {{ number_format(($package->price ?? 0) + ($domainPrice ?? 150000), 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <!-- Button -->
                            <button type="submit" class="w-full bg-[#0369a1] hover:bg-[#0284c7] text-white font-bold text-sm py-4 rounded-xl shadow-md transition-colors flex items-center justify-center space-x-2">
                                <span>Bayar Sekarang</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>

                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection