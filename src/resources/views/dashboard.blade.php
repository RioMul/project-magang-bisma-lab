<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Layanan & Cloud Server | BismaLabs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col justify-between selection:bg-[#0396c7] selection:text-white">

    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- MAIN CONTAINER --}}
    <main class="max-w-6xl mx-auto px-6 pt-28 pb-16 w-full flex-1">
        
        {{-- HERO CLIENT HEADER DENGAN ASSET TECH1 --}}
        <div class="bg-gradient-to-r from-slate-950 via-slate-900 to-[#02698c] rounded-3xl p-8 sm:p-10 text-white shadow-xl mb-10 relative overflow-hidden border border-slate-800">
            {{-- Radial & Grid Background --}}
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-cyan-500/20 via-transparent to-transparent pointer-events-none"></div>
            
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8 relative z-10">
                <div class="max-w-xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/20 border border-cyan-400/30 text-cyan-300 text-[11px] font-bold uppercase tracking-wider mb-4 backdrop-blur-md">
                        <span class="w-2 h-2 rounded-full bg-[#0396c7] animate-pulse"></span>
                        BismaLabs Cloud Workspace
                    </div>
                    <h1 class="text-2xl sm:text-4xl font-black tracking-tight leading-tight">
                        Halo, {{ Auth::user()->name }} 👋
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-300 mt-2 leading-relaxed">
                        Kelola repositori website, alokasi infrastruktur server cloud, dan konfigurasi domain bisnis Anda dalam satu portal terpadu.
                    </p>
                    
                    <div class="mt-6 flex flex-wrap items-center gap-3">
                        <a href="{{ route('order.template') }}" class="px-5 py-2.5 bg-[#0396c7] hover:bg-[#027ea7] text-white font-extrabold text-xs rounded-xl shadow-lg shadow-cyan-950/40 transition transform hover:-translate-y-0.5 inline-flex items-center gap-2">
                            <span>+</span> Pesan Website Baru
                        </a>
                        <a href="#server-insights" class="px-4 py-2.5 bg-slate-800/80 hover:bg-slate-800 border border-slate-700 text-slate-300 font-bold text-xs rounded-xl transition">
                            Status Infrastruktur
                        </a>
                    </div>
                </div>

                {{-- Asset Tech1 Highlight --}}
                <div class="hidden lg:flex items-center justify-center relative">
                    <div class="w-48 h-48 rounded-2xl bg-gradient-to-br from-cyan-500/10 to-transparent p-2 border border-cyan-400/20 backdrop-blur-sm shadow-2xl">
                        <img src="{{ asset('tech1.png') }}" 
                             alt="Server Cloud Architecture" 
                             class="w-full h-full object-contain drop-shadow-lg"
                             onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=400&auto=format&fit=crop&q=80';">
                    </div>
                </div>
            </div>
        </div>

        {{-- FLASH MESSAGE --}}
        @if (session('success'))
            <div class="mb-8 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-2">
                    <span class="text-lg">🎉</span>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        {{-- METRICS SUMMARY --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl border border-slate-200/90 shadow-sm flex items-center justify-between hover:shadow-md transition">
                <div>
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Website</span>
                    <div class="text-3xl font-black text-slate-900 font-mono mt-1">{{ $orders->count() }}</div>
                    <div class="text-[11px] text-slate-500 mt-1">Layanan terdaftar</div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-cyan-50 text-[#0396c7] flex items-center justify-center font-black text-xl border border-cyan-100">
                    🌐
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200/90 shadow-sm flex items-center justify-between hover:shadow-md transition">
                <div>
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Website Live</span>
                    <div class="text-3xl font-black text-emerald-600 font-mono mt-1">
                        {{ $orders->where('status', 'active')->count() }}
                    </div>
                    <div class="text-[11px] text-slate-500 mt-1">Terkoneksi publik</div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-xl border border-emerald-100">
                    ⚡
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200/90 shadow-sm flex items-center justify-between hover:shadow-md transition">
                <div>
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Dalam Antrian</span>
                    <div class="text-3xl font-black text-amber-600 font-mono mt-1">
                        {{ $orders->where('status', 'pending')->count() }}
                    </div>
                    <div class="text-[11px] text-slate-500 mt-1">Proses konfigurasi</div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center font-black text-xl border border-amber-100">
                    ⏳
                </div>
            </div>
        </div>

        {{-- DAFTAR PESANAN & WEBSITE ACTIVE --}}
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden mb-12">
            <div class="p-6 sm:p-7 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-lg font-black text-slate-900">Repositori Layanan & Website Anda</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Pantau progres deployment, konfigurasi DNS, dan masa aktif cloud server.</p>
                </div>
                <a href="{{ route('order.template') }}" class="px-4 py-2 bg-cyan-50 hover:bg-cyan-100 text-[#0396c7] font-bold text-xs rounded-xl transition inline-flex items-center gap-1.5 self-start sm:self-auto">
                    <span>+</span> Tambah Layanan
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 text-[11px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100">
                            <th class="py-4 px-6">ID Pesanan</th>
                            <th class="py-4 px-6">Alamat Domain</th>
                            <th class="py-4 px-6">Desain &amp; Server</th>
                            <th class="py-4 px-6">Total Biaya</th>
                            <th class="py-4 px-6">Status Server</th>
                            <th class="py-4 px-6 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs">
                        @forelse ($orders as $order)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="py-4 px-6 font-mono font-bold text-slate-900">
                                    #{{ $order->order_number }}
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-black text-[#0396c7] text-sm">{{ $order->desired_domain }}</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">Dipesan: {{ $order->created_at->format('d M Y') }}</div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-bold text-slate-800">{{ $order->template->name ?? 'Custom Theme' }}</div>
                                    <div class="text-[11px] text-slate-500 font-medium">{{ $order->serverPackage->name ?? 'Server Package' }}</div>
                                </td>
                                <td class="py-4 px-6 font-mono font-black text-slate-900">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-6">
                                    @if ($order->status === 'active')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Live Online
                                        </span>
                                    @elseif ($order->status === 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-extrabold bg-amber-50 text-amber-700 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-ping"></span> Menunggu Setup
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-extrabold bg-slate-100 text-slate-700 border border-slate-200">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20BismaLabs,%20saya%20ingin%20konsultasi%20layanan%20untuk%20Order%20%23{{ $order->order_number }}" target="_blank" class="px-3.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition inline-block">
                                        Bantuan Admin
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-14 text-center text-slate-400">
                                    <div class="w-14 h-14 rounded-full bg-cyan-50 text-[#0396c7] flex items-center justify-center mx-auto text-2xl mb-3">
                                        📦
                                    </div>
                                    <p class="font-bold text-sm text-slate-700">Belum Ada Pesanan Website</p>
                                    <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">Pilih template bisnis dan luncurkan website Anda hari ini.</p>
                                    <a href="{{ route('order.template') }}" class="inline-block mt-4 px-5 py-2.5 bg-[#0396c7] hover:bg-[#027ea7] text-white font-black text-xs rounded-xl shadow-md transition">
                                        Mulai Setup Website Sekarang
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- DUA KARTU FEATURE / SERVER INSIGHTS DENGAN ASSET TECH2 & TECH3 --}}
        <div id="server-insights" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Feature Card 1: Tech2 --}}
            <div class="bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm flex flex-col justify-between group hover:border-cyan-400/50 transition">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-14 h-14 rounded-2xl bg-cyan-50 p-2 border border-cyan-100 flex items-center justify-center shrink-0">
                        <img src="{{ asset('tech2.png') }}" 
                             alt="Server Cloud Engine" 
                             class="w-full h-full object-contain"
                             onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=300&auto=format&fit=crop&q=80';">
                    </div>
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-wider text-[#0396c7]">Dedicated Hosting</span>
                        <h3 class="text-base font-black text-slate-900">Performa NVMe Cloud Cepat</h3>
                    </div>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Setiap website yang di-deploy terisolasi di container independen dengan proteksi anti-DDoS dan SSL otomatis 256-bit.
                </p>
                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-slate-600">
                    <span>Uptime SLA: <strong class="text-emerald-600">99.9%</strong></span>
                    <span class="text-[#0396c7]">Auto Scalable &rarr;</span>
                </div>
            </div>

            {{-- Feature Card 2: Tech3 --}}
            <div class="bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm flex flex-col justify-between group hover:border-cyan-400/50 transition">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-14 h-14 rounded-2xl bg-cyan-50 p-2 border border-cyan-100 flex items-center justify-center shrink-0">
                        <img src="{{ asset('tech3.png') }}" 
                             alt="Global CDN & DNS" 
                             class="w-full h-full object-contain"
                             onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1518770660439-4636190af475?w=300&auto=format&fit=crop&q=80';">
                    </div>
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-wider text-[#0396c7]">Global Edge</span>
                        <h3 class="text-base font-black text-slate-900">Routing Domain &amp; Fast DNS</h3>
                    </div>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Penyebaran DNS kilat dengan Anycast routing memastikan pengunjung dari wilayah mana saja dapat mengakses halaman Anda tanpa lag.
                </p>
                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-slate-600">
                    <span>Latency Rata-rata: <strong class="text-cyan-700">&lt; 25ms</strong></span>
                    <a href="{{ route('order.domain') }}" class="text-[#0396c7] hover:underline">Kelola Domain &rarr;</a>
                </div>
            </div>
        </div>

    </main>

    {{-- FOOTER --}}
    @include('partials.footer')

</body>
</html>