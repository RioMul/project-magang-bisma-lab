<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Area | BismaLabs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f8fafc] text-slate-800 font-sans antialiased flex h-screen overflow-hidden">

    @php
        $latestOrder = $orders->first();
    @endphp

    {{-- SIDEBAR KIRI --}}
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col justify-between flex-shrink-0 z-20">
        <div>
            {{-- Logo --}}
            <div class="h-20 flex flex-col justify-center px-8 border-b border-slate-100">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 w-auto" onerror="this.onerror=null;this.src='https://placehold.co/120x30/0396c7/ffffff?text=BismaLabs';">
                </a>
                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-2">Client Area</span>
            </div>

            {{-- Navigasi Sidebar --}}
            <nav class="p-4 space-y-1.5 mt-2">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 bg-sky-50 text-sky-900 rounded-xl font-bold text-sm transition">
                    <svg class="w-4 h-4 text-[#0369a1]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:bg-slate-50 hover:text-slate-900 rounded-xl font-semibold text-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit Website
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:bg-slate-50 hover:text-slate-900 rounded-xl font-semibold text-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                    Halaman
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:bg-slate-50 hover:text-slate-900 rounded-xl font-semibold text-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Statistik
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:bg-slate-50 hover:text-slate-900 rounded-xl font-semibold text-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    Billing
                </a>
            </nav>
        </div>

        {{-- Footer Sidebar --}}
        <div class="p-4 space-y-1 mb-4 border-t border-slate-100 pt-6">
            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:bg-slate-50 hover:text-slate-900 rounded-xl font-semibold text-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Support
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-red-600 hover:bg-red-50 rounded-xl font-bold text-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- KONTEN UTAMA KANAN --}}
    <main class="flex-1 flex flex-col h-screen overflow-y-auto relative">
        
        {{-- Topbar --}}
        <header class="h-20 bg-white sm:bg-transparent border-b sm:border-none border-slate-200 flex items-center justify-between px-6 sm:px-10 flex-shrink-0 w-full sticky top-0 z-10">
            <div class="relative w-full max-w-sm hidden sm:block">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" placeholder="Search your atelier..." class="w-full pl-11 pr-4 py-2.5 bg-white border border-slate-200 rounded-full text-sm focus:outline-none focus:border-sky-900 shadow-sm">
            </div>

            <div class="flex items-center gap-4 ml-auto">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-900">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] text-slate-500 font-medium">{{ $latestOrder->package->name ?? 'No Plan' }}</p>
                </div>
                <a href="{{ route('profile.edit') }}" class="w-10 h-10 rounded-full bg-slate-200 overflow-hidden border border-slate-200 hover:ring-2 hover:ring-sky-100 transition">
                    @if(Auth::user()->avatar ?? false)
                        <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="w-full h-full object-cover">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff" alt="Avatar" class="w-full h-full object-cover">
                    @endif
                </a>
            </div>
        </header>

        {{-- Konten Dashboard --}}
        <div class="p-6 sm:p-10 pt-4 max-w-6xl w-full">
            
            <div class="mb-8">
                <h1 class="text-3xl font-light text-slate-800 tracking-tight">Welcome back, <span class="font-medium text-slate-900">{{ explode(' ', Auth::user()->name)[0] }}!</span></h1>
                <p class="text-sm text-slate-500 mt-2">Your digital shop is looking great today. You've had <span class="font-bold text-slate-700">240 visitors</span> this week.</p>
            </div>

            @if($latestOrder)
            {{-- Metrics Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                {{-- Card 1: Status --}}
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200 flex flex-col justify-between h-40">
                    <div class="flex justify-between items-start">
                        <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400">System Status</span>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 mb-1 font-medium">Status</p>
                        <div class="flex items-center gap-2">
                            <h3 class="text-2xl font-bold text-slate-900 capitalize">{{ $latestOrder->website->status ?? 'Active' }}</h3>
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Domain --}}
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200 flex flex-col justify-between h-40">
                    <div class="flex justify-between items-start">
                        <div class="w-10 h-10 rounded-full bg-sky-50 text-[#0369a1] flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                        </div>
                        <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400">Live Address</span>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 mb-1 font-medium">Domain</p>
                        <h3 class="text-lg font-bold text-slate-900 truncate">{{ $latestOrder->domain_name }}</h3>
                    </div>
                </div>

                {{-- Card 3: Plan --}}
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200 flex flex-col justify-between h-40">
                    <div class="flex justify-between items-start">
                        <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                        </div>
                        <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400">Billing Cycle</span>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 mb-1 font-medium">Plan</p>
                        <h3 class="text-xl font-bold text-slate-900">{{ $latestOrder->package->name }}</h3>
                        <p class="text-[10px] text-slate-400 mt-1">Renews on {{ \Carbon\Carbon::parse($latestOrder->website->expires_at ?? now()->addYear())->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            {{-- Bottom Layout --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Edit Website Banner --}}
                <div class="lg:col-span-2 bg-gradient-to-br from-slate-50 to-sky-50/40 rounded-3xl p-8 sm:p-10 border border-slate-200 shadow-sm relative overflow-hidden">
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-sky-100 rounded-full blur-3xl opacity-60 pointer-events-none"></div>
                    
                    <div class="relative z-10 max-w-md">
                        <h2 class="text-2xl font-black text-slate-900">Ready to make changes?</h2>
                        <p class="text-sm text-slate-600 mt-3 leading-relaxed">
                            Update your gallery, adjust your pricing, or share your latest news with your customers in just a few clicks.
                        </p>
                        
                        <div class="flex flex-wrap gap-4 mt-8">
                            <a href="#" class="px-6 py-3.5 bg-[#0369a1] hover:bg-[#0284c7] text-white text-sm font-bold rounded-xl shadow-md transition">
                                Edit Website
                            </a>
                            <a href="http://{{ $latestOrder->domain_name }}" target="_blank" class="px-6 py-3.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-sm font-bold rounded-xl transition flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                View Live Site
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Activity & Tips --}}
                <div class="space-y-6">
                    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm">
                        <h3 class="text-sm font-bold text-slate-800 mb-6 flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#0369a1]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Recent Activity
                        </h3>
                        
                        <div class="space-y-0 relative before:absolute before:inset-0 before:ml-2 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-100 before:to-transparent">
                            <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active pb-6">
                                <div class="w-1 h-8 bg-sky-200 rounded-full absolute left-0"></div>
                                <div class="pl-6">
                                    <p class="text-xs font-bold text-slate-800">Price update on "Silk Scarf"</p>
                                    <p class="text-[10px] text-slate-400 mt-1">2 hours ago</p>
                                </div>
                            </div>
                            <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active pb-6">
                                <div class="w-1 h-8 bg-emerald-200 rounded-full absolute left-0"></div>
                                <div class="pl-6">
                                    <p class="text-xs font-bold text-slate-800">New customer message</p>
                                    <p class="text-[10px] text-slate-400 mt-1">5 hours ago</p>
                                </div>
                            </div>
                            <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                                <div class="w-1 h-8 bg-slate-200 rounded-full absolute left-0"></div>
                                <div class="pl-6">
                                    <p class="text-xs font-bold text-slate-800">Published 'Winter Collection'</p>
                                    <p class="text-[10px] text-slate-400 mt-1">Yesterday</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-sky-50 to-blue-50/50 rounded-3xl p-6 border border-sky-100 shadow-sm">
                        <h3 class="text-sm font-bold text-slate-800 mb-2">Pro Tip</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Adding alt-text to your product images can help more customers find you on Google!
                        </p>
                        <a href="#" class="inline-block mt-3 text-[10px] font-black uppercase tracking-wider text-[#0369a1] hover:text-[#0284c7]">
                            Learn How &rarr;
                        </a>
                    </div>
                </div>
            </div>

            @else
            {{-- Jika User Belum Ada Pesanan --}}
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-12 text-center mt-8">
                <div class="w-16 h-16 bg-sky-50 rounded-full flex items-center justify-center mx-auto text-[#0369a1] mb-5">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h2 class="text-xl font-bold text-slate-900">Belum Ada Website Aktif</h2>
                <p class="text-sm text-slate-500 mt-2 max-w-md mx-auto">Anda belum memiliki layanan yang aktif. Silakan pilih template dan berlangganan untuk meluncurkan website Anda.</p>
                <a href="{{ route('order.template') }}" class="inline-block mt-6 px-6 py-3 bg-[#0369a1] hover:bg-[#0284c7] text-white text-sm font-bold rounded-xl shadow-md transition">
                    Buat Website Sekarang
                </a>
            </div>
            @endif

        </div>
    </main>
</body>
</html>