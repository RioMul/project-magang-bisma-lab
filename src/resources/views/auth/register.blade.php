<x-guest-layout>
    <div class="min-h-[calc(100vh-136px)] flex items-center justify-center px-5 py-8 sm:px-8 sm:py-12">

        <div class="w-full max-w-[430px]">

            <div class="bg-white border border-slate-100 rounded-xl sm:rounded-2xl shadow-sm px-6 py-7 sm:px-8 sm:py-8">

                <div class="text-center mb-6">

                    <div class="mx-auto mb-4 w-11 h-11 rounded-xl bg-[#eaf7fc] flex items-center justify-center">
                        <svg
                            class="w-5 h-5 text-[#0396c7]"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/>

                            <circle
                                cx="9"
                                cy="7"
                                r="4"/>

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 8v6M22 11h-6"/>
                        </svg>
                    </div>

                    <h1 class="text-2xl sm:text-[26px] font-bold tracking-tight text-slate-800">
                        Buat Akun Baru
                    </h1>

                    <p class="text-xs sm:text-sm text-slate-500 mt-1.5">
                        Daftarkan akun untuk mulai mengelola website Anda
                    </p>

                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label
                            for="name"
                            class="block text-xs font-medium text-slate-600 mb-1.5">
                            Nama Lengkap
                        </label>

                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Nama lengkap Anda"
                            class="w-full px-4 py-3 rounded-lg border border-slate-200 bg-[#f8fafc] text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-cyan-100 focus:border-[#0396c7] transition"
                        >

                        <x-input-error
                            :messages="$errors->get('name')"
                            class="mt-1.5 text-xs text-red-500"
                        />
                    </div>

                    <div>
                        <label
                            for="email"
                            class="block text-xs font-medium text-slate-600 mb-1.5">
                            Email
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="username"
                            placeholder="nama@perusahaan.com"
                            class="w-full px-4 py-3 rounded-lg border border-slate-200 bg-[#f8fafc] text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-cyan-100 focus:border-[#0396c7] transition"
                        >

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-1.5 text-xs text-red-500"
                        />
                    </div>

                    <div>
                        <label
                            for="password"
                            class="block text-xs font-medium text-slate-600 mb-1.5">
                            Password
                        </label>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Minimal 8 karakter"
                            class="w-full px-4 py-3 rounded-lg border border-slate-200 bg-[#f8fafc] text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-cyan-100 focus:border-[#0396c7] transition"
                        >

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-1.5 text-xs text-red-500"
                        />
                    </div>

                    <div>
                        <label
                            for="password_confirmation"
                            class="block text-xs font-medium text-slate-600 mb-1.5">
                            Konfirmasi Password
                        </label>

                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Ulangi password"
                            class="w-full px-4 py-3 rounded-lg border border-slate-200 bg-[#f8fafc] text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-cyan-100 focus:border-[#0396c7] transition"
                        >

                        <x-input-error
                            :messages="$errors->get('password_confirmation')"
                            class="mt-1.5 text-xs text-red-500"
                        />
                    </div>

                    <button
                        type="submit"
                        class="w-full py-3 rounded-lg bg-[#0396c7] hover:bg-[#027ea7] text-white text-xs sm:text-sm font-bold transition shadow-sm">
                        Daftar Sekarang
                    </button>

                </form>

                <p class="text-center text-xs sm:text-sm text-slate-500 mt-7">

                    Sudah punya akun?

                    <a
                        href="{{ route('login') }}"
                        class="font-bold text-[#0396c7] hover:underline">
                        Masuk Sekarang
                    </a>

                </p>

            </div>

            <p class="text-center text-[9px] uppercase tracking-[0.18em] text-slate-300 mt-5">
                Secure Access by Bisma Labs
            </p>

        </div>

    </div>
</x-guest-layout>