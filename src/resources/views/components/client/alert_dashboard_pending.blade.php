<div class="mb-8 bg-amber-50 border border-amber-100 rounded-2xl px-5 py-4 sm:px-6 sm:py-5 shadow-sm">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div class="flex items-start gap-3">
            <div class="w-9 h-9 rounded-lg bg-white text-amber-600 flex items-center justify-center shrink-0 shadow-sm">
                <svg
                    class="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v4M12 17h.01"/>
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10.3 4.3L2.8 17a2 2 0 001.7 3h15a2 2 0 001.7-3L13.7 4.3a2 2 0 00-3.4 0z"/>
                </svg>
            </div>

            <div>
                <h2 class="text-sm font-bold text-slate-800">
                    Website Anda belum aktif
                </h2>

                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                    Anda sudah memulai proses pembuatan website.
                    Selesaikan pembayaran untuk mengaktifkan website dan membuka seluruh fitur Client Area.
                </p>
            </div>
        </div>

        <a
            href="{{ $pendingPaymentUrl ?? '#' }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-[#0369a1] hover:bg-[#075985] text-white text-xs font-semibold transition shrink-0 shadow-sm">
            Lanjutkan Pembayaran
            <svg
                class="w-3.5 h-3.5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 5l7 7-7 7"/>
            </svg>
        </a>

    </div>
</div>