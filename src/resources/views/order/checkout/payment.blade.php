<div class="mb-10 text-center sm:text-left">
    <h1 class="text-4xl font-light text-slate-800 tracking-tight mb-2">
        Complete your <span class="font-medium text-slate-900">purchase</span>
    </h1>

    <p class="text-slate-500 text-sm">
        Refine your digital presence with our handcrafted tools.
        Secure and seamless checkout for modern creators.
    </p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

    <div class="lg:col-span-7 space-y-6">

        <form
            action="{{ route('order.checkout.payment_method') }}"
            method="POST"
            id="selectPaymentForm">

            @csrf

            <div
                class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm"
                x-data="{ selected: 'bank_transfer' }">

                <h2 class="text-lg font-black text-slate-800 mb-6">
                    Payment Method
                </h2>

                <div class="space-y-4">

                    @php
                        $methods = [
                            'bank_transfer' => [
                                'name' => 'Bank Transfer (VA)',
                                'description' => 'BCA, Mandiri, BNI, BRI',
                            ],
                            'credit_card' => [
                                'name' => 'Credit Card',
                                'description' => 'Visa, Mastercard, JCB',
                            ],
                            'ewallet' => [
                                'name' => 'E-Wallet',
                                'description' => 'OVO, DANA, LinkAja',
                            ],
                            'qris' => [
                                'name' => 'QRIS',
                                'description' => 'Scan using any payment app',
                            ],
                        ];
                    @endphp

                    @foreach($methods as $value => $method)
                        <label
                            class="flex items-center justify-between p-5 rounded-2xl border-2 cursor-pointer transition-all"
                            :class="selected === '{{ $value }}'
                                ? 'border-[#0369a1] bg-sky-50/20'
                                : 'border-slate-100 hover:border-slate-200'"
                            @click="selected = '{{ $value }}'">

                            <div class="flex items-center gap-4">

                                <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center border border-slate-100">
                                    <span class="text-[#0369a1] font-bold">
                                        {{ strtoupper(substr($method['name'], 0, 1)) }}
                                    </span>
                                </div>

                                <div>
                                    <p class="font-bold text-slate-800 text-sm">
                                        {{ $method['name'] }}
                                    </p>

                                    <span class="text-xs text-slate-500 font-medium">
                                        {{ $method['description'] }}
                                    </span>
                                </div>

                            </div>

                            <div
                                class="w-5 h-5 rounded-full border-2 flex items-center justify-center"
                                :class="selected === '{{ $value }}'
                                    ? 'border-[#0369a1]'
                                    : 'border-slate-300'">

                                <div
                                    class="w-2.5 h-2.5 rounded-full bg-[#0369a1]"
                                    x-show="selected === '{{ $value }}'"
                                    x-cloak>
                                </div>

                            </div>

                            <input
                                type="radio"
                                name="payment_method"
                                value="{{ $value }}"
                                x-model="selected"
                                class="hidden">

                        </label>
                    @endforeach

                </div>

            </div>

        </form>

        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">

            <h3 class="font-black text-slate-800 text-lg mb-5">
                Secure Checkout
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div class="bg-slate-50 p-5 rounded-xl border border-slate-100">
                    <p class="font-bold text-slate-800 text-[13px]">
                        Encrypted Transaction
                    </p>

                    <p class="text-[11px] text-slate-500 mt-1.5 leading-relaxed">
                        Your transaction data is protected during checkout.
                    </p>
                </div>

                <div class="bg-slate-50 p-5 rounded-xl border border-slate-100">
                    <p class="font-bold text-slate-800 text-[13px]">
                        Verified Provider
                    </p>

                    <p class="text-[11px] text-slate-500 mt-1.5 leading-relaxed">
                        Transactions are processed securely.
                    </p>
                </div>

            </div>

        </div>

    </div>

    <div class="lg:col-span-5 sticky top-28">

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden p-8">

            <h2 class="text-xl font-black text-slate-800 mb-8">
                Order Summary
            </h2>

            <div class="flex items-center gap-4 mb-8">

                <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-900 shrink-0">

                    <img
                        src="{{ asset(
                            $template->images
                                ->where('is_primary', true)
                                ->first()
                                ->image_path ?? 'tech1.png'
                        ) }}"
                        class="w-full h-full object-cover">

                </div>

                <div>

                    <span class="text-[10px] text-[#0369a1] font-black uppercase tracking-wider">
                        Template
                    </span>

                    <h3 class="font-bold text-slate-800">
                        {{ $template->name }}
                    </h3>

                    <span class="text-[10px] text-slate-500">
                        Tahunan
                    </span>

                </div>

            </div>

            <div class="space-y-4 text-sm mb-6">

                <div class="flex justify-between gap-4">

                    <div>
                        <p class="font-bold text-slate-800">
                            {{ $package->name }} Plan
                        </p>

                        <p class="text-[10px] text-slate-400">
                            Billed Annually
                        </p>
                    </div>

                    <span class="font-bold text-slate-800">
                        Rp {{ number_format($package->price_annually, 0, ',', '.') }}
                    </span>

                </div>

                <div class="flex justify-between gap-4">

                    <div>
                        <p class="font-bold text-slate-800">
                            {{ $domain }}
                        </p>

                        <p class="text-[10px] text-slate-400">
                            Domain Registration (1yr)
                        </p>
                    </div>

                    <span class="font-bold text-slate-800">
                        Rp {{ number_format($domainPrice, 0, ',', '.') }}
                    </span>

                </div>

            </div>

            <hr class="border-slate-100 my-6">

            <div class="flex justify-between items-end mb-8 gap-4">

                <span class="font-bold text-slate-800">
                    Total Amount
                </span>

                <div class="text-2xl sm:text-3xl font-black text-[#0369a1]">
                    Rp {{ number_format($totalAmount, 0, ',', '.') }}
                </div>

            </div>

            <button
                type="button"
                onclick="document.getElementById('selectPaymentForm').submit()"
                class="w-full bg-[#0369a1] hover:bg-[#027ea8] text-white py-4 rounded-xl font-bold shadow-md transition">

                Pilih Metode & Lanjutkan

            </button>

        </div>

    </div>

</div>