<div class="max-w-5xl mx-auto">

    <form
        action="{{ route('order.checkout.reset_payment') }}"
        method="POST"
        class="mb-5"
    >
        @csrf

        <button
            type="submit"
            class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-[#0369a1] transition"
        >
            ← Ganti Metode Pembayaran
        </button>
    </form>

    <div class="mb-7">

        <h1 class="text-2xl sm:text-3xl font-black text-slate-900">
            Konfirmasi Pesanan
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Periksa kembali pesanan Anda sebelum melakukan pembayaran.
        </p>

    </div>

    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

        <div class="grid grid-cols-1 lg:grid-cols-12">

            <div class="lg:col-span-7 p-6 sm:p-8 lg:p-10">

                <div class="flex items-center gap-3 mb-7">

                    <div class="w-9 h-9 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        ✓
                    </div>

                    <div>
                        <p class="text-[10px] font-black uppercase tracking-wider text-emerald-600">
                            Pesanan Siap
                        </p>

                        <p class="text-sm font-bold text-slate-900">
                            Semua informasi sudah lengkap
                        </p>
                    </div>

                </div>

                <div class="space-y-6">

                    <div>

                        <p class="text-[10px] font-black uppercase tracking-wider text-slate-400 mb-3">
                            Akun
                        </p>

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-full bg-sky-50 text-[#0369a1] flex items-center justify-center font-black">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <div>
                                <p class="text-sm font-bold text-slate-900">
                                    {{ Auth::user()->name }}
                                </p>

                                <p class="text-xs text-slate-500">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>

                        </div>

                    </div>

                    <div class="border-t border-slate-100 pt-6">

                        <p class="text-[10px] font-black uppercase tracking-wider text-slate-400 mb-4">
                            Detail Pesanan
                        </p>

                        <div class="space-y-4">

                            <div class="flex justify-between gap-5">

                                <div>
                                    <p class="text-xs text-slate-500">
                                        Website Template
                                    </p>

                                    <p class="text-sm font-bold text-slate-900 mt-1">
                                        {{ $template->name }}
                                    </p>
                                </div>

                            </div>

                            <div class="flex justify-between gap-5">

                                <div>
                                    <p class="text-xs text-slate-500">
                                        Domain
                                    </p>

                                    <p class="text-sm font-bold text-slate-900 mt-1 break-all">
                                        {{ $domain }}
                                    </p>
                                </div>

                                <span class="text-sm font-bold text-slate-900 whitespace-nowrap">
                                    Rp {{ number_format($domainPrice, 0, ',', '.') }}
                                </span>

                            </div>

                            <div class="flex justify-between gap-5">

                                <div>
                                    <p class="text-xs text-slate-500">
                                        Paket
                                    </p>

                                    <p class="text-sm font-bold text-slate-900 mt-1">
                                        {{ $package->name }}
                                    </p>
                                </div>

                                <span class="text-sm font-bold text-slate-900 whitespace-nowrap">
                                    Rp {{ number_format($package->price_annually, 0, ',', '.') }}
                                </span>

                            </div>

                        </div>

                    </div>

                    <div class="border-t border-slate-100 pt-6">

                        <div class="flex justify-between items-center gap-5">

                            <div>

                                <p class="text-xs text-slate-500">
                                    Metode Pembayaran
                                </p>

                                <p class="text-sm font-bold text-slate-900 mt-1 uppercase">
                                    {{ str_replace('_', ' ', $paymentMethod) }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="lg:col-span-5 bg-slate-50 border-t lg:border-t-0 lg:border-l border-slate-200 p-6 sm:p-8 flex flex-col">

                <div class="mb-5">

                    <span class="text-[10px] font-black uppercase tracking-wider text-[#0369a1]">
                        Preview Website
                    </span>

                    <h2 class="text-xl font-black text-slate-900 mt-1">
                        {{ $template->name }}
                    </h2>

                </div>

                <div class="rounded-2xl overflow-hidden bg-slate-900 border border-slate-200 shadow-sm">

                    <img
                        src="{{ asset($template->images->where('is_primary', true)->first()?->image_path ?? 'tech1.png') }}"
                        alt="{{ $template->name }}"
                        class="w-full h-64 sm:h-72 object-cover"
                    >

                </div>

                <div class="mt-auto pt-7">

                    <div class="flex items-end justify-between gap-4 mb-5">

                        <div>

                            <p class="text-xs font-bold text-slate-500">
                                Total Pembayaran
                            </p>

                            <p class="text-2xl sm:text-3xl font-black text-[#0369a1] mt-1">
                                Rp {{ number_format($totalAmount, 0, ',', '.') }}
                            </p>

                        </div>

                    </div>

                    <form
                        action="{{ route('order.checkout.finalize') }}"
                        method="POST"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="w-full flex items-center justify-center gap-2 bg-[#0369a1] hover:bg-[#075985] text-white py-4 rounded-xl font-black shadow-md transition"
                        >
                            Bayar Sekarang

                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-5-5 5 5-5 5"/>
                            </svg>
                        </button>

                    </form>

                    <p class="text-[10px] text-slate-400 text-center mt-3">
                        Dengan melanjutkan, Anda menyetujui detail pesanan yang ditampilkan.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>