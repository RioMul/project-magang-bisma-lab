<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Desain Template Website | BismaLabs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col justify-between selection:bg-[#0396c7] selection:text-white">

    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- KONTEN UTAMA WIZARD --}}
    <main class="max-w-6xl mx-auto px-6 py-10 w-full flex-1">
        
        {{-- STEPPER HEADER (1 of 4) --}}
        <div class="mb-10 text-center max-w-xl mx-auto">
            <div class="flex items-center justify-center gap-3 mb-4">
                <span class="w-8 h-8 rounded-full bg-[#0396c7] text-white flex items-center justify-center font-black text-xs shadow-md">1</span>
                <div class="w-8 h-0.5 bg-slate-200"></div>
                <span class="w-8 h-8 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center font-bold text-xs">2</span>
                <div class="w-8 h-0.5 bg-slate-200"></div>
                <span class="w-8 h-8 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center font-bold text-xs">3</span>
                <div class="w-8 h-0.5 bg-slate-200"></div>
                <span class="w-8 h-8 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center font-bold text-xs">4</span>
            </div>
            <span class="text-[11px] font-bold uppercase tracking-widest text-[#0396c7]">Langkah 1 dari 4</span>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-1">Pilih Desain Template Anda</h1>
            <p class="text-xs text-slate-500 mt-2">Pilih arsitektur visual yang paling mewakili identitas brand atau usaha Anda.</p>
        </div>

        {{-- FILTER KATEGORI --}}
        <div class="flex flex-wrap items-center justify-center gap-2 mb-10">
            @foreach ($categories as $cat)
                @php
                    $isActive = ($category === $cat) || (empty($category) && $cat === 'All Templates');
                @endphp
                <a href="{{ route('order.template', ['category' => $cat]) }}" 
                   class="px-4 py-2 rounded-xl text-xs font-bold transition {{ $isActive ? 'bg-[#0396c7] text-white shadow-md shadow-cyan-900/20' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-100' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        {{-- GRID TEMPLATE --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch">
            @forelse ($templates as $template)
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-lg transition-all duration-200 flex flex-col group">
                    {{-- Preview Container --}}
                    <div class="relative overflow-hidden h-52 bg-slate-900 flex items-center justify-center p-3">
                        <img src="{{ $template->preview_image }}" 
                             alt="{{ $template->name }}" 
                             loading="lazy" 
                             decoding="async" 
                             class="w-full h-full object-cover rounded-lg group-hover:scale-105 transition duration-300">
                        
                        <div class="absolute top-5 right-5">
                            <span class="text-[10px] font-extrabold px-2.5 py-1 bg-white/90 backdrop-blur-sm text-[#0a5688] rounded-md shadow-sm">
                                {{ $template->category }}
                            </span>
                        </div>
                    </div>

                    {{-- Info & Action --}}
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between">
                                <h3 class="font-black text-slate-900 text-base">{{ $template->name }}</h3>
                                <div class="text-xs font-mono font-bold text-emerald-600">
                                    Rp {{ number_format($template->setup_price, 0, ',', '.') }}
                                </div>
                            </div>
                            <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">
                                {{ $template->description }}
                            </p>
                        </div>

                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-2">
                            @if ($template->demo_url)
                                <a href="{{ $template->demo_url }}" target="_blank" class="w-1/2 py-2.5 text-center text-xs font-bold bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl transition">
                                    Live Demo
                                </a>
                            @endif

                            <form action="{{ route('order.template.post') }}" method="POST" class="w-full">
                                @csrf
                                <input type="hidden" name="template_id" value="{{ $template->id }}">
                                <button type="submit" class="w-full py-2.5 text-center text-xs font-black bg-[#0396c7] hover:bg-[#027ea7] text-white rounded-xl shadow-md transition">
                                    Gunakan Desain
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-slate-200">
                    <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-xl mb-3">
                        🔍
                    </div>
                    <p class="text-sm font-semibold text-slate-500">Belum ada template pada kategori ini.</p>
                    <a href="{{ route('order.template') }}" class="mt-3 inline-block text-xs font-bold text-[#0396c7] hover:underline">
                        Tampilkan Semua Template
                    </a>
                </div>
            @endforelse
        </div>

    </main>

    {{-- FOOTER --}}
    @include('partials.footer')

</body>
</html>