<div class="overflow-x-auto">
    <table class="w-full min-w-[1050px] text-left border-collapse">
        <thead>
            <tr class="text-[10px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100 bg-white">
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
                    
                    // Logic Styling Status
                    $statusClass = match($payment->status) {
                        'paid' => 'bg-emerald-50 border border-emerald-100 text-emerald-600',
                        'pending' => 'bg-sky-50 border border-sky-100 text-sky-600',
                        'failed', 'expired' => 'bg-rose-50 border border-rose-100 text-rose-600',
                        default => 'bg-slate-100 border border-slate-200 text-slate-600',
                    };
                    $dotClass = match($payment->status) {
                        'paid' => 'bg-emerald-500',
                        'pending' => 'bg-sky-500',
                        'failed', 'expired' => 'bg-rose-500',
                        default => 'bg-slate-500',
                    };

                    // Logic Inisial Avatar & Warna
                    $customerName = $order?->customer_name ?? $order?->user?->name ?? 'User';
                    $initials = collect(explode(' ', $customerName))->map(fn($n) => substr($n, 0, 1))->take(2)->join('');
                    $colors = ['bg-sky-100 text-sky-600', 'bg-emerald-100 text-emerald-600', 'bg-amber-100 text-amber-600', 'bg-rose-100 text-rose-600'];
                    $randomColor = $colors[strlen($customerName) % 4];
                @endphp
                <tr class="hover:bg-slate-50/50 transition">
                    {{-- Order ID --}}
                    <td class="px-8 py-5">
                        <a href="{{ route('admin.orders.show', $order ?? 0) }}" class="text-sm font-bold text-slate-800 hover:text-[#0369a1] transition">
                            #BSM-{{ $order?->order_number ?? $payment->id }}
                        </a>
                    </td>

                    {{-- Customer Avatar & Text --}}
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-bold uppercase {{ $randomColor }} shrink-0">
                                {{ $initials }}
                            </div>
                            <div class="min-w-0">
                                <p class="truncate text-sm font-bold text-slate-700">
                                    {{ $customerName }}
                                </p>
                                <p class="max-w-[180px] truncate text-[11px] font-medium text-slate-400">
                                    {{ $order?->customer_email ?? $order?->user?->email ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </td>

                    {{-- Plan --}}
                    <td class="px-8 py-5">
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-50 border border-slate-100 text-[#0369a1] text-[10px] font-bold uppercase tracking-wide">
                            Plan {{ $order?->package?->name ?? '-' }}
                        </span>
                    </td>

                    {{-- Amount --}}
                    <td class="px-8 py-5">
                        <span class="text-sm font-bold text-slate-800">
                            Rp {{ number_format($payment->amount_paid ?? $order?->total_amount ?? 0, 0, ',', '.') }}
                        </span>
                    </td>

                    {{-- Date --}}
                    <td class="px-8 py-5">
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-slate-500">{{ $payment->created_at?->format('M d,') }}</span>
                            <span class="text-sm font-medium text-slate-500">{{ $payment->created_at?->format('Y') }}</span>
                        </div>
                    </td>

                    {{-- Status Badge --}}
                    <td class="px-8 py-5">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider shadow-sm {{ $statusClass }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $dotClass }}"></span>
                            {{ $payment->status === 'pending' ? 'Processing' : ucfirst($payment->status) }}
                        </span>
                    </td>

                    {{-- Action (Update Status Form) --}}
                    <td class="px-8 py-5 text-right">
                        <form method="POST" action="{{ route('admin.billing.status', $payment) }}" class="flex items-center justify-end gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-[10px] font-bold text-slate-600 outline-none shadow-sm focus:border-[#0369a1] cursor-pointer">
                                <option value="pending" @selected($payment->status === 'pending')>Processing</option>
                                <option value="paid" @selected($payment->status === 'paid')>Paid</option>
                                <option value="failed" @selected($payment->status === 'failed')>Failed</option>
                                <option value="expired" @selected($payment->status === 'expired')>Expired</option>
                            </select>
                            <button type="submit" class="rounded-xl bg-[#0369a1] hover:bg-[#075985] px-3 py-1.5 text-[10px] font-bold text-white transition shadow-sm">
                                Update
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-8 py-12 text-center">
                        <div class="text-sm font-bold text-slate-800">Belum ada transaksi pembayaran.</div>
                        <p class="mt-1 text-xs text-slate-500">Payment yang dibuat dari proses checkout akan muncul di sini.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($payments->hasPages())
    <div class="px-8 py-5 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-bold text-slate-500 uppercase tracking-wider bg-slate-50/50 rounded-b-3xl">
        <span>Showing {{ $payments->firstItem() ?? 0 }}-{{ $payments->lastItem() ?? 0 }} of {{ number_format($payments->total()) }} transactions</span>
        <div class="w-full sm:w-auto">
            {{ $payments->links() }}
        </div>
    </div>
@endif