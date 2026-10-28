<div class="overflow-x-auto">
    <table class="w-full min-w-[1050px] border-collapse text-left">
        <thead>
            <tr class="border-b border-slate-100 bg-white text-[10px] font-bold uppercase tracking-wider text-slate-400">
                <th class="px-8 py-5">Order ID</th>
                <th class="px-8 py-5">Customer</th>
                <th class="px-8 py-5">Plan</th>
                <th class="px-8 py-5">Amount</th>
                <th class="px-8 py-5">Date</th>
                <th class="px-8 py-5">Status</th>
                <th class="px-8 py-5 text-right">Action</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-slate-50">
            @forelse($payments as $payment)
                @php
                    $order = $payment->order;

                    $statusClass = match ($payment->status) {
                        'paid' => 'border border-emerald-100 bg-emerald-50 text-emerald-600',
                        'pending' => 'border border-sky-100 bg-sky-50 text-sky-600',
                        'failed', 'expired' => 'border border-rose-100 bg-rose-50 text-rose-600',
                        default => 'border border-slate-200 bg-slate-100 text-slate-600',
                    };

                    $dotClass = match ($payment->status) {
                        'paid' => 'bg-emerald-500',
                        'pending' => 'bg-sky-500',
                        'failed', 'expired' => 'bg-rose-500',
                        default => 'bg-slate-500',
                    };

                    $customerName = $order?->customer_name
                        ?? $order?->user?->name
                        ?? 'User';

                    $initials = collect(explode(' ', $customerName))
                        ->map(fn ($name) => substr($name, 0, 1))
                        ->take(2)
                        ->join('');

                    $colors = [
                        'bg-sky-100 text-sky-600',
                        'bg-emerald-100 text-emerald-600',
                        'bg-amber-100 text-amber-600',
                        'bg-rose-100 text-rose-600',
                    ];

                    $randomColor = $colors[strlen($customerName) % count($colors)];
                    $orderItem = $order?->orderItems?->first();
                @endphp

                <tr class="transition hover:bg-slate-50/50">
                    <td class="px-8 py-5">
                        @if($order)
                            <a
                                href="{{ route('admin.orders.show', [
                                    'order' => $order,
                                    'return_to' => 'billing',
                                    'return_query' => http_build_query(request()->query()),
                                ]) }}"
                                onclick="sessionStorage.setItem('adminBillingScrollY', String(window.scrollY))"
                                class="text-sm font-bold text-slate-800 transition hover:text-[#0369a1]">
                                #BSM-{{ $order->order_number }}
                            </a>
                        @else
                            <span class="text-sm font-bold text-slate-800">
                                #BSM-{{ $payment->id }}
                            </span>
                        @endif
                    </td>

                    <td class="px-8 py-5">
                        <div class="flex items-center gap-3">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-xs font-bold uppercase {{ $randomColor }}">
                                {{ $initials }}
                            </div>

                            <div class="min-w-0">
                                <p class="truncate text-sm font-bold text-slate-700">
                                    {{ $customerName }}
                                </p>
                                <p class="max-w-[180px] truncate text-[11px] font-medium text-slate-400">
                                    {{ $order?->customer_email ?? $order?->user?->email ?? '—' }}
                                </p>
                            </div>
                        </div>
                    </td>

                    <td class="px-8 py-5">
                        <span class="inline-flex items-center rounded-full border border-slate-100 bg-slate-50 px-3 py-1 text-[10px] font-bold uppercase tracking-wide text-[#0369a1]">
                            {{ $orderItem?->package?->name ?? $order?->package?->name ?? 'Paket —' }}
                        </span>
                    </td>

                    <td class="px-8 py-5">
                        <span class="text-sm font-bold text-slate-800">
                            Rp {{ number_format((float) ($payment->amount_paid ?? $order?->total_amount ?? 0), 0, ',', '.') }}
                        </span>
                    </td>

                    <td class="px-8 py-5">
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-slate-500">
                                {{ $payment->created_at?->format('M d,') }}
                            </span>
                            <span class="text-sm font-medium text-slate-500">
                                {{ $payment->created_at?->format('Y') }}
                            </span>
                        </div>
                    </td>

                    <td class="px-8 py-5">
                        <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-[10px] font-black uppercase tracking-wider shadow-sm {{ $statusClass }}">
                            <span class="h-1.5 w-1.5 rounded-full {{ $dotClass }}"></span>
                            {{ $payment->status === 'pending' ? 'Processing' : ucfirst($payment->status) }}
                        </span>
                    </td>

                    <td class="px-8 py-5 text-right">
                        <form
                            method="POST"
                            action="{{ route('admin.billing.status', $payment) }}"
                            class="flex items-center justify-end gap-2">
                            @csrf
                            @method('PATCH')

                            <select
                                name="status"
                                class="cursor-pointer rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-[10px] font-bold text-slate-600 shadow-sm outline-none focus:border-[#0369a1]">
                                <option value="pending" @selected($payment->status === 'pending')>Processing</option>
                                <option value="paid" @selected($payment->status === 'paid')>Paid</option>
                                <option value="failed" @selected($payment->status === 'failed')>Failed</option>
                                <option value="expired" @selected($payment->status === 'expired')>Expired</option>
                            </select>

                            <button
                                type="submit"
                                class="rounded-xl bg-[#0369a1] px-3 py-1.5 text-[10px] font-bold text-white shadow-sm transition hover:bg-[#075985]">
                                Update
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-8 py-12 text-center">
                        <div class="text-sm font-bold text-slate-800">
                            Belum ada transaksi pembayaran.
                        </div>
                        <p class="mt-1 text-xs text-slate-500">
                            Payment dari proses checkout akan muncul di sini.
                        </p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($payments->hasPages())
    <div class="flex flex-col items-center justify-between gap-4 rounded-b-3xl border-t border-slate-100 bg-slate-50/50 px-8 py-5 text-xs font-bold uppercase tracking-wider text-slate-500 sm:flex-row">
        <span>
            Showing {{ $payments->firstItem() ?? 0 }}-{{ $payments->lastItem() ?? 0 }}
            of {{ number_format($payments->total()) }} transactions
        </span>

        <div class="w-full sm:w-auto">
            {{ $payments->links() }}
        </div>
    </div>
@endif