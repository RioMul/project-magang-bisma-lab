<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bisma Labs') }} - @yield('title', 'Autentikasi')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-slate-900 antialiased bg-[#f7f9fc]">

    <div class="min-h-screen flex flex-col">

        <header class="h-16 sm:h-[72px] bg-white border-b border-slate-100 shrink-0">
            <div class="max-w-7xl mx-auto h-full px-5 sm:px-8 flex items-center justify-between">

                <a href="{{ route('home') }}" class="flex items-center">
                    <img
                        src="{{ asset('logo.png') }}"
                        alt="Bisma Labs"
                        class="h-8 sm:h-9 w-auto object-contain"
                    >
                </a>

                <div class="flex items-center gap-2 sm:gap-2.5 text-xs sm:text-sm text-slate-500">
                    <svg
                        class="w-4 h-4 sm:w-[18px] sm:h-[18px] text-emerald-600 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z"/>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12l2 2 4-4"/>
                    </svg>

                    <span class="hidden xs:inline sm:inline">
                        Sesi Aman & Terenkripsi
                    </span>

                    <span class="sm:hidden">
                        Aman & Terenkripsi
                    </span>
                </div>

            </div>
        </header>

        <main class="flex-1">
            {{ $slot }}
        </main>

        <footer class="bg-[#f1f5fb] border-t border-slate-100 shrink-0">
            <div class="max-w-7xl mx-auto px-5 sm:px-8 py-7 sm:py-8">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <p class="text-sm font-bold text-slate-700">
                            Bisma Labs
                        </p>

                        <p class="text-[11px] sm:text-xs text-slate-400 mt-1">
                            © {{ date('Y') }} Bisma Labs. Crafted for digital excellence.
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-[11px] sm:text-xs text-slate-500">

                        <a
                            href="#"
                            class="hover:text-[#0396c7] transition">
                            Terms of Service
                        </a>

                        <a
                            href="#"
                            class="hover:text-[#0396c7] transition">
                            Privacy Policy
                        </a>

                        <a
                            href="#"
                            class="hover:text-[#0396c7] transition">
                            Contact Support
                        </a>

                    </div>

                </div>

            </div>
        </footer>

    </div>

</body>
</html>