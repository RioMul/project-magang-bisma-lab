<div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm mt-2">
    <div class="flex items-center justify-between border-b border-slate-50 px-8 py-6">
        <h2 class="text-lg font-bold text-slate-900">
            Payment History
        </h2>
        <a href="{{ route('admin.billing.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-[#0369a1] hover:text-[#075985] transition">
            Download All
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[720px] text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-100 bg-white text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    <th class="px-8 py-5">Invoice ID</th>
                    <th class="px-8 py-5">Date</th>
                    <th class="px-8 py-5">Amount</th>
                    <th class="px-8 py-5">Status</th>
                    <th class="px-8 py-5 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($user->orders as $order)
                    @php
                        $payment = $order->payment;
                        $paymentStatus = $payment?->status ?? $order->status ?? 'unpaid';
                        
                        $paymentClass = match ($paymentStatus) {
                            'paid' => 'bg-emerald-50 text-emerald-600 border border-emerald-100',
                            'pending' => 'bg-amber-50 text-amber-600 border border-amber-100',
                            'failed', 'expired' => 'bg-rose-50 text-rose-600 border border-rose-100',
                            default => 'bg-slate-100 text-slate-600 border border-slate-200',
                        };
                        
                        $paymentLabel = match ($paymentStatus) {
                            'paid' => 'Paid',
                            'pending' => 'Pending',
                            'failed' => 'Failed',
                            'expired' => 'Expired',
                            default => 'Unpaid',
                        };
                    @endphp
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-8 py-5">
                            <span class="text-sm font-bold text-slate-800">
                                #{{ $order->order_number }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-sm font-medium text-slate-500">
                            {{ $order->created_at->format('d M Y') }}
                        </td>
                        <td class="px-8 py-5 text-sm font-bold text-slate-800">
                            Rp {{ number_format($payment?->amount_paid ?? $order->total_amount, 0, ',', '.') }}
                        </td>
                        <td class="px-8 py-5">
                            <span class="inline-flex rounded-md px-3 py-1 text-[10px] font-black uppercase tracking-wider {{ $paymentClass }}">
                                {{ $paymentLabel }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center rounded-lg border border-slate-200 bg-white px-4 py-2 text-xs font-bold text-[#0369a1] hover:bg-sky-50 transition shadow-sm">
                                View Invoice
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-8 py-10 text-center">
                            <p class="text-sm font-medium text-slate-400">
                                Belum ada riwayat pembayaran.
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($user->orders->count() > 0)
        <div class="px-8 py-5 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-slate-500 bg-slate-50/50 rounded-b-2xl">
            <p>
                Showing {{ $user->orders->count() }} most recent transaction{{ $user->orders->count() > 1 ? 's' : '' }}
            </p>
            <div class="flex gap-2">
                <button class="w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center hover:bg-slate-50 shadow-sm text-slate-600">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button class="w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center hover:bg-slate-50 shadow-sm text-slate-600">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    @endif
</div>