<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
    <div class="lg:col-span-7">
        <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">
            <div class="p-6 sm:p-8 border-b border-slate-100">
                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 rounded-2xl bg-sky-50 text-[#0369a1] flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a5 5 0 00-10 0v2m-2 0h14l-1 11H6L5 9z"/>
                        </svg>
                    </div>

                    <div>
                        <p class="text-[10px] font-black uppercase tracking-[0.18em] text-[#0369a1]">
                            Payment Method
                        </p>
                        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">
                            Pilih Metode Pembayaran
                        </h1>
                        <p class="text-sm text-slate-500 mt-2">
                            Pilih metode pembayaran yang ingin Anda gunakan.
                        </p>
                    </div>
                </div>
            </div>

            <form
                action="{{ route('order.checkout.payment_method') }}"
                method="POST"
                x-data="{ selected: '{{ $paymentMethod ?? 'bank_transfer' }}' }"
            >
                @csrf

                <div class="p-6 sm:p-8 space-y-4">
                    @php
                        $methods = [
                            'bank_transfer' => [
                                'title' => 'Bank Transfer',
                                'description' => 'Transfer melalui rekening bank',
                            ],
                            'credit_card' => [
                                'title' => 'Credit Card',
                                'description' => 'Pembayaran menggunakan kartu',
                            ],
                            'ewallet' => [
                                'title' => 'E-Wallet',
                                'description' => 'Bayar menggunakan dompet digital',
                            ],
                            'qris' => [
                                'title' => 'QRIS',
                                'description' => 'Scan QR menggunakan aplikasi pembayaran',
                            ],
                        ];
                    @endphp

                    @foreach($methods as $method => $details)
                        <label
                            class="block cursor-pointer rounded-2xl border-2 p-5 transition"
                            :class="selected === '{{ $method }}'
                                ? 'border-[#0369a1] bg-sky-50/50'
                                : 'border-slate-200 hover:border-slate-300'"
                        >
                            <input
                                type="radio"
                                name="payment_method"
                                value="{{ $method }}"
                                x-model="selected"
                                class="hidden"
                            >

                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center text-[#0369a1] font-black">
                                        @switch($method)
                                            @case('bank_transfer')
                                                B
                                                @break
                                            @case('credit_card')
                                                K
                                                @break
                                            @case('ewallet')
                                                E
                                                @break
                                            @default
                                                Q
                                        @endswitch
                                    </div>

                                    <div>
                                        <p class="font-black text-slate-900">
                                            {{ $details['title'] }}
                                        </p>
                                        <p class="text-xs text-slate-500 mt-1">
                                            {{ $details['description'] }}
                                        </p>
                                    </div>
                                </div>

                                <div
                                    class="w-5 h-5 rounded-full border-2 flex items-center justify-center shrink-0"
                                    :class="selected === '{{ $method }}'
                                        ? 'border-[#0369a1]'
                                        : 'border-slate-300'"
                                >
                                    <div
                                        x-show="selected === '{{ $method }}'"
                                        class="w-2.5 h-2.5 rounded-full bg-[#0369a1]"
                                    ></div>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>

                <div class="px-6 sm:px-8 pb-8">
                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-[#0369a1] hover:bg-[#075985] text-white font-black py-4 px-6 transition shadow-lg shadow-sky-900/10"
                    >
                        Lanjutkan
                    </button>

                    <p class="text-[10px] text-slate-400 text-center mt-3">
                        Pilihan metode dicatat pada pesanan. Gateway pembayaran belum terhubung.
                    </p>
                </div>
            </form>
        </div>
    </div>

    <div class="lg:col-span-5">
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="h-56 sm:h-64 bg-slate-900 overflow-hidden">
                <img
                    src="{{ asset($template->images->where('is_primary', true)->first()?->image_path ?? 'tech1.png') }}"
                    alt="{{ $template->name }}"
                    class="w-full h-full object-cover"
                >
            </div>

            <div class="p-6 sm:p-7">
                <span class="text-[10px] text-[#0369a1] font-black uppercase tracking-[0.15em]">
                    Ringkasan Website
                </span>

                <h2 class="text-xl font-black text-slate-900 mt-1">
                    {{ $template->name }}
                </h2>

                <div class="mt-6 space-y-4">
                    <div class="flex justify-between gap-4 text-sm">
                        <div>
                            <p class="font-bold text-slate-800">Template</p>
                            <p class="text-[10px] text-slate-400 mt-1">
                                Dibayar sekali untuk website ini
                            </p>
                        </div>

                        <span class="font-bold text-slate-800 whitespace-nowrap">
                            Rp {{ number_format($templatePrice, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-4 text-sm">
                        <div>
                            <p class="font-bold text-slate-800">
                                {{ $package->name }}
                            </p>
                            <p class="text-[10px] text-slate-400 mt-1">
                                Paket {{ $billingPeriodMonths }} bulan
                            </p>
                        </div>

                        <span class="font-bold text-slate-800 whitespace-nowrap">
                            Rp {{ number_format($packagePrice, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-4 text-sm">
                        <div class="min-w-0">
                            <p class="font-bold text-slate-800 break-all">
                                {{ $domain }}
                            </p>
                            <p class="text-[10px] text-slate-400 mt-1">
                                Harga indikatif domain satu tahun
                            </p>
                        </div>

                        <span class="font-bold text-slate-800 whitespace-nowrap">
                            Rp {{ number_format($domainPrice, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <div class="border-t border-slate-100 mt-6 pt-5">
                    <div class="flex justify-between items-end gap-4">
                        <div>
                            <p class="text-xs font-bold text-slate-500">
                                Total Pembayaran
                            </p>
                            <p class="text-[10px] text-slate-400 mt-1">
                                Harga domain masih perkiraan katalog internal
                            </p>
                        </div>

                        <span class="text-2xl font-black text-[#0369a1] whitespace-nowrap">
                            Rp {{ number_format($totalAmount, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="px-6 sm:px-7 pb-7">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="rounded-2xl bg-slate-50 border border-slate-100 p-4">
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black mb-3">✓</div>
                        <p class="text-[11px] font-black text-slate-800">14 Day</p>
                        <p class="text-[10px] text-slate-500 mt-1">Guarantee</p>
                    </div>

                    <div class="rounded-2xl bg-slate-50 border border-slate-100 p-4">
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black mb-3">✓</div>
                        <p class="text-[11px] font-black text-slate-800">Secure</p>
                        <p class="text-[10px] text-slate-500 mt-1">Checkout</p>
                    </div>

                    <div class="rounded-2xl bg-slate-50 border border-slate-100 p-4">
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black mb-3">✓</div>
                        <p class="text-[11px] font-black text-slate-800">Status</p>
                        <p class="text-[10px] text-slate-500 mt-1">Menunggu verifikasi</p>
                    </div>
                </div>

                <div class="mt-4 rounded-2xl border border-slate-100 bg-slate-50 p-4">
                    <p class="text-xs font-black text-slate-800">
                        Informasi pembayaran
                    </p>
                    <p class="text-[10px] leading-relaxed text-slate-500 mt-1">
                        Pesanan akan berstatus menunggu sampai pembayaran diverifikasi. Pilihan metode di sini belum memproses transaksi secara otomatis.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>