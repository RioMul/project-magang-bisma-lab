@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8fafc] py-12" x-data="{ tab: 'login' }">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

            <!-- SISI KIRI: TAB SWITCHER (LOGIN / REGISTER) -->
            <div class="lg:col-span-7 space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
                    
                    <!-- Tombol Pilihan Tab -->
                    <div class="flex rounded-xl bg-slate-100 p-1.5 mb-8">
                        <button type="button" @click="tab = 'login'" :class="tab === 'login' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-900'" class="flex-1 py-3 text-xs font-bold uppercase tracking-wider rounded-lg transition-all">
                            Sudah Punya Akun (Login)
                        </button>
                        <button type="button" @click="tab = 'register'" :class="tab === 'register' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-900'" class="flex-1 py-3 text-xs font-bold uppercase tracking-wider rounded-lg transition-all">
                            Belum Punya (Daftar)
                        </button>
                    </div>

                    <!-- Notifikasi Error Global -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-xs font-bold rounded-r-xl">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- FORM 1: LOGIN -->
                    <div x-show="tab === 'login'" class="space-y-6">
                        <div>
                            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Masuk ke Akun Anda</h1>
                            <p class="text-slate-500 text-sm mt-1">Silakan masuk untuk melanjutkan pesanan Anda.</p>
                        </div>

                        <form action="{{ route('order.check_login.process') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-2">Email</label>
                                <input type="email" name="email" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-[#0369a1] focus:border-[#0369a1]">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-2">Password</label>
                                <input type="password" name="password" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-[#0369a1] focus:border-[#0369a1]">
                            </div>
                            <button type="submit" class="w-full bg-[#0369a1] hover:bg-[#0284c7] text-white font-bold text-sm py-4 rounded-xl shadow-md transition-colors mt-4">
                                Masuk & Selesaikan Pembayaran →
                            </button>
                        </form>
                    </div>

                    <!-- FORM 2: REGISTER -->
                    <div x-show="tab === 'register'" class="space-y-6" style="display: none;">
                        <div>
                            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Buat Akun Baru</h1>
                            <p class="text-slate-500 text-sm mt-1">Daftarkan diri Anda untuk mengelola website yang dipesan.</p>
                        </div>

                        <form action="{{ route('order.check_register.process') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-2">Nama Lengkap</label>
                                <input type="text" name="name" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-[#0369a1] focus:border-[#0369a1]">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-2">Email</label>
                                <input type="email" name="email" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-[#0369a1] focus:border-[#0369a1]">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-2">Password Baru</label>
                                <input type="password" name="password" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-[#0369a1] focus:border-[#0369a1]">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-2">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-[#0369a1] focus:border-[#0369a1]">
                            </div>
                            <button type="submit" class="w-full bg-[#0369a1] hover:bg-[#0284c7] text-white font-bold text-sm py-4 rounded-xl shadow-md transition-colors mt-4">
                                Daftar & Selesaikan Pembayaran →
                            </button>
                        </form>
                    </div>

                </div>
            </div>

            <!-- SISI KANAN: RINGKASAN PESANAN -->
            <div class="lg:col-span-5 sticky top-6">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-8 space-y-6">
                        <h2 class="text-lg font-bold text-slate-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#0369a1]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            Ringkasan Pesanan
                        </h2>

                        <hr class="border-slate-100">

                        <div class="space-y-4 text-sm">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Paket Terpilih</span>
                                    <p class="font-bold text-[#0369a1] mt-1">{{ $package->name ?? 'Paket Pilihan' }}</p>
                                </div>
                                <span class="text-[11px] text-slate-500">Tahunan</span>
                            </div>

                            <div class="flex items-center space-x-3 pt-2">
                                <div class="text-slate-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg></div>
                                <div>
                                    <span class="text-[10px] text-slate-400 block">Domain Terdaftar</span>
                                    <p class="font-bold text-slate-800 text-xs">{{ $domain ?? 'domainanda.com' }}</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3 pt-2">
                                <div class="text-slate-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg></div>
                                <div>
                                    <span class="text-[10px] text-slate-400 block">Template</span>
                                    <p class="font-bold text-slate-800 text-xs">{{ $template->name ?? 'Template' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center bg-slate-50 p-5 rounded-xl border border-slate-100 mt-6">
                            <span class="font-bold text-slate-600 text-xs uppercase tracking-wider">Total Dibayar</span>
                            <span class="font-extrabold text-slate-900 text-xl">Rp {{ number_format(($package->price ?? 0) + 150000, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection