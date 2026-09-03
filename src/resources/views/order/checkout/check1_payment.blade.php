<div class="mb-10 text-center sm:text-left">
    <h1 class="text-4xl font-light text-slate-800 tracking-tight mb-2">
        Complete your <span class="font-medium text-slate-900">purchase</span>
    </h1>
    <p class="text-slate-500 text-sm">Refine your digital presence with our handcrafted tools. Secure and seamless checkout for modern creators.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
    {{-- KIRI: FORM PILIH BANK --}}
    <div class="lg:col-span-7 space-y-6">
        <form action="{{ route('order.checkout.payment_method') }}" method="POST" id="selectPaymentForm">
            @csrf
            <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm" x-data="{ selected: 'bank_transfer' }">
                <h2 class="text-lg font-black text-slate-800 mb-6 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-sky-50 text-[#0369a1] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    Payment Method
                </h2>
                
                <div class="space-y-4">
                    <label class="flex items-center justify-between p-5 rounded-2xl border-2 cursor-pointer transition-all" :class="selected === 'bank_transfer' ? 'border-[#0369a1] bg-sky-50/20' : 'border-slate-100 hover:border-slate-200'" @click="selected = 'bank_transfer'">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center shrink-0 border border-slate-100"><svg class="w-6 h-6 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11m16-11v11M8 14v3m4-3v3m4-3v3"/></svg></div>
                            <div><p class="font-bold text-slate-800 text-sm">Bank Transfer (VA)</p><span class="text-xs text-slate-500 font-medium">BCA, Mandiri, BNI, BRI</span></div>
                        </div>
                        <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition-colors" :class="selected === 'bank_transfer' ? 'border-[#0369a1]' : 'border-slate-300'"><div class="w-2.5 h-2.5 rounded-full bg-[#0369a1]" x-show="selected === 'bank_transfer'" x-cloak></div></div>
                        <input type="radio" name="payment_method" value="bank_transfer" x-model="selected" class="hidden">
                    </label>

                    <label class="flex items-center justify-between p-5 rounded-2xl border-2 cursor-pointer transition-all" :class="selected === 'credit_card' ? 'border-[#0369a1] bg-sky-50/20' : 'border-slate-100 hover:border-slate-200'" @click="selected = 'credit_card'">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center shrink-0 border border-slate-100"><svg class="w-6 h-6 text-[#0369a1]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg></div>
                            <div><p class="font-bold text-slate-800 text-sm">Credit Card</p><span class="text-xs text-slate-500 font-medium">Visa, Mastercard, JCB</span></div>
                        </div>
                        <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition-colors" :class="selected === 'credit_card' ? 'border-[#0369a1]' : 'border-slate-300'"><div class="w-2.5 h-2.5 rounded-full bg-[#0369a1]" x-show="selected === 'credit_card'" x-cloak></div></div>
                        <input type="radio" name="payment_method" value="credit_card" x-model="selected" class="hidden">
                    </label>

                    <label class="flex items-center justify-between p-5 rounded-2xl border-2 cursor-pointer transition-all" :class="selected === 'ewallet' ? 'border-[#0369a1] bg-sky-50/20' : 'border-slate-100 hover:border-slate-200'" @click="selected = 'ewallet'">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center shrink-0 border border-slate-100"><svg class="w-6 h-6 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg></div>
                            <div><p class="font-bold text-slate-800 text-sm">E-Wallet</p><span class="text-xs text-slate-500 font-medium">OVO, DANA, LinkAja</span></div>
                        </div>
                        <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition-colors" :class="selected === 'ewallet' ? 'border-[#0369a1]' : 'border-slate-300'"><div class="w-2.5 h-2.5 rounded-full bg-[#0369a1]" x-show="selected === 'ewallet'" x-cloak></div></div>
                        <input type="radio" name="payment_method" value="ewallet" x-model="selected" class="hidden">
                    </label>

                    <label class="flex items-center justify-between p-5 rounded-2xl border-2 cursor-pointer transition-all" :class="selected === 'qris' ? 'border-[#0369a1] bg-sky-50/20' : 'border-slate-100 hover:border-slate-200'" @click="selected = 'qris'">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center shrink-0 border border-slate-100"><svg class="w-6 h-6 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg></div>
                            <div><p class="font-bold text-slate-800 text-sm">QRIS</p><span class="text-xs text-slate-500 font-medium">Scan using any payment app</span></div>
                        </div>
                        <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition-colors" :class="selected === 'qris' ? 'border-[#0369a1]' : 'border-slate-300'"><div class="w-2.5 h-2.5 rounded-full bg-[#0369a1]" x-show="selected === 'qris'" x-cloak></div></div>
                        <input type="radio" name="payment_method" value="qris" x-model="selected" class="hidden">
                    </label>
                </div>
            </div>
        </form>

        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
            <h3 class="font-black text-slate-800 text-lg mb-5 flex items-center gap-3">
                <svg class="w-6 h-6 text-[#0369a1]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                Secure Checkout
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-slate-50 p-5 rounded-xl border border-slate-100">
                    <p class="font-bold text-slate-800 text-[13px]">Encrypted Transaction</p>
                    <p class="text-[11px] text-slate-500 mt-1.5 leading-relaxed">Your data is protected by industry-standard 256-bit SSL encryption for 100% security.</p>
                </div>
                <div class="bg-slate-50 p-5 rounded-xl border border-slate-100">
                    <p class="font-bold text-slate-800 text-[13px]">Verified Provider</p>
                    <p class="text-[11px] text-slate-500 mt-1.5 leading-relaxed">Transactions are processed securely via world-class payment gateways.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- KANAN: RINGKASAN PESANAN SIMPLE --}}
    <div class="lg:col-span-5 sticky top-28 space-y-6">
        <div class="flex items-center justify-end text-[11px] font-bold text-emerald-600 gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg> Sesi Aman & Terenkripsi
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden p-8">
            <h2 class="text-xl font-black text-slate-800 mb-8">Order Summary</h2>
            
            <div class="flex items-center space-x-4 mb-8">
                <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-900 flex-shrink-0">
                    <img src="{{ asset($template->images->where('is_primary', true)->first()->image_path ?? 'tech1.png') }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <span class="text-[10px] text-[#0369a1] font-black uppercase tracking-wider">Template</span>
                    <h3 class="font-bold text-slate-800 mt-0.5">{{ $template->name }}</h3>
                    <span class="text-[10px] text-slate-500">Tahunan</span>
                </div>
            </div>

            <div class="space-y-4 text-sm mb-6">
                <div class="flex justify-between items-start">
                    <div><p class="font-bold text-slate-800">{{ $package->name }} Plan</p><p class="text-[10px] text-slate-400">Billed Annually</p></div>
                    <span class="font-bold text-slate-800">Rp {{ number_format($package->price_annually, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-start">
                    <div><p class="font-bold text-slate-800">{{ $domain }}</p><p class="text-[10px] text-slate-400">Domain Registration (1yr)</p></div>
                    <span class="font-bold text-slate-800">Rp {{ number_format($domainPrice, 0, ',', '.') }}</span>
                </div>
            </div>

            <hr class="border-slate-100 my-6">

            <div class="flex justify-between items-end mb-8">
                <span class="font-bold text-slate-800">Total Amount</span>
                <div class="text-3xl font-black text-[#0369a1]">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
            </div>

            <button onclick="document.getElementById('selectPaymentForm').submit()" class="w-full bg-[#0369a1] hover:bg-[#027ea8] text-white py-4 rounded-xl font-bold shadow-md transition flex items-center justify-center gap-2 mb-6">
                Pilih Bank & Lanjutkan <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>

            <div class="flex items-center justify-center gap-8 text-[10px] font-bold text-slate-400 uppercase">
                <span class="flex flex-col items-center gap-1.5"><svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg> SSL SECURE</span>
                <span class="flex flex-col items-center gap-1.5"><svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> GUARANTEED</span>
            </div>
        </div>

        <div class="bg-slate-100 rounded-2xl p-5 text-center shadow-sm">
            <p class="text-[10px] text-slate-500 leading-relaxed">
                <strong class="text-slate-700">14-Day Money-Back Guarantee:</strong> If you're not satisfied with Bisma Labs, contact us for a full refund. No questions asked.
            </p>
        </div>
    </div>
</div>