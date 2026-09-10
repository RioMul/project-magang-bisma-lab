@extends('layouts.editor')

@section('title', 'Page Editor | Bisma Labs')

@section('content')
<header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-6 shrink-0">
    <div class="flex items-center gap-4 sm:gap-6 min-w-0">
        <a href="{{ route('client.pages.index') }}" class="hidden sm:flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-slate-900 transition shrink-0">
            <span>&larr;</span> Back to Pages
        </a>
        <a href="{{ route('client.pages.index') }}" class="sm:hidden p-2 text-slate-500 hover:bg-slate-100 rounded-lg">
            <span>&larr;</span>
        </a>
        <div class="hidden sm:block h-6 w-px bg-slate-200"></div>
        <h1 class="text-base sm:text-lg font-black text-slate-900 truncate">{{ $page['name'] }}</h1>
    </div>
    <div class="flex items-center gap-2 sm:gap-4 shrink-0">
        <div class="hidden sm:flex items-center gap-4">
            <button class="text-slate-400 hover:text-slate-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
            <button class="text-slate-400 hover:text-slate-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg></button>
            <div class="h-6 w-px bg-slate-200 mx-2"></div>
            <button class="text-sm font-semibold text-slate-500 hover:text-slate-800">Save Draft</button>
        </div>
        <button class="px-4 sm:px-5 py-2 bg-[#0369a1] hover:bg-[#0284c7] text-white text-xs sm:text-sm font-bold rounded-lg shadow-sm transition">Publish</button>
    </div>
</header>

<div class="flex flex-col lg:flex-row flex-1 overflow-hidden" x-data="{ activeTab: 'content' }">
    
    {{-- MENU EDITOR MOBILE ONLY --}}
    <div class="lg:hidden flex bg-white border-b border-slate-200 px-2 shrink-0 overflow-x-auto">
        <button @click="activeTab = 'content'" :class="activeTab === 'content' ? 'border-[#0369a1] text-[#0369a1]' : 'border-transparent text-slate-500'" class="px-4 py-3 text-sm font-bold border-b-2 whitespace-nowrap">Content</button>
        <button @click="activeTab = 'settings'" :class="activeTab === 'settings' ? 'border-[#0369a1] text-[#0369a1]' : 'border-transparent text-slate-500'" class="px-4 py-3 text-sm font-bold border-b-2 whitespace-nowrap">Settings & SEO</button>
    </div>

    {{-- LEFT SIDEBAR (Desktop Only) --}}
    <aside class="hidden lg:flex w-64 bg-white border-r border-slate-200 flex-col justify-between shrink-0">
        <div class="p-6">
            <h2 class="font-black text-slate-900">Page Editor</h2>
            <p class="text-xs text-slate-400 mt-1">Editing: {{ $page['name'] }}</p>
            <nav class="mt-8 space-y-2">
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 bg-sky-50 text-[#0369a1] rounded-xl font-bold text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    General
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:bg-slate-50 rounded-xl font-medium text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    SEO
                </a>
            </nav>
        </div>
        <div class="p-6">
            <a href="#" class="flex items-center justify-center gap-2 w-full py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm rounded-xl transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                View Live Site
            </a>
        </div>
    </aside>

    {{-- MIDDLE EDITOR --}}
    <main class="flex-1 overflow-y-auto p-4 sm:p-8 flex flex-col items-center" x-show="activeTab === 'content'">
        <div class="w-full max-w-2xl space-y-6">
            <div class="w-full h-48 sm:h-64 bg-slate-200 rounded-2xl border-2 border-dashed border-slate-300 flex flex-col items-center justify-center text-slate-400 cursor-pointer hover:bg-slate-300/50 transition">
                <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span class="font-bold text-slate-600">Add Featured Image</span>
                <span class="text-xs mt-1">1000 x 630px recommended</span>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="border-b border-slate-100 p-2 flex items-center justify-between bg-slate-50 overflow-x-auto">
                    <div class="flex items-center gap-1 text-slate-600 min-w-max">
                        <button class="p-2 hover:bg-slate-200 rounded font-bold text-sm">B</button>
                        <button class="p-2 hover:bg-slate-200 rounded italic text-sm">I</button>
                        <div class="w-px h-4 bg-slate-300 mx-1"></div>
                        <button class="p-2 hover:bg-slate-200 rounded font-bold text-sm">H1</button>
                        <button class="p-2 hover:bg-slate-200 rounded font-bold text-sm">H2</button>
                        <div class="w-px h-4 bg-slate-300 mx-1"></div>
                        <button class="p-2 hover:bg-slate-200 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg></button>
                        <button class="p-2 hover:bg-slate-200 rounded"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg></button>
                    </div>
                </div>
                <div class="p-6 sm:p-8 prose prose-slate max-w-none">
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 mb-6">Mastering the Digital Atelier</h1>
                    <p class="text-slate-600 mb-4">The secret to a successful online presence isn't just about functionality; it's about the <span class="font-bold text-[#0369a1]">experience</span>. Small business owners are no longer just service providers—they are digital curators.</p>
                    <p class="text-slate-600 mb-6">Start your journey by defining the tone of your space. Is it a bustling marketplace or a quiet, high-end gallery? This decision will dictate every pixel that follows...</p>
                    <blockquote class="border-l-4 border-[#0369a1] bg-sky-50 p-4 rounded-r-lg text-slate-700 italic mb-6 text-sm sm:text-base">
                        "Design is not just what it looks like and feels like. Design is how it works." — Steve Jobs
                    </blockquote>
                    <p class="text-slate-500 text-sm">Enter your text here. Use the toolbar above to style your content.</p>
                </div>
            </div>
        </div>
    </main>

    {{-- RIGHT SIDEBAR (Settings) --}}
    <aside class="w-full lg:w-80 bg-white border-l border-slate-200 overflow-y-auto shrink-0" :class="activeTab === 'settings' ? 'block' : 'hidden lg:block'">
        <div class="p-6 space-y-8">
            <div>
                <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-4">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> STATUS & VISIBILITY
                </h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                        <span class="text-slate-600">Status</span>
                        <span class="px-2 py-0.5 bg-emerald-50 text-emerald-600 font-bold text-[10px] rounded uppercase">DRAFT</span>
                    </div>
                </div>
            </div>
            <div>
                <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">URL Slug</h3>
                <div class="flex bg-slate-50 rounded-lg border border-slate-200 overflow-hidden text-sm">
                    <span class="px-3 py-2 text-slate-400 bg-slate-100 border-r border-slate-200">/pages/</span>
                    <input type="text" value="{{ $page['slug'] }}" class="w-full bg-transparent px-3 py-2 border-0 focus:ring-0 text-slate-700 font-medium">
                </div>
            </div>
            <div>
                <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-4">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg> SEO OPTIMIZATION
                </h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-[10px] font-bold mb-1">
                            <span class="text-slate-600 uppercase">Meta Title</span>
                        </div>
                        <textarea rows="2" class="w-full rounded-lg border-slate-200 text-sm text-slate-700">{{ $page['meta_title'] }}</textarea>
                    </div>
                    <div>
                        <div class="flex justify-between text-[10px] font-bold mb-1">
                            <span class="text-slate-600 uppercase">Meta Description</span>
                        </div>
                        <textarea rows="4" class="w-full rounded-lg border-red-200 text-sm text-slate-700">{{ $page['meta_description'] }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</div>
@endsection