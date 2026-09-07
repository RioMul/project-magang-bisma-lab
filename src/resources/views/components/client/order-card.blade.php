@props(['order'])

<div class="px-6 py-5">

    <div class="flex items-start justify-between gap-3">

        <div class="min-w-0">

            <p class="text-sm font-semibold text-slate-800 truncate">
                {{ $order->order_number }}
            </p>

            <p class="text-xs text-slate-400 mt-1">
                {{ $order->package->name ?? 'Package' }}
            </p>

        </div>

        <span class="shrink-0 px-2.5 py-1 rounded-full text-[10px] font-semibold
            {{ $order->status === 'paid'
                ? 'bg-emerald-100 text-emerald-700'
                : 'bg-amber-100 text-amber-700' }}">

            {{ ucfirst($order->status ?? 'Pending') }}

        </span>

    </div>

    <div class="mt-3 flex items-center justify-between">

        <span class="text-xs text-slate-400">
            {{ $order->created_at?->format('d M Y') }}
        </span>

        <span class="text-sm font-bold text-slate-700">
            Rp {{ number_format($order->total_amount ?? 0, 0, ',', '.') }}
        </span>

    </div>

</div>