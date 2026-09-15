<x-guest-layout>
    <div class="min-h-[calc(100vh-136px)] flex items-center justify-center px-5 py-10 sm:px-8 sm:py-14">

        <div class="w-full max-w-[430px]">

            <div class="bg-white border border-slate-100 rounded-xl sm:rounded-2xl shadow-sm px-6 py-8 sm:px-8 sm:py-9">

                <div class="text-center mb-7">

                    <div class="mx-auto mb-4 w-11 h-11 rounded-xl bg-[#eaf7fc] flex items-center justify-center">
                        <svg
                            class="w-5 h-5 text-[#0396c7]"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <rect
                                x="4"
                                y="4"
                                width="16"
                                height="16"
                                rx="2"/>

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 8h3v3H8zM13 8h3v3h-3zM8 13h3v3H8zM13 13h3v3h-3z"/>
                        </svg>
                    </div>

                    <h1 class="text-2xl sm:text-[26px] font-bold tracking-tight text-slate-800">
                        Selamat Datang Kembali
                    </h1>

                    <p class="text-xs sm:text-sm text-slate-500 mt-1.5">
                        Masuk untuk mengelola website Anda
                    </p>

                </div>

                <x-auth-session-status
                    class="mb-5 text-xs font-medium text-emerald-700 bg-emerald-50 border border-emerald-100 rounded-lg px-3.5 py-2.5"
                    :status="session('status')"
                />

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label
                            for="email"
                            class="block text-xs font-medium text-slate-600 mb-1.5">
                            Email
                        </label>

                        <div class="relative">
                            <svg
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8">

                                <rect
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="14"
                                    rx="2"/>

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 7l9 6 9-6"/>
                            </svg>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="nama@perusahaan.com"
                                class="w-full pl-10 pr-4 py-3 rounded-lg border border-slate-200 bg-[#f8fafc] text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-cyan-100 focus:border-[#0396c7] transition"
                            >
                        </div>

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-1.5 text-xs text-red-500"
                        />
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">

                            <label
                                for="password"
                                class="block text-xs font-medium text-slate-600">
                                Password
                            </label>

                            @if(Route::has('password.request'))
                                <a
                                    href="{{ route('password.request') }}"
                                    class="text-[11px] font-medium text-[#0396c7] hover:underline">
                                    Lupa Password?
                                </a>
                            @endif

                        </div>

                        <div class="relative">
                            <svg
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8">

                                <rect
                                    x="5"
                                    y="10"
                                    width="14"
                                    height="10"
                                    rx="2"/>

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 10V7a4 4 0 018 0v3"/>
                            </svg>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Masukkan password"
                                class="w-full pl-10 pr-4 py-3 rounded-lg border border-slate-200 bg-[#f8fafc] text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-cyan-100 focus:border-[#0396c7] transition"
                            >
                        </div>

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-1.5 text-xs text-red-500"
                        />
                    </div>

                    <div class="flex items-center">

                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4 rounded border-slate-300 text-[#0396c7] focus:ring-[#0396c7]"
                        >

                        <label
                            for="remember_me"
                            class="ml-2 text-xs text-slate-500">
                            Ingat saya
                        </label>

                    </div>

                    <button
                        type="submit"
                        class="w-full py-3 rounded-lg bg-[#0396c7] hover:bg-[#027ea7] text-white text-xs sm:text-sm font-bold transition shadow-sm">
                        Masuk ke Dashboard
                    </button>

                </form>

                <div class="flex items-center gap-3 my-6">

                    <div class="h-px flex-1 bg-slate-200"></div>

                    <span class="text-[10px] text-slate-400 uppercase tracking-wider">
                        atau
                    </span>

                    <div class="h-px flex-1 bg-slate-200"></div>

                </div>

                <button
                    type="button"
                    class="w-full py-3 rounded-lg border border-slate-200 bg-white text-xs sm:text-sm font-medium text-slate-600 hover:bg-slate-50 transition flex items-center justify-center gap-2.5">

                    <span class="w-5 h-5 rounded-full border border-slate-200 flex items-center justify-center text-[10px] font-bold text-slate-700">
                        G
                    </span>

                    Masuk dengan Google
                </button>

                <p class="text-center text-xs sm:text-sm text-slate-500 mt-7">

                    Belum punya akun?

                    <a
                        href="{{ route('register') }}"
                        class="font-bold text-[#0396c7] hover:underline">
                        Daftar Sekarang
                    </a>

                </p>

            </div>

            <p class="text-center text-[9px] uppercase tracking-[0.18em] text-slate-300 mt-5">
                Secure Access by Bisma Labs
            </p>

        </div>

    </div>
</x-guest-layout>