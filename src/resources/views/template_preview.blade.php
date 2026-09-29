<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview {{ $template->name }} | Bisma Labs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased h-screen flex flex-col overflow-hidden">
    
    {{-- TOPBAR PREVIEW MODE --}}
    <div class="h-16 bg-slate-900 text-white flex items-center justify-between px-8 shrink-0 relative z-50 shadow-md">
        <div class="flex items-center gap-5">
            <a href="{{ url()->previous() }}" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-700 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <span class="text-[10px] font-bold text-sky-400 uppercase tracking-widest">Mode Preview</span>
                <h1 class="text-sm font-bold mt-0.5">{{ $template->name }}</h1>
            </div>
        </div>
        
        <form action="{{ route('order.template.store') }}" method="POST">
            @csrf
            <input type="hidden" name="template_id" value="{{ $template->id }}">
            <button type="submit" class="px-6 py-2.5 bg-[#0396c7] hover:bg-[#027ea7] text-white text-xs font-bold rounded-xl transition shadow-sm flex items-center gap-2">
                Gunakan Template Ini
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </button>
        </form>
    </div>

    {{-- KONTEN TEMPLATE (SIMULASI) --}}
    <div class="flex-1 w-full bg-white relative overflow-y-auto">
        {{-- Navbar Simulasi --}}
        <div class="h-24 flex items-center px-10 sm:px-16 gap-2 shrink-0">
            <div class="text-xl font-black text-slate-900 tracking-tight uppercase">
                Brand Anda
            </div>
            <div class="ml-auto flex gap-8 text-xs font-bold text-slate-500 uppercase tracking-widest">
                <span class="text-[#0369a1] border-b-2 border-[#0369a1] pb-1.5">Home</span>
                <span class="hover:text-slate-800 cursor-pointer pb-1.5 transition">Portfolio</span>
                <span class="hover:text-slate-800 cursor-pointer pb-1.5 transition">Contact</span>
            </div>
        </div>
        
        {{-- Hero Simulasi --}}
        <div class="flex flex-col lg:flex-row items-center justify-between p-10 sm:p-16 lg:px-20 lg:py-24 text-center lg:text-left relative overflow-hidden bg-slate-50 min-h-[calc(100vh-160px)]">
            <div class="absolute inset-0 opacity-[0.04]" style="background: radial-gradient(circle at center, {{ $templateData['theme_color'] }}, transparent 70%);"></div>
            
            <div class="relative z-10 max-w-2xl">
                <h1 class="text-5xl sm:text-6xl font-black mb-6 leading-[1.15] tracking-tight" style="color: {{ $templateData['theme_color'] }}">
                    {{ $templateData['hero_title'] }}
                </h1>
                <p class="text-slate-600 leading-relaxed text-lg font-medium mb-10">
                    {{ $templateData['hero_subtitle'] }}
                </p>
                
                <button class="px-10 py-4 text-white font-bold rounded-2xl shadow-xl transition-transform hover:-translate-y-1 text-base" style="background-color: {{ $templateData['theme_color'] }}; box-shadow: 0 10px 20px -5px {{ $templateData['theme_color'] }}60;">
                    {{ $templateData['button_text'] }}
                </button>
            </div>

            <div class="w-full lg:w-[450px] h-[300px] lg:h-[450px] mt-16 lg:mt-0 rounded-[32px] overflow-hidden shadow-2xl relative z-10">
                <img src="{{ str_starts_with($templateData['hero_image'], 'storage/') ? asset($templateData['hero_image']) : asset($templateData['hero_image']) }}" class="w-full h-full object-cover">
            </div>
        </div>
    </div>

</body>
</html>