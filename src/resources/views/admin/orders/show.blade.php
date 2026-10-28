@extends('admin.layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
@php
    $invoice = $order->invoice;
    $payment = $order->payment;

    $status = strtolower(
        $payment?->status
        ?? $invoice?->status
        ?? $order->status
        ?? 'pending'
    );

    $statusDisplay = match ($status) {
        'paid', 'success', 'completed' => [
            'label' => 'Lunas',
            'class' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
        ],
        'failed', 'cancelled' => [
            'label' => 'Gagal',
            'class' => 'border-rose-200 bg-rose-50 text-rose-700',
        ],
        'expired' => [
            'label' => 'Kedaluwarsa',
            'class' => 'border-slate-200 bg-slate-100 text-slate-600',
        ],
        default => [
            'label' => 'Menunggu pembayaran',
            'class' => 'border-amber-200 bg-amber-50 text-amber-700',
        ],
    };

    $subtotal = (float) ($invoice?->subtotal ?? $order->total_amount ?? 0);
    $discountAmount = (float) ($invoice?->discount_amount ?? 0);
    $taxAmount = (float) ($invoice?->tax_amount ?? 0);
    $totalAmount = (float) ($invoice?->total_amount ?? $order->total_amount ?? 0);
    $issuedAt = $invoice?->issued_at ?? $order->created_at;

    $hasDetailedTotals = $discountAmount > 0 || $taxAmount > 0;

    $hasEstimatedBreakdown = $order->orderItems->contains(
        fn ($item) => (bool) $item->price_breakdown_is_estimated
    );
@endphp

<style>
    @media print {
        @page {
            size: A4;
            margin: 12mm;
        }

        body * {
            visibility: hidden !important;
        }

        .print-area,
        .print-area * {
            visibility: visible !important;
        }

        .print-area {
            position: absolute !important;
            inset: 0 auto auto 0 !important;
            width: 100% !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 0 !important;
            border: 0 !important;
            box-shadow: none !important;
        }

        .print-hidden {
            display: none !important;
        }
    }
</style>

<div class="mx-auto max-w-[1400px] space-y-6">

    <div class="print-hidden flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <a
                href="{{ $backUrl }}"
                class="text-sm font-semibold text-[#0369a1] hover:underline">
                ← Kembali
            </a>

            <h1 class="mt-3 text-2xl font-bold text-slate-900">
                Detail Pesanan
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Rincian website, pembayaran, dan tagihan pelanggan.
            </p>
        </div>

        <button
            type="button"
            onclick="window.print()"
            class="inline-flex items-center justify-center rounded-xl bg-[#0369a1] px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#075985]">
            Cetak detail
        </button>
    </div>

    <div class="print-area space-y-6">

        {{-- Ringkasan pesanan --}}
        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                        Nomor pesanan
                    </p>

                    <h2 class="mt-1 break-all text-xl font-bold text-slate-900">
                        {{ $order->order_number }}
                    </h2>

                    <div class="mt-3 flex flex-wrap gap-x-5 gap-y-2 text-sm text-slate-500">
                        <span>
                            Dibuat:
                            {{ $order->created_at?->format('d M Y, H:i') ?? '—' }}
                        </span>

                        @if($invoice?->invoice_number)
                            <span>
                                Invoice:
                                {{ $invoice->invoice_number }}
                            </span>
                        @endif
                    </div>
                </div>

                <span class="inline-flex w-fit items-center rounded-full border px-3 py-1.5 text-xs font-bold {{ $statusDisplay['class'] }}">
                    {{ $statusDisplay['label'] }}
                </span>
            </div>
        </section>

        {{-- Informasi pelanggan dan pembayaran --}}
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                <h2 class="text-base font-bold text-slate-900">
                    Informasi pelanggan
                </h2>

                <dl class="mt-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Nama
                        </dt>
                        <dd class="mt-1 text-sm font-semibold text-slate-700">
                            {{ $invoice?->customer_name ?? $order->customer_name ?? $order->user?->name ?? '—' }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Email
                        </dt>
                        <dd class="mt-1 break-all text-sm font-semibold text-slate-700">
                            {{ $invoice?->customer_email ?? $order->customer_email ?? $order->user?->email ?? '—' }}
                        </dd>
                    </div>

                    <div class="sm:col-span-2">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            WhatsApp
                        </dt>
                        <dd class="mt-1 text-sm font-semibold text-slate-700">
                            {{ $invoice?->customer_whatsapp ?? $order->customer_whatsapp ?? '—' }}
                        </dd>
                    </div>
                </dl>
            </section>

            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                <h2 class="text-base font-bold text-slate-900">
                    Informasi pembayaran
                </h2>

                <dl class="mt-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Metode pembayaran
                        </dt>
                        <dd class="mt-1 text-sm font-semibold capitalize text-slate-700">
                            {{ str_replace('_', ' ', $payment?->payment_method ?? $order->payment_method ?? '—') }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            ID transaksi
                        </dt>
                        <dd class="mt-1 break-all text-sm font-semibold text-slate-700">
                            {{ $payment?->transaction_id ?? 'Belum tersedia' }}
                        </dd>
                    </div>

                    <div class="sm:col-span-2">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Waktu pembayaran
                        </dt>
                        <dd class="mt-1 text-sm font-semibold text-slate-700">
                            {{ $payment?->paid_at?->format('d M Y, H:i') ?? 'Belum dibayar' }}
                        </dd>
                    </div>
                </dl>
            </section>

        </div>

        {{-- Rincian item --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-5 py-5 sm:px-6">
                <h2 class="text-base font-bold text-slate-900">
                    Rincian website yang dipesan
                </h2>
                <p class="mt-1 text-xs text-slate-500">
                    Template, paket, domain, dan periode untuk setiap item pesanan.
                </p>
            </div>

            @if($hasEstimatedBreakdown)
                <div class="mx-5 mt-5 flex gap-3 rounded-xl border border-amber-200 bg-amber-50 p-4 sm:mx-6">
                    <div class="mt-0.5 shrink-0 text-amber-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 4h.01M10.3 3.86l-8 14A2 2 0 004 21h16a2 2 0 001.7-3.14l-8-14a2 2 0 00-3.4 0z"/>
                        </svg>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-amber-900">
                            Rincian harga historis merupakan estimasi
                        </p>
                        <p class="mt-1 text-xs leading-5 text-amber-800">
                            Beberapa item berasal dari migrasi data lama. Total tagihan tetap mengikuti nilai transaksi dan invoice yang tersimpan.
                        </p>
                    </div>
                </div>
            @endif

            @if($order->orderItems->isEmpty())
                <div class="px-6 py-10 text-center">
                    <p class="text-sm font-semibold text-slate-600">
                        Rincian item belum tersedia untuk pesanan ini.
                    </p>
                </div>
            @else
                <div class="divide-y divide-slate-100">
                    @foreach($order->orderItems as $item)
                        <article class="px-5 py-6 sm:px-6">
                            <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">

                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h3 class="text-base font-bold text-slate-900">
                                            {{ $item->template?->name ?? 'Template website' }}
                                        </h3>

                                        <span class="rounded-full bg-sky-50 px-2.5 py-1 text-[11px] font-semibold text-sky-700">
                                            {{ $item->package?->name ?? 'Paket website' }}
                                        </span>
                                    </div>

                                    <dl class="mt-5 grid grid-cols-1 gap-x-8 gap-y-4 sm:grid-cols-2">
                                        <div>
                                            <dt class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                                Domain
                                            </dt>
                                            <dd class="mt-1 break-all text-sm font-medium text-slate-700">
                                                {{ $item->domain_name }}
                                            </dd>
                                        </div>

                                        <div>
                                            <dt class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                                Periode paket
                                            </dt>
                                            <dd class="mt-1 text-sm font-medium text-slate-700">
                                                {{ $item->billing_period_months }} bulan
                                            </dd>
                                        </div>

                                        <div>
                                            <dt class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                                Status domain
                                            </dt>
                                            <dd class="mt-1 text-sm font-medium text-slate-700">
                                                {{ ucfirst(str_replace('_', ' ', $item->domain_status ?? 'menunggu penyedia')) }}
                                            </dd>
                                        </div>

                                        <div>
                                            <dt class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                                Status website
                                            </dt>
                                            <dd class="mt-1 text-sm font-medium text-slate-700">
                                                {{ ucfirst(str_replace('_', ' ', $item->website_status ?? 'pending')) }}
                                            </dd>
                                        </div>

                                        @if($item->website_expires_at)
                                            <div>
                                                <dt class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                                    Masa aktif sampai
                                                </dt>
                                                <dd class="mt-1 text-sm font-medium text-slate-700">
                                                    {{ $item->website_expires_at->format('d M Y') }}
                                                </dd>
                                            </div>
                                        @endif
                                    </dl>
                                </div>

                                <div class="w-full rounded-xl bg-slate-50 p-4 lg:max-w-sm">
                                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-500">
                                        Rincian harga
                                    </h4>

                                    <dl class="mt-3 space-y-2.5">
                                        <div class="flex justify-between gap-4 text-sm">
                                            <dt class="text-slate-500">Template</dt>
                                            <dd class="whitespace-nowrap font-semibold text-slate-800">
                                                Rp {{ number_format((float) $item->template_price, 0, ',', '.') }}
                                            </dd>
                                        </div>

                                        <div class="flex justify-between gap-4 text-sm">
                                            <dt class="text-slate-500">Paket</dt>
                                            <dd class="whitespace-nowrap font-semibold text-slate-800">
                                                Rp {{ number_format((float) $item->package_price, 0, ',', '.') }}
                                            </dd>
                                        </div>

                                        <div class="flex justify-between gap-4 text-sm">
                                            <dt class="text-slate-500">Domain</dt>
                                            <dd class="whitespace-nowrap font-semibold text-slate-800">
                                                Rp {{ number_format((float) $item->domain_price, 0, ',', '.') }}
                                            </dd>
                                        </div>
                                    </dl>
                                </div>

                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>

        {{-- Ringkasan tagihan: satu total utama, tanpa pengulangan subtotal jika tidak diperlukan --}}
        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
            <div class="ml-auto max-w-md">
                @if($hasDetailedTotals)
                    <dl class="space-y-3">
                        <div class="flex justify-between gap-4 text-sm">
                            <dt class="text-slate-500">Subtotal</dt>
                            <dd class="font-semibold text-slate-800">
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </dd>
                        </div>

                        @if($discountAmount > 0)
                            <div class="flex justify-between gap-4 text-sm">
                                <dt class="text-slate-500">Diskon</dt>
                                <dd class="font-semibold text-emerald-700">
                                    − Rp {{ number_format($discountAmount, 0, ',', '.') }}
                                </dd>
                            </div>
                        @endif

                        @if($taxAmount > 0)
                            <div class="flex justify-between gap-4 text-sm">
                                <dt class="text-slate-500">Pajak</dt>
                                <dd class="font-semibold text-slate-800">
                                    Rp {{ number_format($taxAmount, 0, ',', '.') }}
                                </dd>
                            </div>
                        @endif
                    </dl>
                @endif

                <div class="{{ $hasDetailedTotals ? 'mt-4 border-t border-slate-200 pt-4' : '' }} flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-bold text-slate-900">
                            Total tagihan
                        </p>
                        <p class="mt-1 text-xs text-slate-500">
                            {{ $invoice?->invoice_number ?? $order->order_number }}
                        </p>
                    </div>

                    <p class="whitespace-nowrap text-2xl font-bold text-[#0369a1]">
                        Rp {{ number_format($totalAmount, 0, ',', '.') }}
                    </p>
                </div>

                <div class="mt-4 text-right text-xs text-slate-400">
                    Invoice diterbitkan
                    {{ $issuedAt?->format('d M Y, H:i') ?? '—' }}

                    @if($invoice?->due_at)
                        <span class="mt-1 block">
                            Jatuh tempo {{ $invoice->due_at->format('d M Y, H:i') }}
                        </span>
                    @endif
                </div>
            </div>
        </section>

    </div>
</div>
@endsection