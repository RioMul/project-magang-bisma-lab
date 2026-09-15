<div class="bg-white border border-slate-200 rounded-2xl shadow-sm">

    <div class="px-6 py-5 border-b border-slate-100">

        <div class="flex items-center justify-between">

            <div>
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    Activity
                </p>

                <h2 class="text-lg font-bold text-slate-800 mt-1">
                    Recent Activity
                </h2>
            </div>

            <a
                href="{{ route('client.billing.index') }}"
                class="text-xs font-semibold text-[#0369a1] hover:text-[#075985] transition">
                Billing
            </a>

        </div>

    </div>

    <div class="p-6">

        @if($orders->count())

            <div class="space-y-4">

                @foreach($orders->take(5) as $order)

                    <div class="flex items-center justify-between gap-4 py-3 border-b border-slate-100 last:border-0">

                        <div class="flex items-center gap-3 min-w-0">

                            <div class="w-9 h-9 rounded-xl bg-slate-50 flex items-center justify-center shrink-0">

                                <svg
                                    class="w-4 h-4 text-slate-500"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2">

                                    <rect
                                        x="4"
                                        y="4"
                                        width="16"
                                        height="16"
                                        rx="2"/>

                                    <path
                                        stroke-linecap="round"
                                        d="M8 9h8M8 13h6M8 17h4"/>

                                </svg>

                            </div>

                            <div class="min-w-0">

                                <p class="text-xs font-semibold text-slate-700 truncate">
                                    {{ $order->order_number }}
                                </p>

                                <p class="text-[10px] text-slate-400 mt-1">
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </p>

                            </div>

                        </div>

                        <div class="shrink-0">

                            @if($order->status === 'paid')

                                <span class="inline-flex px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-[9px] font-bold uppercase">
                                    Paid
                                </span>

                            @elseif($order->status === 'pending')

                                <span class="inline-flex px-2.5 py-1 rounded-lg bg-amber-50 text-amber-600 text-[9px] font-bold uppercase">
                                    Pending
                                </span>

                            @elseif($order->status === 'expired')

                                <span class="inline-flex px-2.5 py-1 rounded-lg bg-slate-100 text-slate-500 text-[9px] font-bold uppercase">
                                    Expired
                                </span>

                            @else

                                <span class="inline-flex px-2.5 py-1 rounded-lg bg-slate-100 text-slate-500 text-[9px] font-bold uppercase">
                                    {{ ucfirst($order->status) }}
                                </span>

                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="py-8 text-center">

                <p class="text-sm font-semibold text-slate-500">
                    Belum ada aktivitas.
                </p>

                <p class="text-xs text-slate-400 mt-1">
                    Aktivitas pesanan Anda akan muncul di sini.
                </p>

            </div>

        @endif

    </div>

</div>
