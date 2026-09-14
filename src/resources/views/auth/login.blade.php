<x-guest-layout>

<div class="min-h-screen bg-white lg:grid lg:grid-cols-2">

    <div class="flex flex-col justify-center px-6 py-10 sm:px-10 lg:px-16 xl:px-24">

        <div class="w-full max-w-md mx-auto">

            <a href="{{ route('home') }}" class="inline-flex items-center mb-10">
                <img
                    src="{{ asset('logo.png') }}"
                    alt="Bisma Labs"
                    class="h-10 w-auto"
                    onerror="this.onerror=null;this.style.display='none';">
            </a>

            <div class="mb-8">
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-900">
                    Selamat Datang Kembali
                </h1>

                <p class="text-sm text-slate-500 mt-2">
                    Masuk untuk mengelola website Anda.
                </p>
            </div>

            <x-auth-session-status
                class="mb-5 text-sm font-medium text-emerald-700 bg-emerald-50 border border-emerald-100 rounded-xl px-4 py-3"
                :status="session('status')"
            />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label
                        for="email"
                        class="block text-sm font-semibold text-slate-700 mb-2">
                        Email
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="nama@email.com"
                        class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-white text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-100 focus:border-[#0396c7] transition">

                    <x-input-error
                        :messages="$errors->get('email')"
                        class="mt-2 text-xs text-red-500"
                    />
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">

                        <label
                            for="password"
                            class="block text-sm font-semibold text-slate-700">
                            Password
                        </label>

                        @if(Route::has('password.request'))
                            <a
                                href="{{ route('password.request') }}"
                                class="text-xs font-semibold text-[#0396c7] hover:underline">
                                Lupa Password?
                            </a>
                        @endif

                    </div>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Masukkan password"
                        class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-white text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-100 focus:border-[#0396c7] transition">

                    <x-input-error
                        :messages="$errors->get('password')"
                        class="mt-2 text-xs text-red-500"
                    />
                </div>

                <div class="flex items-center">
                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                        class="w-4 h-4 rounded border-slate-300 text-[#0396c7] focus:ring-[#0396c7]">

                    <label
                        for="remember_me"
                        class="ml-2 text-sm text-slate-500">
                        Ingat saya
                    </label>
                </div>

                <button
                    type="submit"
                    class="w-full py-3.5 rounded-xl bg-[#0396c7] hover:bg-[#027ea7] text-white text-sm font-bold transition shadow-sm">
                    Masuk ke Dashboard
                </button>

            </form>

            <div class="flex items-center gap-4 my-7">
                <div class="h-px flex-1 bg-slate-200"></div>
                <span class="text-xs text-slate-400">atau</span>
                <div class="h-px flex-1 bg-slate-200"></div>
            </div>

            <button
                type="button"
                class="w-full py-3.5 rounded-xl border border-slate-200 bg-white text-sm font-semibold text-slate-700 hover:bg-slate-50 transition flex items-center justify-center gap-3">

                <span class="w-5 h-5 rounded-full bg-slate-100 flex items-center justify-center text-xs font-bold">
                    G
                </span>

                Masuk dengan Google
            </button>

            <p class="text-center text-sm text-slate-500 mt-8">
                Belum punya akun?
                <a
                    href="{{ route('register') }}"
                    class="font-bold text-[#0396c7] hover:underline">
                    Buat Website Sekarang
                </a>
            </p>

        </div>

    </div>

    <div class="hidden lg:flex relative min-h-screen bg-slate-900 overflow-hidden items-center justify-center">

        <img
            src="{{ asset('tech1.png') }}"
            alt=""
            class="absolute inset-0 w-full h-full object-cover opacity-30"
            onerror="this.style.display='none';">

        <div class="absolute inset-0 bg-gradient-to-br from-[#0396c7] via-slate-900 to-slate-950 opacity-80"></div>

        <div class="relative z-10 max-w-lg px-10 text-center">

            <div class="inline-flex items-center px-3 py-1.5 rounded-full bg-white/10 border border-white/10 text-cyan-100 text-xs font-semibold mb-6">
                Bisma Labs Client Area
            </div>

            <h2 class="text-4xl xl:text-5xl font-bold text-white leading-tight">
                Kelola Website Anda dengan Lebih Mudah.
            </h2>

            <p class="text-base xl:text-lg text-slate-200 mt-5 leading-relaxed">
                Edit website, kelola halaman, pantau pengunjung, dan lihat informasi pembayaran dalam satu dashboard.
            </p>

        </div>

    </div>

</div>

</x-guest-layout>