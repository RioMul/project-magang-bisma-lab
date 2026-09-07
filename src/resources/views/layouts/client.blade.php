<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Client Area | Bisma Labs')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-[#f7f8fc] text-slate-800 antialiased overflow-hidden">

<div
    x-data="{ sidebarOpen: false }"
    class="flex h-screen w-full">

    @include('components.client.sidebar')

    <main class="flex-1 min-w-0 flex flex-col h-screen overflow-y-auto">

        @include('components.client.topbar')

        <div class="p-5 sm:p-8 lg:p-10 max-w-[1450px] w-full mx-auto">
            @yield('content')
        </div>

    </main>

</div>

@stack('scripts')

</body>
</html>