<div class="max-w-4xl mx-auto">

    <form
        action="{{ route('order.checkout.reset_payment') }}"
        method="POST"
        class="mb-6">

        @csrf

        <button
            type="submit"
            class="text-sm font-bold text-slate-500 hover:text-[#0369a1]">

            ← Ganti Metode Pembayaran

        </button>

    </form>

    <div class="mb-8">

        <h1 class="text-3xl font-black text-slate-900">
            Konfirmasi Pesanan
        </h1>

        <p class="text-slate-500 text-sm mt-1">
            Pastikan seluruh detail pesanan sudah sesuai.
        </p>

    </div>

    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

        <div class="relative h-64 bg-slate-900">

            <img
                src="{{ asset(
                    $template->images
                        ->where('is_primary', true)
                        ->first()
                        ->image_path ?? 'tech1.png'
                ) }}"
                class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent flex items-end p-8">

                <div>

                    <span class="text-xs font-bold text-sky-300 uppercase">
                        Template Terpilih
                    </span>

                    <h2 class="text-3xl font-black text-white mt-1">
                        {{ $template->name }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="p-6 sm:p-10">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">

                <div class="bg-slate-50 rounded-2xl p-5">

                    <p class="text-xs text-slate-400 uppercase font-bold">
                        Akun
                    </p>

                    <p class="font-bold text-slate-900 mt-2">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="text-sm text-slate-500">
                        {{ Auth::user()->email }}
                    </p>

                </div>

                <div class="bg-slate-50 rounded-2xl p-5">

                    <p class="text-xs text-slate-400 uppercase font-bold">
                        Pembayaran
                    </p>

                    <p class="font-bold text-slate-900 mt-2 uppercase">
                        {{ str_replace('_', ' ', session('order.payment_method')) }}
                    </p>

                </div>

            </div>

            <h3 class="font-black text-lg text-slate-800 mb-4">
                Rincian Layanan
            </h3>

            <div class="border border-slate-200 rounded-2xl overflow-hidden mb-8">

                <div class="p-5 flex justify-between gap-4 border-b border-slate-100">

                    <div>

                        <p class="font-bold text-slate-900">
                            {{ $domain }}
                        </p>

                        <p class="text-xs text-slate-400">
                            Domain Registration (1 Tahun)
                        </p>

                    </div>

                    <span class="font-bold whitespace-nowrap">
                        Rp {{ number_format($domainPrice, 0, ',', '.') }}
                    </span>

                </div>

                <div class="p-5 flex justify-between gap-4">

                    <div>

                        <p class="font-bold text-slate-900">
                            {{ $package->name }} Plan
                        </p>

                        <p class="text-xs text-slate-400">
                            Paket Tahunan
                        </p>

                    </div>

                    <span class="font-bold whitespace-nowrap">
                        Rp {{ number_format($package->price_annually, 0, ',', '.') }}
                    </span>

                </div>

            </div>

            <div class="bg-slate-50 rounded-2xl p-6 flex flex-col sm:flex-row justify-between items-center gap-5">

                <div class="text-center sm:text-left">

                    <p class="text-xs font-bold text-slate-500 uppercase">
                        Total Dibayar
                    </p>

                    <p class="text-3xl font-black text-[#0369a1] mt-1">
                        Rp {{ number_format($totalAmount, 0, ',', '.') }}
                    </p>

                </div>

                <form
                    action="{{ route('order.checkout.finalize') }}"
                    method="POST"
                    class="w-full sm:w-auto">

                    @csrf

                    <button
                        type="submit"
                        class="w-full sm:w-auto px-10 py-4 bg-[#0369a1] hover:bg-[#027ea8] text-white rounded-xl font-black">

                        Bayar Sekarang

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>