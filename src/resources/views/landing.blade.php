<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $website['seo']['title'] ?? 'Bisma Labs' }}</title>
    <meta name="description" content="{{ $website['seo']['description'] ?? '' }}">
    <meta name="keywords" content="{{ $website['seo']['keywords'] ?? '' }}">
    <meta property="og:title" content="{{ $website['seo']['title'] ?? '' }}">
    <meta property="og:description" content="{{ $website['seo']['description'] ?? '' }}">
    @if(!empty($website['seo']['og_image']))
        <meta property="og:image" content="{{ asset($website['seo']['og_image']) }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-800 antialiased selection:bg-[#0396c7] selection:text-white">

    @include('partials.navbar')

    {{-- HERO --}}
    <section class="max-w-7xl mx-auto px-6 sm:px-10 pt-40 pb-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            <div class="lg:col-span-7">
                <div class="inline-block px-4 py-2 bg-slate-100 text-slate-700 rounded-full text-xs sm:text-sm font-extrabold uppercase tracking-wider mb-6">
                    {{ $website['header']['badge'] ?? 'TERPERCAYA' }}
                </div>
                <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black text-slate-900 leading-[1.15] tracking-tight">
                    {{ $website['body']['hero_title'] ?? 'Judul Website' }}
                    @if(!empty($website['body']['hero_highlight']))
                        <br>
                        <span class="text-[#0396c7]">{{ $website['body']['hero_highlight'] }}</span>
                    @endif
                </h1>
                <p class="mt-8 text-lg sm:text-xl text-slate-600 leading-relaxed max-w-xl font-medium">
                    {{ $website['body']['hero_description'] ?? 'Deskripsi singkat website.' }}
                </p>
                <div class="mt-10 flex flex-wrap items-center gap-5">
                    <a href="{{ $website['header']['button_link'] ?? '#' }}" class="px-8 py-4 bg-[#0396c7] hover:bg-[#027ea7] text-white text-base sm:text-lg font-black rounded-2xl shadow-xl shadow-cyan-900/20 transition transform hover:-translate-y-0.5">
                        {{ $website['header']['button_text'] ?? 'Mulai Sekarang' }}
                    </a>
                    <a href="#templates-section" class="px-7 py-4 bg-slate-100 hover:bg-slate-200 text-slate-800 text-base sm:text-lg font-bold rounded-2xl flex items-center gap-3 transition">
                        <svg class="w-6 h-6 text-slate-700" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        Lihat Demo
                    </a>
                </div>
            </div>
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative rounded-3xl p-4 sm:p-5 bg-gradient-to-tr from-cyan-50 via-slate-50 to-white shadow-2xl border border-slate-200 w-full max-w-lg">
                    <img src="{{ str_starts_with($website['body']['hero_image'] ?? 'jpg1.jpg', 'storage/') ? asset($website['body']['hero_image']) : asset($website['body']['hero_image'] ?? 'jpg1.jpg') }}" alt="{{ $website['header']['site_name'] ?? 'Website' }}" onerror="this.onerror=null; this.src='{{ asset('tech2.png') }}';" class="rounded-2xl w-full h-auto object-cover aspect-[4/3] shadow-inner">
                </div>
            </div>
        </div>
    </section>

    {{-- MASALAH KLASIK --}}
    <section id="solusi" class="py-24 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-6 sm:px-10">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight">
                    Masalah Klasik Saat Bikin Website
                </h2>
                <div class="w-24 h-1.5 bg-[#0396c7] mx-auto mt-4 rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 sm:p-9 rounded-3xl border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center font-black text-2xl mb-6">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18" /></svg>
                        </div>
                        <h3 class="font-extrabold text-slate-900 text-xl sm:text-2xl">{{ $website['body']['problem_1_title'] ?? 'Masalah 1' }}</h3>
                        <p class="text-base text-slate-600 mt-4 leading-relaxed font-normal">{{ $website['body']['problem_1_description'] ?? 'Deskripsi masalah 1' }}</p>
                    </div>
                </div>
                <div class="bg-white p-8 sm:p-9 rounded-3xl border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center text-2xl mb-6">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="6" width="18" height="12" rx="2" /><path stroke-linecap="round" d="M3 10h18" /></svg>
                        </div>
                        <h3 class="font-extrabold text-slate-900 text-xl sm:text-2xl">{{ $website['body']['problem_2_title'] ?? 'Masalah 2' }}</h3>
                        <p class="text-base text-slate-600 mt-4 leading-relaxed font-normal">{{ $website['body']['problem_2_description'] ?? 'Deskripsi masalah 2' }}</p>
                    </div>
                </div>
                <div class="bg-white p-8 sm:p-9 rounded-3xl border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center text-2xl mb-6">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="8" /><path stroke-linecap="round" d="M12 8v4l2.5 2" /></svg>
                        </div>
                        <h3 class="font-extrabold text-slate-900 text-xl sm:text-2xl">{{ $website['body']['problem_3_title'] ?? 'Masalah 3' }}</h3>
                        <p class="text-base text-slate-600 mt-4 leading-relaxed font-normal">{{ $website['body']['problem_3_description'] ?? 'Deskripsi masalah 3' }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-16 grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                <div class="lg:col-span-8 bg-[#eef6fc] p-10 sm:p-14 rounded-3xl border border-cyan-200 flex flex-col justify-between">
                    <div>
                        <span class="text-sm sm:text-base font-extrabold text-slate-700 uppercase tracking-wider">Solusi Cerdas:</span>
                        <h3 class="text-3xl sm:text-4xl font-black text-[#0396c7] mt-2 leading-snug">{{ $website['body']['solution_title'] ?? 'Solusi Kami' }}</h3>
                        <p class="text-base sm:text-lg text-slate-700 mt-5 leading-relaxed max-w-2xl font-normal">{{ $website['body']['solution_description'] ?? 'Deskripsi solusi' }}</p>
                    </div>
                    <div class="mt-10 flex flex-wrap items-center gap-6 sm:gap-8 text-base sm:text-lg font-bold text-[#0396c7]">
                        <span class="flex items-center gap-2.5"><span class="w-6 h-6 rounded-full bg-cyan-100 border border-[#0396c7] flex items-center justify-center text-xs font-black">✓</span> 100% Cepat</span>
                        <span class="flex items-center gap-2.5"><span class="w-6 h-6 rounded-full bg-cyan-100 border border-[#0396c7] flex items-center justify-center text-xs font-black">✓</span> Sangat Mudah</span>
                        <span class="flex items-center gap-2.5"><span class="w-6 h-6 rounded-full bg-cyan-100 border border-[#0396c7] flex items-center justify-center text-xs font-black">✓</span> Harga Terjangkau</span>
                    </div>
                </div>
                <div class="lg:col-span-4 bg-[#0396c7] text-white p-10 sm:p-12 rounded-3xl flex flex-col items-center justify-center text-center shadow-xl">
                    <div class="text-5xl sm:text-6xl font-black font-mono flex items-center gap-2"><span>&lt;</span> 1 jam</div>
                    <p class="text-base sm:text-lg text-cyan-50 mt-4 max-w-[260px] leading-relaxed font-semibold">Website Anda dapat langsung diproses dengan cepat.</p>
                </div>
            </div>
        </div>
    </section>

{{-- 3 PREVIEW TEMPLATE AJA --}}
<section id="templates-section" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 sm:px-10">

        <div class="text-center max-w-2xl mx-auto mb-16">

            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight">
                Pilih Desain Sesuai Industri Anda
            </h2>

            <p class="text-base sm:text-lg text-slate-600 mt-4">
                Ratusan template siap pakai yang didesain untuk membantu bisnis Anda tampil profesional.
            </p>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse ($templates->take(3) as $template)

                @php
                    $templateData = $template->template_data ?? [];

                    $templateHeader = $templateData['header'] ?? [];
                    $templateBody = $templateData['body'] ?? [];
                    $templateStyle = $templateData['style'] ?? [];

                    $templateName =
                        $templateData['name']
                        ?? $templateHeader['site_name']
                        ?? $template->name;

                    $templateDescription =
                        $templateBody['hero_description']
                        ?? $template->description;

                    $templateImage =
                        $templateBody['hero_image']
                        ?? $template->images
                            ->where('is_primary', true)
                            ->first()
                            ->image_path
                        ?? 'jpg1.jpg';

                    $templatePrimary =
                        $templateStyle['primary']
                        ?? '#0396c7';
                @endphp

                <div
                    class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-md flex flex-col justify-between hover:shadow-xl transition duration-200"
                >

                    <div class="h-64 bg-slate-900 overflow-hidden relative group">

                        <img
                            src="{{ asset($templateImage) }}"
                            alt="{{ $templateName }}"
                            onerror="this.onerror=null; this.src='{{ asset('jpg1.jpg') }}';"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                        >

                        <span
                            class="absolute top-4 right-4 text-xs font-bold px-3 py-1 bg-white/95 rounded-lg text-slate-800 shadow-sm"
                        >
                            {{ $template->type->name ?? 'Template' }}
                        </span>

                    </div>

                    <div class="p-8">

                        <h3 class="font-extrabold text-slate-900 text-xl sm:text-2xl mb-2">
                            {{ $templateName }}
                        </h3>

                        <p class="text-sm sm:text-base text-slate-600 line-clamp-2 leading-relaxed mb-6">
                            {{ $templateDescription }}
                        </p>

                        <div class="flex items-center gap-3">

                            <a
                                href="{{ route('template.preview', $template->slug) }}"
                                target="_blank"
                                class="w-1/2 py-3.5 text-center text-sm font-bold bg-slate-100 hover:bg-slate-200 text-slate-800 rounded-xl transition"
                            >
                                Preview
                            </a>

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
                                    style="background-color: {{ $templatePrimary }};"
                                    class="w-full py-3.5 text-center text-sm font-black text-white rounded-xl shadow-md transition hover:opacity-90"
                                >
                                    Use Template
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-span-full py-20 text-center border-2 border-dashed border-slate-200 rounded-3xl">

                    <p class="text-slate-500 font-bold">
                        Belum ada template yang tersedia.
                    </p>

                </div>

            @endforelse

        </div>

        <div class="mt-14 text-center">

            <a
                href="{{ route('order.template') }}"
                class="inline-flex items-center gap-3 px-10 py-4 bg-slate-100 hover:bg-slate-200 text-slate-800 text-base font-extrabold rounded-2xl transition"
            >

                <span>
                    Lihat Semua Template
                </span>

                <svg
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 12h14M13 6l6 6-6 6"
                    />
                </svg>

            </a>

        </div>

    </div>
</section>

    {{-- PRICING --}}
    <section id="pricing-section" class="py-24 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-6 sm:px-10">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight">Investasi Terjangkau untuk Bisnis Anda</h2>
                <p class="text-base sm:text-lg text-slate-600 mt-4">Pilih paket yang paling sesuai dengan skala usaha Anda saat ini.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-{{ count($packages) > 4 ? 4 : count($packages) }} gap-8 items-stretch">
                @foreach($packages as $pkg)
                    <div class="bg-white rounded-3xl p-8 flex flex-col justify-between transition {{ $pkg->is_popular ? 'border-2 border-[#0396c7] shadow-2xl relative transform lg:-translate-y-3' : 'border border-slate-200 shadow-sm hover:shadow-md' }}">
                        @if($pkg->is_popular)
                            <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-[#0396c7] text-white text-xs font-black uppercase tracking-wider px-5 py-1.5 rounded-full shadow-md whitespace-nowrap">Paling Populer</div>
                        @endif
                        <div>
                            <span class="text-xs font-bold text-[#0396c7] uppercase font-mono tracking-wider">PAKET LAYANAN</span>
                            <h3 class="text-xl font-extrabold text-slate-900 mt-1">{{ $pkg->name }}</h3>
                            <div class="mt-4 text-3xl sm:text-4xl font-black text-slate-900 font-mono">
                                Rp {{ number_format($pkg->price_annually / 1000, 0, ',', '.') }}k
                                <span class="text-sm font-normal text-slate-500 font-sans">/thn</span>
                            </div>
                            <ul class="mt-8 space-y-4 text-sm sm:text-base text-slate-700 font-medium">
                                @foreach($pkg->features->take(4) as $feature)
                                    @if($feature->pivot->is_included)
                                        <li class="flex items-center gap-3"><span class="text-[#0396c7] font-bold text-lg">✓</span>{{ $feature->name }}</li>
                                    @else
                                        <li class="flex items-center gap-3 text-slate-400"><span>✕</span>{{ $feature->name }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('order.package') }}" class="block w-full mt-8 py-3.5 text-center text-sm font-black bg-[#0396c7] hover:bg-[#027ea7] text-white rounded-xl shadow-md transition">Pilih Paket</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 4 LANGKAH --}}
    <section class="py-24 bg-[#f0f4f9] border-t border-slate-200">
        <div class="max-w-6xl mx-auto px-6 sm:px-10">
            <div class="text-center max-w-2xl mx-auto mb-20">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight">4 Langkah Mudah Menuju Go-Digital</h2>
                <p class="text-base sm:text-lg text-slate-600 mt-4">Proses transparan dan efisien tanpa menyita waktu Anda.</p>
            </div>
            <div class="relative">
                <div class="hidden md:block absolute top-7 left-16 right-16 border-t-2 border-dashed border-cyan-300 -z-0"></div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10 relative z-10">
                    @php
                        $steps = [
                            ['number' => '1', 'title' => 'Pilih Template', 'description' => 'Tentukan desain dasar yang paling mewakili brand Anda.'],
                            ['number' => '2', 'title' => 'Pilih Domain', 'description' => 'Cari alamat domain terbaik sesuai kebutuhan Anda.'],
                            ['number' => '3', 'title' => 'Pilih Paket', 'description' => 'Sesuaikan opsi dan harga yang paling pas untuk website Anda.'],
                            ['number' => '4', 'title' => 'Live!', 'description' => 'Website siap dikunjungi pelanggan dari seluruh dunia.'],
                        ];
                    @endphp
                    @foreach ($steps as $step)
                        <div class="flex flex-col items-center text-center">
                            <div class="w-14 h-14 rounded-full bg-[#0396c7] text-white flex items-center justify-center font-black text-base shadow-lg mb-5">{{ $step['number'] }}</div>
                            <h4 class="font-extrabold text-slate-900 text-base sm:text-lg">{{ $step['title'] }}</h4>
                            <p class="text-sm text-slate-600 mt-2 max-w-[180px] leading-relaxed">{{ $step['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6 sm:px-10">
            <div class="bg-[#0396c7] rounded-3xl p-12 sm:p-16 text-center text-white shadow-2xl">
                <h2 class="text-3xl sm:text-5xl font-black tracking-tight">{{ $website['body']['cta_title'] ?? 'Mulai Sekarang' }}</h2>
                <p class="text-base sm:text-lg text-cyan-50 max-w-xl mx-auto mt-4 leading-relaxed font-medium">{{ $website['body']['cta_description'] ?? 'Tingkatkan bisnis Anda' }}</p>
                <div class="mt-10 flex flex-wrap justify-center gap-5">
                    <a href="{{ route('order.template') }}" class="px-9 py-4 bg-white hover:bg-slate-100 text-[#0396c7] font-black text-base rounded-2xl shadow-lg transition transform hover:-translate-y-0.5">{{ $website['body']['cta_button_text'] ?? 'Buat Website' }}</a>
                    <a href="https://wa.me/{{ $website['sidebar']['whatsapp'] ?? '' }}?text={{ urlencode($website['sidebar']['whatsapp_message'] ?? '') }}" target="_blank" class="px-9 py-4 bg-[#027ea7] hover:bg-[#026c8e] text-white font-bold text-base rounded-2xl border border-cyan-300/40 transition">Konsultasi Gratis</a>
                </div>
            </div>
        </div>
    </section>

    @include('partials.template_landing')
    @include('partials.footer')
</body>
</html>