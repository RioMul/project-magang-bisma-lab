@extends('layouts.app')

@section('content')

<div
    class="min-h-screen bg-[#f8fafc] py-12"
    x-data="{
        tab: '{{ $errors->has('name') || $errors->has('email') && old('name') ? 'register' : 'login' }}'
    }"
>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

            {{-- LOGIN / REGISTER --}}
            <div class="lg:col-span-7 space-y-6">

                <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">

                    {{-- TAB --}}
                    <div class="flex rounded-xl bg-slate-100 p-1.5 mb-8">

                        <button
                            type="button"
                            @click="tab = 'login'"
                            :class="tab === 'login'
                                ? 'bg-white text-slate-900 shadow-sm'
                                : 'text-slate-500 hover:text-slate-900'"
                            class="flex-1 py-3 text-xs font-bold uppercase tracking-wider rounded-lg transition-all"
                        >
                            Sudah Punya Akun
                        </button>

                        <button
                            type="button"
                            @click="tab = 'register'"
                            :class="tab === 'register'
                                ? 'bg-white text-slate-900 shadow-sm'
                                : 'text-slate-500 hover:text-slate-900'"
                            class="flex-1 py-3 text-xs font-bold uppercase tracking-wider rounded-lg transition-all"
                        >
                            Buat Akun
                        </button>

                    </div>


                    {{-- ERROR --}}
                    @if ($errors->any())

                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-xl">

                            <ul class="list-disc list-inside">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    {{-- LOGIN --}}
                    <div
                        x-show="tab === 'login'"
                        class="space-y-6"
                    >

                        <div>

                            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">

                                Masuk ke Akun Anda

                            </h1>

                            <p class="text-slate-500 text-sm mt-1">

                                Masuk terlebih dahulu untuk melanjutkan pesanan.

                            </p>

                        </div>


                        <form
                            action="{{ route('order.check_login.process') }}"
                            method="POST"
                            class="space-y-4"
                        >

                            @csrf


                            <div>

                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-2">

                                    Email

                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-[#0369a1] focus:border-[#0369a1]"
                                >

                                @error('login_email')

                                    <p class="text-red-500 text-xs mt-2">

                                        {{ $message }}

                                    </p>

                                @enderror

                            </div>


                            <div>

                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-2">

                                    Password

                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-[#0369a1] focus:border-[#0369a1]"
                                >

                            </div>


                            <label class="flex items-center gap-2 text-sm text-slate-500">

                                <input
                                    type="checkbox"
                                    name="remember"
                                    value="1"
                                >

                                Ingat saya

                            </label>


                            <button
                                type="submit"
                                class="w-full bg-[#0369a1] hover:bg-[#0284c7] text-white font-bold text-sm py-4 rounded-xl shadow-md transition-colors"
                            >

                                Masuk & Lanjutkan

                            </button>

                        </form>

                    </div>


                    {{-- REGISTER --}}
                    <div
                        x-show="tab === 'register'"
                        x-cloak
                        class="space-y-6"
                    >

                        <div>

                            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">

                                Buat Akun Baru

                            </h1>

                            <p class="text-slate-500 text-sm mt-1">

                                Buat akun untuk melanjutkan dan mengelola pesanan Anda.

                            </p>

                        </div>


                        <form
                            action="{{ route('order.check_register.process') }}"
                            method="POST"
                            class="space-y-4"
                        >

                            @csrf


                            <div>

                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-2">

                                    Nama Lengkap

                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-[#0369a1] focus:border-[#0369a1]"
                                >

                            </div>


                            <div>

                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-2">

                                    Email

                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-[#0369a1] focus:border-[#0369a1]"
                                >

                            </div>


                            <div>

                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-2">

                                    Password Baru

                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-[#0369a1] focus:border-[#0369a1]"
                                >

                            </div>


                            <div>

                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-2">

                                    Konfirmasi Password

                                </label>

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:ring-[#0369a1] focus:border-[#0369a1]"
                                >

                            </div>


                            <button
                                type="submit"
                                class="w-full bg-[#0369a1] hover:bg-[#0284c7] text-white font-bold text-sm py-4 rounded-xl shadow-md transition-colors"
                            >

                                Buat Akun & Lanjutkan

                            </button>

                        </form>

                    </div>

                </div>

            </div>


            {{-- RINGKASAN PESANAN --}}
            <div class="lg:col-span-5 sticky top-6">

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                    <div class="p-8 space-y-6">

                        <h2 class="text-lg font-bold text-slate-800">

                            Ringkasan Pesanan

                        </h2>


                        {{-- TEMPLATE --}}
                        <div class="flex items-center space-x-4">

                            <div class="w-20 h-20 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">

                                <img
                                    src="{{ asset($template->preview_image ?? 'tech1.png') }}"
                                    alt="{{ $template->name }}"
                                    class="w-full h-full object-cover"
                                >

                            </div>


                            <div>

                                <span class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">

                                    Template

                                </span>

                                <p class="font-bold text-slate-800 mt-1">

                                    {{ $template->name }}

                                </p>

                            </div>

                        </div>


                        <hr class="border-slate-100">


                        <div class="space-y-5 text-sm">

                            <div class="flex justify-between gap-4">

                                <div>

                                    <span class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">

                                        Paket

                                    </span>

                                    <p class="font-bold text-[#0369a1] mt-1">

                                        {{ $package->name }}

                                    </p>

                                </div>

                                <span class="font-bold text-slate-800">

                                    Rp {{ number_format($package->price, 0, ',', '.') }}

                                </span>

                            </div>


                            <div class="flex justify-between gap-4">

                                <div>

                                    <span class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">

                                        Domain

                                    </span>

                                    <p class="font-bold text-slate-800 mt-1">

                                        {{ $domain }}

                                    </p>

                                </div>

                                <span class="font-bold text-slate-800">

                                    Rp {{ number_format($domainPrice, 0, ',', '.') }}

                                </span>

                            </div>


                            <div class="flex justify-between gap-4">

                                <div>

                                    <span class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">

                                        Pembayaran

                                    </span>

                                    <p class="font-bold text-slate-800 mt-1">

                                        {{ ucwords(str_replace('_', ' ', session('order.payment_method'))) }}

                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="flex justify-between items-center bg-slate-50 p-5 rounded-xl border border-slate-100">

                            <span class="font-bold text-slate-600 text-xs uppercase tracking-wider">

                                Total Dibayar

                            </span>

                            <span class="font-extrabold text-slate-900 text-xl">

                                Rp {{ number_format($totalAmount, 0, ',', '.') }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection