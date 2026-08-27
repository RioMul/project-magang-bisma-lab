<!DOCTYPE html>

<html lang="id" class="scroll-smooth">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Website Profesional untuk UMKM — Langsung Jadi! | BismaLabs</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-white text-slate-800 antialiased selection:bg-[#0396c7] selection:text-white">

    {{-- NAVBAR --}}
    @include('partials.navbar')


    {{-- ============================================================
        1. HERO SECTION
    ============================================================ --}}

    <section class="max-w-7xl mx-auto px-6 sm:px-10 pt-40 pb-24">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

            {{-- KIRI --}}
            <div class="lg:col-span-7">

                <div class="inline-block px-4 py-2 bg-slate-100 text-slate-700 rounded-full text-xs sm:text-sm font-extrabold uppercase tracking-wider mb-6">

                    TERPERCAYA OLEH 2,500+ UMKM

                </div>


                <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black text-slate-900 leading-[1.15] tracking-tight">

                    Website <br>

                    Profesional <br>

                    untuk UMKM — <br>

                    <span class="text-[#0396c7]">
                        Langsung Jadi!
                    </span>

                </h1>


                <p class="mt-8 text-lg sm:text-xl text-slate-600 leading-relaxed max-w-xl font-medium">

                    Platform pembuatan website termudah untuk pengusaha kecil.
                    Tanpa ribet coding, desain profesional langsung jadi siap jualan.

                </p>


                <div class="mt-10 flex flex-wrap items-center gap-5">

                    <a
                        href="{{ route('order.template') }}"
                        class="px-8 py-4 bg-[#0396c7] hover:bg-[#027ea7] text-white text-base sm:text-lg font-black rounded-2xl shadow-xl shadow-cyan-900/20 transition transform hover:-translate-y-0.5"
                    >

                        Buat Website Sekarang

                    </a>


                    <a
                        href="#templates-section"
                        class="px-7 py-4 bg-slate-100 hover:bg-slate-200 text-slate-800 text-base sm:text-lg font-bold rounded-2xl flex items-center gap-3 transition"
                    >

                        <svg
                            class="w-6 h-6 text-slate-700"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path d="M8 5v14l11-7z"/>

                        </svg>

                        Lihat Demo

                    </a>

                </div>

            </div>


            {{-- KANAN --}}
            <div class="lg:col-span-5 flex justify-center">

                <div class="relative rounded-3xl p-4 sm:p-5 bg-gradient-to-tr from-cyan-50 via-slate-50 to-white shadow-2xl border border-slate-200 w-full max-w-lg">

                    <img
                        src="{{ asset('tech1.png') }}"
                        alt="Preview Web UMKM"
                        onerror="this.onerror=null; this.src='{{ asset('tech2.png') }}';"
                        class="rounded-2xl w-full h-auto object-cover aspect-[4/3] shadow-inner"
                    >

                </div>

            </div>

        </div>

    </section>



    {{-- ============================================================
        2. MASALAH KLASIK
    ============================================================ --}}

    <section id="solusi" class="py-24 bg-slate-50 border-t border-slate-200">

        <div class="max-w-7xl mx-auto px-6 sm:px-10">

            <div class="text-center max-w-2xl mx-auto mb-16">

                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight">

                    Masalah Klasik Saat Bikin Website

                </h2>

                <div class="w-24 h-1.5 bg-[#0396c7] mx-auto mt-4 rounded-full"></div>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- MASALAH 1 --}}
                <div class="bg-white p-8 sm:p-9 rounded-3xl border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">

                    <div>

                        <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center font-black text-2xl mb-6">

                            ✕

                        </div>

                        <h3 class="font-extrabold text-slate-900 text-xl sm:text-2xl">

                            Coding itu Sulit

                        </h3>

                        <p class="text-base text-slate-600 mt-4 leading-relaxed font-normal">

                            Belajar pemrograman butuh waktu berbulan-bulan.
                            Sebagai pengusaha, Anda harus fokus jualan,
                            bukan pusing mencari error pada website.

                        </p>

                    </div>

                </div>


                {{-- MASALAH 2 --}}
                <div class="bg-white p-8 sm:p-9 rounded-3xl border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">

                    <div>

                        <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center text-2xl mb-6">

                            💳

                        </div>

                        <h3 class="font-extrabold text-slate-900 text-xl sm:text-2xl">

                            Agensi Terlalu Mahal

                        </h3>

                        <p class="text-base text-slate-600 mt-4 leading-relaxed font-normal">

                            Biaya pembuatan website di agensi profesional
                            bisa mencapai puluhan juta. Investasi yang terlalu
                            besar untuk bisnis yang baru mulai.

                        </p>

                    </div>

                </div>


                {{-- MASALAH 3 --}}
                <div class="bg-white p-8 sm:p-9 rounded-3xl border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">

                    <div>

                        <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center text-2xl mb-6">

                            ⏱

                        </div>

                        <h3 class="font-extrabold text-slate-900 text-xl sm:text-2xl">

                            Proses Sangat Lama

                        </h3>

                        <p class="text-base text-slate-600 mt-4 leading-relaxed font-normal">

                            Menunggu website jadi berminggu-minggu artinya
                            Anda kehilangan potensi pelanggan setiap detiknya.
                            Dunia digital bergerak cepat.

                        </p>

                    </div>

                </div>

            </div>


            {{-- BANNER SOLUSI --}}
            <div class="mt-16 grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">

                <div class="lg:col-span-8 bg-[#eef6fc] p-10 sm:p-14 rounded-3xl border border-cyan-200 flex flex-col justify-between">

                    <div>

                        <span class="text-sm sm:text-base font-extrabold text-slate-700 uppercase tracking-wider">

                            Solusi Cerdas:

                        </span>

                        <h3 class="text-3xl sm:text-4xl font-black text-[#0396c7] mt-2 leading-snug">

                            Bisma Labs Mempercepat Bisnis Anda

                        </h3>

                        <p class="text-base sm:text-lg text-slate-700 mt-5 leading-relaxed max-w-2xl font-normal">

                            Kami menggabungkan kemudahan pemilihan template
                            dengan standar desain profesional untuk hasil
                            yang cepat dan siap digunakan.

                        </p>

                    </div>


                    <div class="mt-10 flex flex-wrap items-center gap-6 sm:gap-8 text-base sm:text-lg font-bold text-[#0396c7]">

                        <span class="flex items-center gap-2.5">

                            <span class="w-6 h-6 rounded-full bg-cyan-100 border border-[#0396c7] flex items-center justify-center text-xs font-black">

                                ✓

                            </span>

                            100% Cepat

                        </span>


                        <span class="flex items-center gap-2.5">

                            <span class="w-6 h-6 rounded-full bg-cyan-100 border border-[#0396c7] flex items-center justify-center text-xs font-black">

                                ✓

                            </span>

                            Sangat Mudah

                        </span>


                        <span class="flex items-center gap-2.5">

                            <span class="w-6 h-6 rounded-full bg-cyan-100 border border-[#0396c7] flex items-center justify-center text-xs font-black">

                                ✓

                            </span>

                            Harga Terjangkau

                        </span>

                    </div>

                </div>


                <div class="lg:col-span-4 bg-[#0396c7] text-white p-10 sm:p-12 rounded-3xl flex flex-col items-center justify-center text-center shadow-xl">

                    <div class="text-5xl sm:text-6xl font-black font-mono flex items-center gap-2">

                        <span>&lt;</span>

                        1 jam

                    </div>

                    <p class="text-base sm:text-lg text-cyan-50 mt-4 max-w-[260px] leading-relaxed font-semibold">

                        Website Anda dapat langsung diproses dengan cepat.

                    </p>

                </div>

            </div>

        </div>

    </section>



    {{-- ============================================================
        3. TEMPLATE
    ============================================================ --}}

    <section id="templates-section" class="py-24 bg-white">

        <div class="max-w-7xl mx-auto px-6 sm:px-10">

            <div class="text-center max-w-2xl mx-auto mb-16">

                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight">

                    Pilih Desain Sesuai Industri Anda

                </h2>

                <p class="text-base sm:text-lg text-slate-600 mt-4">

                    Ratusan template siap pakai yang didesain
                    untuk membantu bisnis Anda tampil profesional.

                </p>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach ($templates->take(3) as $template)

                    <div class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-md flex flex-col justify-between hover:shadow-xl transition duration-200">

                        {{-- PREVIEW --}}
                        <div class="h-64 bg-slate-900 overflow-hidden relative group">

                            <img
                                src="{{ $template->preview_image }}"
                                alt="{{ $template->name }}"
                                onerror="this.onerror=null; this.src='{{ asset('tech2.png') }}';"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                            >

                            <span class="absolute top-4 right-4 text-xs font-bold px-3 py-1 bg-white/95 rounded-lg text-slate-800 shadow-sm">

                                {{ $template->category }}

                            </span>

                        </div>


                        {{-- INFO --}}
                        <div class="p-8">

                            <h3 class="font-extrabold text-slate-900 text-xl sm:text-2xl mb-2">

                                {{ $template->name }}

                            </h3>

                            <p class="text-sm sm:text-base text-slate-600 line-clamp-2 leading-relaxed mb-6">

                                {{ $template->description }}

                            </p>


                            <div class="flex items-center gap-3">

                                @if ($template->demo_url)

                                    {{-- PREVIEW --}}
                                    <a
                                        href="{{ $template->demo_url }}"
                                        target="_blank"
                                        class="w-1/2 py-3.5 text-center text-sm font-bold bg-slate-100 hover:bg-slate-200 text-slate-800 rounded-xl transition"
                                    >

                                        Preview

                                    </a>


                                    {{-- USE TEMPLATE --}}
                                    <form
                                        action="{{ route('order.template.store') }}"
                                        method="POST"
                                        class="w-1/2"
                                    >

                                        @csrf

                                        <input
                                            type="hidden"
                                            name="template_id"
                                            value="{{ $template->id }}"
                                        >

                                        <button
                                            type="submit"
                                            class="w-full py-3.5 text-center text-sm font-black bg-[#0396c7] hover:bg-[#027ea7] text-white rounded-xl shadow-md transition"
                                        >

                                            Use Template

                                        </button>

                                    </form>

                                @else

                                    {{-- USE TEMPLATE TANPA DEMO --}}
                                    <form
                                        action="{{ route('order.template.store') }}"
                                        method="POST"
                                        class="w-full"
                                    >

                                        @csrf

                                        <input
                                            type="hidden"
                                            name="template_id"
                                            value="{{ $template->id }}"
                                        >

                                        <button
                                            type="submit"
                                            class="w-full py-3.5 text-center text-sm font-black bg-[#0396c7] hover:bg-[#027ea7] text-white rounded-xl shadow-md transition"
                                        >

                                            Use Template

                                        </button>

                                    </form>

                                @endif

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- VIEW MORE --}}
            <div class="mt-14 text-center">

                <a
                    href="{{ route('order.template') }}"
                    class="inline-flex items-center gap-3 px-10 py-4 bg-slate-100 hover:bg-slate-200 text-slate-800 text-base font-extrabold rounded-2xl transition"
                >

                    <span>View More Templates</span>

                    <span>&rarr;</span>

                </a>

            </div>

        </div>

    </section>



    {{-- ============================================================
        4. PRICING
    ============================================================ --}}

    <section id="pricing-section" class="py-24 bg-slate-50 border-t border-slate-200">

        <div class="max-w-7xl mx-auto px-6 sm:px-10">

            <div class="text-center max-w-2xl mx-auto mb-16">

                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight">

                    Investasi Terjangkau untuk Bisnis Anda

                </h2>

                <p class="text-base sm:text-lg text-slate-600 mt-4">

                    Pilih paket yang paling sesuai dengan skala usaha Anda saat ini.

                </p>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 items-stretch">

                {{-- STARTUP --}}
                <div class="bg-white border border-slate-200 rounded-3xl p-8 flex flex-col justify-between shadow-sm hover:shadow-md transition">

                    <div>

                        <span class="text-xs font-bold text-[#0396c7] uppercase font-mono tracking-wider">

                            PAKET S

                        </span>

                        <h3 class="text-xl font-extrabold text-slate-900 mt-1">

                            Startup

                        </h3>

                        <div class="mt-4 text-3xl sm:text-4xl font-black text-slate-900 font-mono">

                            99k

                            <span class="text-sm font-normal text-slate-500 font-sans">

                                /bln

                            </span>

                        </div>


                        <ul class="mt-8 space-y-4 text-sm sm:text-base text-slate-700 font-medium">

                            <li class="flex items-center gap-3">

                                <span class="text-[#0396c7] font-bold text-lg">✓</span>

                                Single Landing Page

                            </li>

                            <li class="flex items-center gap-3">

                                <span class="text-[#0396c7] font-bold text-lg">✓</span>

                                Domain .com

                            </li>

                            <li class="flex items-center gap-3 text-slate-400">

                                <span>✕</span>

                                E-Commerce Features

                            </li>

                        </ul>

                    </div>


                    <button
                        type="button"
                        onclick="triggerNeedTemplateModal()"
                        class="w-full mt-8 py-3.5 text-sm font-bold border-2 border-[#0396c7] text-[#0396c7] hover:bg-cyan-50 rounded-xl transition"
                    >

                        Pilih Paket

                    </button>

                </div>


                {{-- PROFESSIONAL --}}
                <div class="bg-white border-2 border-[#0396c7] rounded-3xl p-8 flex flex-col justify-between shadow-2xl relative transform lg:-translate-y-3">

                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-[#0396c7] text-white text-xs font-black uppercase tracking-wider px-5 py-1.5 rounded-full shadow-md">

                        Paling Populer

                    </div>


                    <div>

                        <span class="text-xs font-bold text-[#0396c7] uppercase font-mono tracking-wider mt-1">

                            PAKET M

                        </span>

                        <h3 class="text-xl font-extrabold text-slate-900 mt-1">

                            Professional

                        </h3>

                        <div class="mt-4 text-3xl sm:text-4xl font-black text-slate-900 font-mono">

                            249k

                            <span class="text-sm font-normal text-slate-500 font-sans">

                                /bln

                            </span>

                        </div>


                        <ul class="mt-8 space-y-4 text-sm sm:text-base text-slate-700 font-medium">

                            <li class="flex items-center gap-3">
                                <span class="text-[#0396c7] font-bold text-lg">✓</span>
                                Multi Page Website
                            </li>

                            <li class="flex items-center gap-3">
                                <span class="text-[#0396c7] font-bold text-lg">✓</span>
                                SEO Friendly
                            </li>

                            <li class="flex items-center gap-3">
                                <span class="text-[#0396c7] font-bold text-lg">✓</span>
                                Basic E-Commerce
                            </li>

                        </ul>

                    </div>


                    <button
                        type="button"
                        onclick="triggerNeedTemplateModal()"
                        class="w-full mt-8 py-3.5 text-sm font-black bg-[#0396c7] hover:bg-[#027ea7] text-white rounded-xl shadow-md transition"
                    >

                        Pilih Paket

                    </button>

                </div>


                {{-- BUSINESS --}}
                <div class="bg-white border border-slate-200 rounded-3xl p-8 flex flex-col justify-between shadow-sm hover:shadow-md transition">

                    <div>

                        <span class="text-xs font-bold text-[#0396c7] uppercase font-mono tracking-wider">

                            PAKET L

                        </span>

                        <h3 class="text-xl font-extrabold text-slate-900 mt-1">

                            Business

                        </h3>

                        <div class="mt-4 text-3xl sm:text-4xl font-black text-slate-900 font-mono">

                            499k

                            <span class="text-sm font-normal text-slate-500 font-sans">

                                /bln

                            </span>

                        </div>


                        <ul class="mt-8 space-y-4 text-sm sm:text-base text-slate-700 font-medium">

                            <li class="flex items-center gap-3">
                                <span class="text-[#0396c7] font-bold text-lg">✓</span>
                                E-Commerce Features
                            </li>

                            <li class="flex items-center gap-3">
                                <span class="text-[#0396c7] font-bold text-lg">✓</span>
                                Payment Integration
                            </li>

                            <li class="flex items-center gap-3">
                                <span class="text-[#0396c7] font-bold text-lg">✓</span>
                                Priority Support
                            </li>

                        </ul>

                    </div>


                    <button
                        type="button"
                        onclick="triggerNeedTemplateModal()"
                        class="w-full mt-8 py-3.5 text-sm font-bold border-2 border-[#0396c7] text-[#0396c7] hover:bg-cyan-50 rounded-xl transition"
                    >

                        Pilih Paket

                    </button>

                </div>


                {{-- ENTERPRISE --}}
                <div class="bg-white border border-slate-200 rounded-3xl p-8 flex flex-col justify-between shadow-sm hover:shadow-md transition">

                    <div>

                        <span class="text-xs font-bold text-slate-500 uppercase font-mono tracking-wider">

                            PAKET XL

                        </span>

                        <h3 class="text-xl font-extrabold text-slate-900 mt-1">

                            Enterprise

                        </h3>

                        <div class="mt-4 text-3xl sm:text-4xl font-black text-slate-900 font-mono">

                            Custom

                        </div>


                        <ul class="mt-8 space-y-4 text-sm sm:text-base text-slate-700 font-medium">

                            <li class="flex items-center gap-3">
                                <span class="text-[#0396c7] font-bold text-lg">✓</span>
                                Custom Features
                            </li>

                            <li class="flex items-center gap-3">
                                <span class="text-[#0396c7] font-bold text-lg">✓</span>
                                Dedicated Support
                            </li>

                            <li class="flex items-center gap-3">
                                <span class="text-[#0396c7] font-bold text-lg">✓</span>
                                High Performance Server
                            </li>

                        </ul>

                    </div>


                    <a
                        href="https://wa.me/6281234567890?text=Halo%20BismaLabs,%20saya%20tertarik%20dengan%20Paket%20Enterprise"
                        target="_blank"
                        class="w-full mt-8 py-3.5 text-center text-sm font-bold border-2 border-slate-300 text-slate-700 hover:bg-slate-50 rounded-xl transition inline-block"
                    >

                        Hubungi Kami

                    </a>

                </div>

            </div>

        </div>

    </section>



    {{-- ============================================================
        5. 4 LANGKAH
    ============================================================ --}}

    <section class="py-24 bg-[#f0f4f9] border-t border-slate-200">

        <div class="max-w-6xl mx-auto px-6 sm:px-10">

            <div class="text-center max-w-2xl mx-auto mb-20">

                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight">

                    4 Langkah Mudah Menuju Go–Digital

                </h2>

                <p class="text-base sm:text-lg text-slate-600 mt-4">

                    Proses transparan dan efisien tanpa menyita waktu Anda.

                </p>

            </div>


            <div class="relative">

                <div class="hidden md:block absolute top-7 left-16 right-16 border-t-2 border-dashed border-cyan-300 -z-0"></div>


                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10 relative z-10">

                    @php

                        $steps = [
                            [
                                'number' => '1',
                                'title' => 'Pilih Template',
                                'description' => 'Tentukan desain dasar yang paling mewakili brand Anda.'
                            ],
                            [
                                'number' => '2',
                                'title' => 'Pilih Domain',
                                'description' => 'Cari alamat domain terbaik sesuai kebutuhan Anda.'
                            ],
                            [
                                'number' => '3',
                                'title' => 'Pilih Paket',
                                'description' => 'Sesuaikan opsi dan harga yang paling pas untuk website Anda.'
                            ],
                            [
                                'number' => '4',
                                'title' => 'Live!',
                                'description' => 'Website siap dikunjungi pelanggan dari seluruh dunia.'
                            ],
                        ];

                    @endphp


                    @foreach ($steps as $step)
                        <div class="flex flex-col items-center text-center">
                            <div class="w-14 h-14 rounded-full bg-[#0396c7] text-white flex items-center justify-center font-black text-base shadow-lg mb-5">
                                {{ $step['number'] }}

                            </div>

                            <h4 class="font-extrabold text-slate-900 text-base sm:text-lg">

                                {{ $step['title'] }}

                            </h4>
                            <p class="text-sm text-slate-600 mt-2 max-w-[180px] leading-relaxed">

                                {{ $step['description'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
        6. CTA
    ============================================================ --}}
    <section class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6 sm:px-10">
            <div class="bg-[#0396c7] rounded-3xl p-12 sm:p-16 text-center text-white shadow-2xl">
                <h2 class="text-3xl sm:text-5xl font-black tracking-tight">
                    Siap Go Digital?
                </h2>

                <p class="text-base sm:text-lg text-cyan-50 max-w-xl mx-auto mt-4 leading-relaxed font-medium">

                    Jangan biarkan pesaing Anda lebih dulu ditemukan pelanggan
                    di internet. Mulai bangun eksistensi digital Anda hari ini
                    bersama Bisma Labs.
                </p>

                <div class="mt-10 flex flex-wrap justify-center gap-5">

                    <a
                        href="{{ route('order.template') }}"
                        class="px-9 py-4 bg-white hover:bg-slate-100 text-[#0396c7] font-black text-base rounded-2xl shadow-lg transition transform hover:-translate-y-0.5"
                    >

                        Daftar Sekarang
                    </a>
                    <a
                        href="https://wa.me/6281234567890?text=Halo%20BismaLabs,%20saya%20ingin%20konsultasi%20pembuatan%20website"
                        target="_blank"
                        class="px-9 py-4 bg-[#027ea7] hover:bg-[#026c8e] text-white font-bold text-base rounded-2xl border border-cyan-300/40 transition"
                    >

                        Konsultasi Gratis
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="fixed bottom-8 right-8 z-40">
        <a
            href="https://wa.me/6281234567890?text=Halo%20BismaLabs"
            target="_blank"
            class="w-14 h-14 bg-emerald-600 hover:bg-emerald-500 text-white rounded-full flex items-center justify-center shadow-xl shadow-emerald-950/30 transition hover:scale-110"
        >
            <svg
                class="w-7 h-7 fill-current"
                viewBox="0 0 24 24"    >
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
            </svg>
        </a>
    </div>

    {{-- MODAL REMINDER --}}
    @include('partials.template_landing')

    {{-- FOOTER --}}
    @include('partials.footer')


</body>

</html>