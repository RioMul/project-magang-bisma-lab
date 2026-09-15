<div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm mb-7">

    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">

        <div>
            <span class="text-[10px] font-bold uppercase tracking-wider text-[#0369a1]">
                Website Setup
            </span>

            @if($hasPendingOrder)

                <h2 class="text-lg font-bold text-slate-800 mt-2">
                    Pesanan Anda sedang diproses
                </h2>

                <p class="text-xs text-slate-500 mt-1 max-w-xl">
                    {{ $nextStepDescription }}
                </p>

            @elseif($completedSteps === 0)

                <h2 class="text-lg font-bold text-slate-800 mt-2">
                    Mulai buat website Anda
                </h2>

                <p class="text-xs text-slate-500 mt-1 max-w-xl">
                    Lengkapi beberapa langkah berikut untuk mulai menggunakan website Anda.
                </p>

            @elseif($completedSteps === 3)

                <h2 class="text-lg font-bold text-slate-800 mt-2">
                    Pesanan Anda hampir selesai
                </h2>

                <p class="text-xs text-slate-500 mt-1 max-w-xl">
                    Tinggal satu langkah lagi untuk menyelesaikan pemesanan website Anda.
                </p>

            @else

                <h2 class="text-lg font-bold text-slate-800 mt-2">
                    Lanjutkan pesanan website Anda
                </h2>

                <p class="text-xs text-slate-500 mt-1 max-w-xl">
                    {{ $nextStepDescription }}
                </p>

            @endif
        </div>

        @if($hasPendingOrder)

            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-amber-50 text-amber-600 text-[9px] font-bold uppercase shrink-0">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                Pending
            </span>

        @else

            <span class="text-xs font-semibold text-slate-400 shrink-0">
                {{ $completedSteps }}/{{ $totalSteps }} selesai
            </span>

        @endif

    </div>

    <div class="mt-6">

        <div class="flex items-center">

            <div class="flex items-center gap-2 flex-1">

                <div class="w-7 h-7 rounded-full flex items-center justify-center shrink-0
                    {{ $hasTemplate ? 'bg-[#0369a1] text-white' : 'bg-slate-100 text-slate-400' }}">

                    @if($hasTemplate)

                        <svg
                            class="w-3.5 h-3.5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2.5">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 13l4 4L19 7"/>

                        </svg>

                    @else

                        <span class="text-[10px] font-bold">
                            1
                        </span>

                    @endif

                </div>

                <span class="hidden sm:block text-[10px] font-semibold
                    {{ $hasTemplate ? 'text-slate-700' : 'text-slate-400' }}">
                    Template
                </span>

            </div>

            <div class="h-px flex-1 mx-2
                {{ $hasTemplate ? 'bg-[#0369a1]' : 'bg-slate-200' }}">
            </div>

            <div class="flex items-center gap-2 flex-1">

                <div class="w-7 h-7 rounded-full flex items-center justify-center shrink-0
                    {{ $hasDomain ? 'bg-[#0369a1] text-white' : 'bg-slate-100 text-slate-400' }}">

                    @if($hasDomain)

                        <svg
                            class="w-3.5 h-3.5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2.5">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 13l4 4L19 7"/>

                        </svg>

                    @else

                        <span class="text-[10px] font-bold">
                            2
                        </span>

                    @endif

                </div>

                <span class="hidden sm:block text-[10px] font-semibold
                    {{ $hasDomain ? 'text-slate-700' : 'text-slate-400' }}">
                    Domain
                </span>

            </div>

            <div class="h-px flex-1 mx-2
                {{ $hasDomain ? 'bg-[#0369a1]' : 'bg-slate-200' }}">
            </div>

            <div class="flex items-center gap-2 flex-1">

                <div class="w-7 h-7 rounded-full flex items-center justify-center shrink-0
                    {{ $hasPackage ? 'bg-[#0369a1] text-white' : 'bg-slate-100 text-slate-400' }}">

                    @if($hasPackage)

                        <svg
                            class="w-3.5 h-3.5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2.5">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 13l4 4L19 7"/>

                        </svg>

                    @else

                        <span class="text-[10px] font-bold">
                            3
                        </span>

                    @endif

                </div>

                <span class="hidden sm:block text-[10px] font-semibold
                    {{ $hasPackage ? 'text-slate-700' : 'text-slate-400' }}">
                    Paket
                </span>

            </div>

            <div class="h-px flex-1 mx-2
                {{ $hasPaymentMethod ? 'bg-[#0369a1]' : 'bg-slate-200' }}">
            </div>

            <div class="flex items-center gap-2">

                <div class="w-7 h-7 rounded-full flex items-center justify-center shrink-0
                    {{ $hasPaymentMethod ? 'bg-[#0369a1] text-white' : 'bg-slate-100 text-slate-400' }}">

                    @if($hasPaymentMethod)

                        <svg
                            class="w-3.5 h-3.5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2.5">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 13l4 4L19 7"/>

                        </svg>

                    @else

                        <span class="text-[10px] font-bold">
                            4
                        </span>

                    @endif

                </div>

                <span class="hidden sm:block text-[10px] font-semibold
                    {{ $hasPaymentMethod ? 'text-slate-700' : 'text-slate-400' }}">
                    Pembayaran
                </span>

            </div>

        </div>

        @if(!$hasPendingOrder)

            <div class="mt-4 h-1.5 bg-slate-100 rounded-full overflow-hidden">

                <div
                    class="h-full bg-[#0369a1] rounded-full transition-all duration-500"
                    style="width: {{ $progressPercentage }}%">
                </div>

            </div>

        @endif

    </div>

    @if($nextStepRoute)

        <div class="mt-6 pt-5 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                @if($hasPendingOrder)

                    <p class="text-xs font-semibold text-slate-700">
                        Menunggu verifikasi pembayaran
                    </p>

                    @if($pendingOrderExpiresAt)

                        <p class="text-[10px] text-slate-400 mt-1">
                            Batas proses:
                            {{ $pendingOrderExpiresAt->format('d M Y, H:i') }}
                        </p>

                    @endif

                @else

                    <p class="text-xs font-semibold text-slate-700">
                        {{ $nextStepDescription }}
                    </p>

                @endif

            </div>

            <a
                href="{{ $nextStepRoute }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-[#0369a1] hover:bg-[#075985] text-white text-xs font-semibold transition shadow-sm shrink-0">

                {{ $nextStepLabel }}

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

    @endif

</div>
