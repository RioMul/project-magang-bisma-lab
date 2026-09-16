<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin Panel') | Bisma Labs
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @stack('styles')
</head>

<body class="bg-[#f7f9fc] text-slate-800 antialiased">

<div class="min-h-screen flex">

    @include('admin.layouts.sidebar')

    <div class="flex-1 min-w-0 lg:ml-64">

        @include('admin.layouts.topbar')

        <main class="p-5 sm:p-7 lg:p-8">

            @if(session('success'))
                <div class="mb-5 rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 rounded-xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')

        </main>

    </div>

</div>

@stack('scripts')

</body>
</html>