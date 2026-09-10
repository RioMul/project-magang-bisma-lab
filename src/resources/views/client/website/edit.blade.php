<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Editor | Bisma Labs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f8fafc] text-slate-800 font-sans antialiased flex flex-col h-screen overflow-hidden">

    {{-- TOP NAVBAR --}}
    <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 shrink-0 z-10">
        <div class="flex items-center gap-8">
            <h1 class="text-xl font-black text-slate-900 tracking-tight">Bisma Labs</h1>
            <nav class="hidden md:flex gap-6 h-full items-center pt-1">
                <a href="#" class="text-sm font-bold text-[#0369a1] border-b-2 border-[#0369a1] pb-5 pt-4">Editor</a>
                <a href="#" class="text-sm font-bold text-slate-400 hover:text-slate-600 pb-5 pt-4 border-b-2 border-transparent transition">SEO</a>
                <a href="#" class="text-sm font-bold text-slate-400 hover:text-slate-600 pb-5 pt-4 border-b-2 border-transparent transition">Domain</a>
            </nav>
        </div>
        <div class="flex items-center gap-6">
            <a href="#" class="text-sm font-bold text-slate-500 hover:text-slate-800 transition">Preview Website</a>
            <form action="{{ route('client.website.update') }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="px-6 py-2 bg-[#0369a1] hover:bg-[#0284c7] text-white text-sm font-bold rounded-lg shadow-sm transition">Save</button>
            </form>
        </div>
    </header>

    <div class="flex flex-1 overflow-hidden">
        {{-- LEFT SIDEBAR --}}
        <aside class="w-64 bg-white border-r border-slate-200 flex flex-col justify-between shrink-0 z-10">
            <div class="p-6">
                <h2 class="font-black text-slate-900">Atelier Editor</h2>
                <p class="text-xs text-slate-400 mt-1">Site Settings</p>

                <nav class="mt-8 space-y-1">
                    <a href="#" class="block px-4 py-3 bg-white border border-slate-100 shadow-sm text-[#0369a1] rounded-xl font-bold text-sm">Header</a>
                    <a href="#" class="block px-4 py-3 text-slate-500 hover:bg-slate-50 rounded-xl font-medium text-sm transition">Body</a>
                    <a href="#" class="block px-4 py-3 text-slate-500 hover:bg-slate-50 rounded-xl font-medium text-sm transition">Sidebar</a>
                    <a href="#" class="block px-4 py-3 text-slate-500 hover:bg-slate-50 rounded-xl font-medium text-sm transition">Footer</a>
                </nav>
            </div>
            <div class="p-6 flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="flex-1 py-2.5 bg-[#0369a1] hover:bg-[#0284c7] text-white text-center font-bold text-sm rounded-xl shadow-sm transition flex items-center justify-center gap-2">
                    <span>&larr;</span> Kembali
                </a>
                <button class="w-10 h-10 ml-3 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:text-[#0369a1] hover:border-[#0369a1] transition shrink-0">
                    ?
                </button>
            </div>
        </aside>

        {{-- SETTINGS PANEL --}}
        <div class="w-96 bg-[#f8fafc] border-r border-slate-200 overflow-y-auto p-8 shrink-0 z-0">
            <h2 class="text-xl font-bold text-slate-800 mb-2">General Settings</h2>
            <p class="text-sm text-slate-500 mb-8 leading-relaxed">Customize your basic business information. Changes will reflect in the live preview instantly.</p>

            <div class="space-y-6">
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Business Name</label>
                    <input type="text" value="{{ $websiteData['business_name'] }}" class="w-full px-4 py-3 bg-white border-0 rounded-xl text-sm font-medium text-slate-700 shadow-sm focus:ring-2 focus:ring-sky-100">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Description</label>
                    <textarea rows="4" class="w-full px-4 py-3 bg-white border-0 rounded-xl text-sm font-medium text-slate-700 shadow-sm focus:ring-2 focus:ring-sky-100 resize-none">{{ $websiteData['description'] }}</textarea>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Phone Number</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg></span>
                        <input type="text" value="{{ $websiteData['phone'] }}" class="w-full pl-11 pr-4 py-3 bg-white border-0 rounded-xl text-sm font-medium text-slate-700 shadow-sm focus:ring-2 focus:ring-sky-100">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Business Address</label>
                    <input type="text" value="{{ $websiteData['address'] }}" class="w-full px-4 py-3 bg-white border-0 rounded-xl text-sm font-medium text-slate-700 shadow-sm focus:ring-2 focus:ring-sky-100">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Upload Images</label>
                    <div class="w-full h-32 bg-white border-2 border-dashed border-slate-200 rounded-xl flex flex-col items-center justify-center cursor-pointer hover:bg-slate-50 transition">
                        <div class="w-10 h-10 bg-sky-50 text-[#0369a1] rounded-full flex items-center justify-center mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-slate-700">Drag and drop images</span>
                        <span class="text-[10px] text-slate-400 mt-0.5">JPG, PNG, or WebP up to 10MB</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- LIVE PREVIEW PANEL --}}
        <div class="flex-1 bg-[#eef2f6] relative flex flex-col items-center justify-center p-8 overflow-hidden">
            
            {{-- Browser Mockup --}}
            <div class="flex items-center gap-2 absolute top-6 left-8 bg-white px-4 py-2 rounded-full shadow-sm">
                <div class="w-2.5 h-2.5 rounded-full bg-rose-400"></div>
                <div class="w-2.5 h-2.5 rounded-full bg-amber-400"></div>
                <div class="w-2.5 h-2.5 rounded-full bg-emerald-400"></div>
                <span class="text-[10px] font-bold text-slate-500 ml-4">www.bismalabs.atelier.com</span>
            </div>

            {{-- Website Content Canvas --}}
            <div class="w-full max-w-3xl bg-white h-[600px] rounded-2xl shadow-xl overflow-hidden flex flex-col">
                <div class="px-10 py-6 border-b border-slate-100 flex items-center justify-between shrink-0">
                    <span class="font-black text-slate-900 tracking-tight">{{ $websiteData['business_name'] }}</span>
                    <nav class="flex gap-6 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                        <a href="#" class="text-[#0369a1] border-b-2 border-[#0369a1] pb-1">Home</a>
                        <a href="#" class="hover:text-slate-800 transition pb-1">Portfolio</a>
                        <a href="#" class="hover:text-slate-800 transition pb-1">Contact</a>
                    </nav>
                </div>
                
                <div class="flex-1 flex px-10 py-12 gap-10">
                    <div class="flex-1 flex flex-col justify-center">
                        <h2 class="text-4xl font-black text-slate-900 leading-[1.1] tracking-tight">Crafting Digital <span class="text-[#0369a1]">Elegance</span> for Your Brand.</h2>
                        <p class="text-sm text-slate-500 mt-6 leading-relaxed pr-6">{{ $websiteData['description'] }}</p>
                        <div class="flex gap-4 mt-8">
                            <button class="px-6 py-3 bg-[#0369a1] text-white text-xs font-bold rounded-lg shadow-sm">Get Started</button>
                            <button class="px-6 py-3 bg-slate-200 text-slate-700 text-xs font-bold rounded-lg">Our Work</button>
                        </div>
                    </div>
                    <div class="flex-1 bg-slate-200 rounded-2xl overflow-hidden relative shadow-inner">
                        <img src="https://images.unsplash.com/photo-1616423640778-28d1b53229bd?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-tr from-sky-900/20 to-transparent mix-blend-multiply"></div>
                    </div>
                </div>
            </div>

            {{-- View Toggle --}}
            <div class="absolute bottom-6 flex items-center gap-6 text-xs font-bold text-slate-400">
                <button class="flex items-center gap-2 hover:text-slate-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    Mobile View
                </button>
                <button class="flex items-center gap-2 text-[#0369a1]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Desktop View
                </button>
            </div>

        </div>
    </div>

</body>
</html>