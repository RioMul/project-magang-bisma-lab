<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atelier Editor | Bisma Labs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: #94a3b8; }
    </style>
</head>
<body 
    class="bg-white text-slate-800 antialiased h-screen flex flex-col overflow-hidden font-sans"
    x-data="atelierEditor()"
>

    {{-- TOP NAVBAR --}}
    <header class="h-[72px] bg-white border-b border-slate-200 flex items-center justify-between px-8 shrink-0 relative z-20">
        <div class="flex items-center gap-14 h-full">
            {{-- Logo --}}
            <div class="text-xl font-extrabold tracking-tight text-slate-900">
                Bisma Labs
            </div>

            {{-- Tabs Control --}}
            <nav class="flex items-center h-full gap-8 text-sm font-semibold text-slate-400">
                <button 
                    @click="activeTab = 'editor'" 
                    :class="activeTab === 'editor' ? 'text-[#0369a1] border-b-2 border-[#0369a1]' : 'hover:text-slate-600'" 
                    class="h-full flex items-center px-1 transition-colors">
                    Editor
                </button>
                <button 
                    @click="activeTab = 'seo'" 
                    :class="activeTab === 'seo' ? 'text-[#0369a1] border-b-2 border-[#0369a1]' : 'hover:text-slate-600'" 
                    class="h-full flex items-center px-1 transition-colors">
                    SEO
                </button>
                <button 
                    @click="activeTab = 'domain'" 
                    :class="activeTab === 'domain' ? 'text-[#0369a1] border-b-2 border-[#0369a1]' : 'hover:text-slate-600'" 
                    class="h-full flex items-center px-1 transition-colors">
                    Domain
                </button>
            </nav>
        </div>

        <div class="flex items-center gap-6">
            <button class="text-sm font-bold text-slate-500 hover:text-slate-800 transition">
                Preview Website
            </button>
            <button type="submit" form="editor-form" class="px-7 py-2.5 rounded-xl bg-[#0369a1] hover:bg-[#075985] text-white text-sm font-bold transition shadow-sm">
                Save
            </button>
        </div>
    </header>

    {{-- MAIN AREA --}}
    <main class="flex-1 flex overflow-hidden">
        
        {{-- LEFT SIDEBAR (Menu Section) --}}
        <aside class="w-56 bg-white border-r border-slate-100 flex flex-col justify-between py-8 px-5 shrink-0 z-10 shadow-[4px_0_24px_rgba(0,0,0,0.02)]">
            <div>
                <div class="mb-8 px-2">
                    <h2 class="text-sm font-bold text-slate-800">Atelier Editor</h2>
                    <p class="text-[10px] font-medium text-slate-400 mt-0.5">Site Settings</p>
                </div>

                <nav class="space-y-1.5" x-show="activeTab === 'editor'">
                    <button @click="activeMenu = 'header'" :class="activeMenu === 'header' ? 'bg-sky-50 text-[#0369a1] font-bold border border-sky-100' : 'text-slate-500 hover:bg-slate-50 font-semibold border border-transparent'" class="w-full flex items-center px-4 py-2.5 rounded-xl text-xs transition text-left">
                        Header
                    </button>
                    <button @click="activeMenu = 'body'" :class="activeMenu === 'body' ? 'bg-sky-50 text-[#0369a1] font-bold border border-sky-100' : 'text-slate-500 hover:bg-slate-50 font-semibold border border-transparent'" class="w-full flex items-center px-4 py-2.5 rounded-xl text-xs transition text-left">
                        Body
                    </button>
                    <button @click="activeMenu = 'sidebar'" :class="activeMenu === 'sidebar' ? 'bg-sky-50 text-[#0369a1] font-bold border border-sky-100' : 'text-slate-500 hover:bg-slate-50 font-semibold border border-transparent'" class="w-full flex items-center px-4 py-2.5 rounded-xl text-xs transition text-left">
                        Sidebar
                    </button>
                    <button @click="activeMenu = 'footer'" :class="activeMenu === 'footer' ? 'bg-sky-50 text-[#0369a1] font-bold border border-sky-100' : 'text-slate-500 hover:bg-slate-50 font-semibold border border-transparent'" class="w-full flex items-center px-4 py-2.5 rounded-xl text-xs transition text-left">
                        Footer
                    </button>
                </nav>
            </div>

            <div class="space-y-4 px-2">
                <a href="{{ route('dashboard') }}" class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-[#0369a1] hover:bg-[#075985] text-white text-xs font-bold transition shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali
                </a>
                <button class="w-9 h-9 rounded-full border border-slate-200 flex items-center justify-center text-[#0369a1] hover:bg-sky-50 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </button>
            </div>
        </aside>

        {{-- MIDDLE COLUMN (Settings Form) --}}
        <div class="w-[420px] bg-slate-50/50 border-r border-slate-100 overflow-y-auto shrink-0 custom-scrollbar">
            <form id="editor-form" method="POST" action="{{ route('client.website.update') }}" class="p-8 space-y-6">
                @csrf
                @method('PUT')

                {{-- PANEL EDITOR: GENERAL SETTINGS --}}
                <div x-show="activeTab === 'editor'" x-transition.opacity>
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-slate-800 tracking-tight">General Settings</h2>
                        <p class="text-[11px] text-slate-500 mt-2 leading-relaxed">
                            Customize your basic business information. Changes will reflect in the live preview instantly.
                        </p>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 mb-2">Business Name</label>
                            <input type="text" name="business_name" x-model="formData.business_name" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-700 outline-none focus:border-[#0369a1] focus:ring-2 focus:ring-sky-50 transition shadow-sm">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 mb-2">Description</label>
                            <textarea name="description" x-model="formData.description" rows="5" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-xs font-medium text-slate-600 outline-none focus:border-[#0369a1] focus:ring-2 focus:ring-sky-50 transition shadow-sm resize-none leading-relaxed"></textarea>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 mb-2">Phone Number</label>
                            <div class="relative">
                                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <input type="text" name="phone" x-model="formData.phone" class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-500 outline-none focus:border-[#0369a1] focus:ring-2 focus:ring-sky-50 transition shadow-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 mb-2">Business Address</label>
                            <textarea name="address" x-model="formData.address" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-xs font-medium text-slate-500 outline-none focus:border-[#0369a1] focus:ring-2 focus:ring-sky-50 transition shadow-sm resize-none leading-relaxed"></textarea>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 mb-2">Upload Images</label>
                            <div class="w-full border-2 border-dashed border-slate-200 rounded-2xl bg-white p-8 flex flex-col items-center justify-center text-center cursor-pointer hover:bg-slate-50 transition">
                                <div class="w-10 h-10 rounded-full bg-sky-50 text-[#0369a1] flex items-center justify-center mb-3">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4m-4-5l-4-4m0 0L8 11m4-4v12"/></svg>
                                </div>
                                <span class="text-[11px] font-bold text-slate-800">Drag and drop images</span>
                                <span class="text-[9px] font-medium text-slate-400 mt-1">JPG, PNG, or WebP up to 10MB</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PANEL SEO SETTINGS --}}
                <div x-show="activeTab === 'seo'" x-cloak x-transition.opacity>
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-slate-800 tracking-tight">SEO Configuration</h2>
                        <p class="text-[11px] text-slate-500 mt-2 leading-relaxed">
                            Optimize your page to rank better on search engines.
                        </p>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 mb-2">URL Slug</label>
                            <div class="flex">
                                <span class="flex items-center px-3 bg-slate-100 border border-r-0 border-slate-200 rounded-l-xl text-xs text-slate-400 font-semibold">/pages/</span>
                                <input type="text" name="slug" value="home" class="flex-1 px-4 py-3 border border-slate-200 rounded-r-xl text-xs text-slate-700 font-semibold focus:border-[#0369a1] focus:ring-2 focus:ring-sky-50 outline-none transition">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 mb-2">Meta Title</label>
                            <input type="text" name="meta_title" x-model="formData.business_name" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-700 outline-none focus:border-[#0369a1] focus:ring-2 focus:ring-sky-50 transition shadow-sm">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 mb-2">Meta Description</label>
                            <textarea name="meta_description" x-model="formData.description" rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-xs font-medium text-slate-600 outline-none focus:border-[#0369a1] focus:ring-2 focus:ring-sky-50 transition shadow-sm resize-none"></textarea>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        {{-- RIGHT COLUMN (Live Preview Area) --}}
        <div class="flex-1 bg-[#f1f5f9] flex flex-col items-center justify-center relative overflow-hidden p-8">
            
            {{-- Mockup Browser Wrapper --}}
            <div class="w-full max-w-[800px] bg-white rounded-t-2xl rounded-b-3xl shadow-xl flex flex-col h-full max-h-[820px] border border-slate-200 overflow-hidden transform transition-all duration-300">
                
                {{-- Mockup Header (Browser Bar) --}}
                <div class="h-12 bg-white border-b border-slate-100 flex items-center px-4 gap-4 shrink-0">
                    <div class="flex items-center gap-1.5">
                        <div class="w-3 h-3 rounded-full bg-rose-400"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-300"></div>
                        <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
                    </div>
                    <div class="flex-1 flex justify-center">
                        <div class="px-6 py-1.5 rounded-full bg-slate-50 border border-slate-100 text-[9px] font-bold text-slate-400 tracking-wider">
                            www.bismalabs.atelier.com
                        </div>
                    </div>
                    <div class="w-12"></div>
                </div>

                {{-- LIVE TEMPLATE CONTENT (Reactive to x-model) --}}
                <div class="flex-1 bg-white flex flex-col overflow-y-auto custom-scrollbar relative">
                    
                    {{-- Nav --}}
                    <div class="flex items-center justify-between px-10 py-10 shrink-0">
                        {{-- Data Binding: Business Name --}}
                        <div x-text="formData.business_name" class="text-sm font-black text-slate-900 tracking-tight uppercase"></div>
                        
                        <div class="flex gap-6 text-[9px] font-bold text-slate-500 uppercase tracking-widest">
                            <span class="text-[#0369a1] border-b-2 border-[#0369a1] pb-1.5">Home</span>
                            <span class="hover:text-slate-800 cursor-pointer pb-1.5 transition">Portfolio</span>
                            <span class="hover:text-slate-800 cursor-pointer pb-1.5 transition">Contact</span>
                        </div>
                    </div>

                    {{-- Hero Section --}}
                    <div class="flex-1 flex items-center px-10 pb-10 gap-8">
                        <div class="flex-1 pr-2 relative z-10">
                            {{-- Dekorasi Glow Halus di Teks --}}
                            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-48 h-48 bg-emerald-50 rounded-full blur-3xl opacity-60 -z-10"></div>
                            
                            <h1 class="text-5xl font-black text-slate-900 leading-[1.1] tracking-tight mb-6">
                                Crafting<br>Digital<br><span class="text-[#0369a1]">Elegance</span><br>for Your<br>Brand.
                            </h1>
                            
                            {{-- Data Binding: Description --}}
                            <p x-text="formData.description" class="text-xs text-slate-500 leading-relaxed max-w-sm mb-8 font-medium"></p>
                            
                            <div class="flex gap-3">
                                <button class="px-6 py-3 rounded-xl bg-[#0369a1] text-white text-[10px] font-bold shadow-md hover:bg-[#075985] transition">Get Started</button>
                                <button class="px-6 py-3 rounded-xl bg-slate-100 text-slate-600 text-[10px] font-bold hover:bg-slate-200 transition">Our Work</button>
                            </div>
                        </div>
                        
                        {{-- Image Mockup Area --}}
                        <div class="w-[280px] h-full max-h-[520px] rounded-[32px] relative overflow-hidden shadow-inner shrink-0 bg-[#83a4a7]">
                             {{-- Menggunakan Unsplash Image sebagai placeholder Vas Estetik yang mirip dengan desain asli --}}
                             <img src="https://images.unsplash.com/photo-1612196808214-b8e1d6145a8c?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover mix-blend-multiply opacity-90" alt="Vase Mockup">
                        </div>
                    </div>
                </div>
            </div>

            {{-- View Toggles (Mockup Controls) --}}
            <div class="absolute bottom-5 flex items-center gap-6 text-[10px] font-bold text-slate-500">
                <button class="flex items-center gap-1.5 hover:text-slate-800 transition">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><path stroke-linecap="round" d="M12 18h.01"/></svg>
                    Mobile View
                </button>
                <button class="flex items-center gap-1.5 text-[#0369a1] transition">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="14" rx="2"/><path stroke-linecap="round" d="M8 22h8m-4-4v4"/></svg>
                    Desktop View
                </button>
            </div>
            
        </div>
    </main>

    {{-- ALPINE.JS SCRIPT UNTUK DATA BINDING --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('atelierEditor', () => ({
                activeTab: 'editor',
                activeMenu: 'header',
                // Data awal diambil dari Controller ($websiteData)
                formData: {
                    business_name: '{!! addslashes($websiteData["business_name"] ?? "Bisma Labs") !!}',
                    description: '{!! addslashes($websiteData["description"] ?? "We build premium digital experiences for local artisans and craftsmens. Our atelier approach ensures every pixel is intentional.") !!}',
                    phone: '{!! addslashes($websiteData["phone"] ?? "") !!}',
                    address: '{!! addslashes($websiteData["address"] ?? "") !!}'
                }
            }))
        })
    </script>
</body>
</html>