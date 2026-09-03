@extends('layouts.app')

@section('content')

{{-- Tambahan CSS khusus saat invoice di-print/di-save ke PDF --}}
<style>
    @media print {
        body { background-color: white !important; }
        #smartNavbar, footer { display: none !important; }
        .print\:hidden { display: none !important; }
        .print\:shadow-none { box-shadow: none !important; border: none !important; }
        .print\:p-0 { padding: 0 !important; }
        
        /* Memaksa browser untuk mencetak semua warna background (Trik agar PDF tidak kosong) */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    }
</style>

<div class="min-h-screen bg-[#f8fafc] py-12 pt-32 print:pt-8 print:bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 print:p-0">

        {{-- NOTIFIKASI SUKSES (Disembunyikan saat dicetak) --}}
        @if(session('payment_success'))
            <div class="mb-8 p-5 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-start gap-4 shadow-sm print:hidden">
                <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div class="mt-0.5">
                    <h3 class="text-emerald-800 font-bold text-base">Pembayaran Berhasil!</h3>
                    <p class="text-emerald-600 text-sm mt-0.5 font-medium">Terima kasih, pesanan Anda sedang kami proses.</p>
                </div>
            </div>
        @endif

        {{-- KARTU INVOICE --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden print:shadow-none print:border-none">
            
            {{-- INVOICE HEADER --}}
            <div class="p-8 md:px-10 md:pt-10 md:pb-8 border-b border-slate-100 flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">INVOICE</h1>
                    <p class="text-slate-500 text-sm mt-1 font-medium tracking-wide">#{{ $order->order_number }}</p>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-100 text-emerald-700 mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> PAID
                    </span>
                    <p class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            {{-- INVOICE INFO (KIRI & KANAN) --}}
            <div class="px-8 py-6 md:px-10 flex flex-col sm:flex-row justify-between items-start gap-6">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Ditagihkan Kepada</p>
                    <h4 class="font-bold text-slate-900 text-base">{{ $order->customer_name }}</h4>
                    <p class="text-sm text-slate-500 mt-0.5">{{ $order->customer_email }}</p>
                </div>
                <div class="sm:text-right">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Metode Pembayaran</p>
                    <h4 class="font-bold text-slate-900 text-base uppercase">{{ str_replace('_', ' ', $order->payment_method) }}</h4>
                </div>
            </div>

            {{-- TABEL RINCIAN --}}
            <div class="px-8 pb-8 md:px-10 md:pb-10">
                <div class="border border-slate-200 rounded-xl overflow-hidden print:border-slate-300">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 border-b border-slate-200 text-[10px] uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="p-4 md:p-5 font-bold text-left">Deskripsi Layanan</th>
                                <th class="p-4 md:p-5 font-bold text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr>
                                <td class="p-4 md:p-5">
                                    <p class="font-bold text-slate-900">{{ $order->package->name }} Plan</p>
                                    <p class="text-xs text-slate-500 mt-1">Template: {{ $order->template->name }}</p>
                                </td>
                                <td class="p-4 md:p-5 text-right font-bold text-slate-900">
                                    Rp {{ number_format($order->package->price_annually, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="p-4 md:p-5">
                                    <p class="font-bold text-slate-900">Registrasi Domain</p>
                                    <p class="text-xs text-slate-500 mt-1">{{ $order->domain_name }} (1 Tahun)</p>
                                </td>
                                <td class="p-4 md:p-5 text-right font-bold text-slate-900">
                                    Rp {{ number_format($order->total_amount - $order->package->price_annually, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="p-4 md:p-5 bg-white">
                                    <p class="font-bold text-slate-900">Pajak (PPN 0%)</p>
                                    <p class="text-xs text-slate-500 mt-1">Sesuai kebijakan layanan</p>
                                </td>
                                <td class="p-4 md:p-5 text-right font-bold text-slate-900 bg-white">
                                    Rp 0
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-slate-50 border-t border-slate-200">
                            <tr>
                                <td class="p-4 md:p-5 font-bold text-slate-600 text-left uppercase tracking-wider text-xs">
                                    Total Pembayaran
                                </td>
                                <td class="p-4 md:p-5 text-right font-black text-[#0369a1] text-xl md:text-2xl">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{-- INVOICE ACTIONS (Disembunyikan saat dicetak) --}}
            <div class="p-6 md:p-8 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-4 print:hidden">
                
                {{-- Tombol Simpan Invoice --}}
                <button onclick="window.print()" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-slate-200 border border-slate-300 hover:bg-slate-300 text-slate-700 px-6 py-3.5 rounded-xl font-bold text-sm shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Simpan Invoice
                </button>

                {{-- Tombol Lanjut ke Dashboard --}}
                <a href="{{ route('dashboard') }}" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-[#0369a1] hover:bg-[#027ea8] text-white px-8 py-3.5 rounded-xl font-bold text-sm shadow-md transition">
                    Ke Dashboard Client <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>

            </div>
        </div>

    </div>
</div>

{{-- SCRIPT UNTUK MEMATIKAN FUNGSI TOMBOL BACK DI BROWSER --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Manipulasi history agar kembali ke halaman ini jika tombol back ditekan
        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function() {
            window.history.pushState(null, "", window.location.href);
        };
    });
</script>
@endsection