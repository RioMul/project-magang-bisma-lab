<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BismaLabs') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900">
        <div class="min-h-screen flex flex-col justify-between">
            
            <!-- Navbar Custom BismaLabs -->
            @include('partials.navbar')

            <!-- Page Content -->
            <main class="flex-grow pt-20 sm:pt-24">
                @yield('content')
                {{ $slot ?? '' }}
            </main>

            <!-- Footer -->
            @include('partials.footer')
        </div>
    </body>
</html>