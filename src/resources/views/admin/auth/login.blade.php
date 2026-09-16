<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login | Bisma Labs</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="min-h-screen bg-[#f4f7fb] flex items-center justify-center p-5">

<div class="w-full max-w-[420px]">

    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-7 sm:p-9">

        <div class="text-center mb-8">

            <div class="mx-auto w-12 h-12 rounded-xl bg-[#0879b9] flex items-center justify-center text-white text-xl font-bold">
                B
            </div>

            <h1 class="mt-4 text-xl font-bold text-slate-800">
                Bisma Labs
            </h1>

            <p class="mt-1 text-xs text-slate-400 uppercase tracking-[0.15em]">
                Superadmin Panel
            </p>

        </div>

        @if($errors->any())
            <div class="mb-5 rounded-lg bg-red-50 border border-red-100 px-4 py-3 text-xs text-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('admin.login.store') }}"
            class="space-y-5">

            @csrf

            <div>

                <label
                    for="email"
                    class="block mb-1.5 text-xs font-medium text-slate-600">
                    Email Administrator
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    placeholder="admin@gmail.com"
                    class="w-full px-4 py-3 rounded-lg border border-slate-200 bg-slate-50 text-sm focus:bg-white focus:border-[#0879b9] focus:ring-2 focus:ring-cyan-100 outline-none">

            </div>

            <div>

                <label
                    for="password"
                    class="block mb-1.5 text-xs font-medium text-slate-600">
                    Password
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    placeholder="Masukkan password"
                    class="w-full px-4 py-3 rounded-lg border border-slate-200 bg-slate-50 text-sm focus:bg-white focus:border-[#0879b9] focus:ring-2 focus:ring-cyan-100 outline-none">

            </div>

            <label class="flex items-center gap-2 text-xs text-slate-500">

                <input
                    type="checkbox"
                    name="remember"
                    class="rounded border-slate-300 text-[#0879b9] focus:ring-[#0879b9]">

                Ingat saya

            </label>

            <button
                type="submit"
                class="w-full py-3 rounded-lg bg-[#0879b9] hover:bg-[#06679c] text-white text-sm font-semibold transition">

                Masuk ke Admin Panel

            </button>

        </form>

    </div>

    <p class="text-center mt-5 text-[10px] uppercase tracking-[0.15em] text-slate-400">
        Secure Admin Access · Bisma Labs
    </p>

</div>

</body>
</html>