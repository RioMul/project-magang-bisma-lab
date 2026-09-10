<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">

    <div class="lg:col-span-7">

        <div
            x-data="{ activeTab: 'login' }"
            class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden"
        >

            <div class="p-6 sm:p-8 border-b border-slate-100">

                <div class="flex items-start gap-4">

                    <div class="w-11 h-11 rounded-2xl bg-sky-50 text-[#0369a1] flex items-center justify-center shrink-0">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a4 4 0 10-8 0c0 2.21 4 4 4 4s4-1.79 4-4z" />

                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 21a7 7 0 0114 0" />

                        </svg>

                    </div>

                    <div>

                        <p class="text-[10px] font-black uppercase tracking-[0.18em] text-[#0369a1]">
                            Account
                        </p>

                        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">
                            Masuk atau Daftar
                        </h1>

                        <p class="text-sm text-slate-500 mt-2">
                            Login atau buat akun terlebih dahulu sebelum menyelesaikan pembayaran.
                        </p>

                    </div>

                </div>

            </div>

            <div class="p-6 sm:p-8">

                <div class="grid grid-cols-2 bg-slate-100 rounded-2xl p-1 mb-7">

                    <button
                        type="button"
                        @click="activeTab = 'login'"
                        class="rounded-xl py-3 text-sm font-black transition"
                        :class="activeTab === 'login' ? 'bg-white text-[#0369a1] shadow-sm' : 'text-slate-500'"
                    >
                        Login
                    </button>

                    <button
                        type="button"
                        @click="activeTab = 'register'"
                        class="rounded-xl py-3 text-sm font-black transition"
                        :class="activeTab === 'register' ? 'bg-white text-[#0369a1] shadow-sm' : 'text-slate-500'"
                    >
                        Daftar
                    </button>

                </div>

                <div
                    x-show="activeTab === 'login'"
                    x-transition
                >

                    <form action="{{ route('order.check_login.process') }}" method="POST" class="space-y-5">

                        @csrf

                        <div>

                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3.5 text-sm text-slate-900 outline-none focus:border-[#0369a1] focus:ring-4 focus:ring-sky-100"
                                placeholder="nama@email.com"
                            >

                            @error('login_email')

                                <p class="text-xs text-red-500 mt-2">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                        <div>

                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3.5 text-sm text-slate-900 outline-none focus:border-[#0369a1] focus:ring-4 focus:ring-sky-100"
                                placeholder="Masukkan password"
                            >

                        </div>

                        <label class="flex items-center gap-3 cursor-pointer">

                            <input
                                type="checkbox"
                                name="remember"
                                value="1"
                                class="w-4 h-4 rounded border-slate-300 text-[#0369a1] focus:ring-[#0369a1]"
                            >

                            <span class="text-xs text-slate-500">
                                Ingat saya
                            </span>

                        </label>

                        <button
                            type="submit"
                            class="w-full rounded-2xl bg-[#0369a1] hover:bg-[#075985] text-white font-black py-4 px-6 transition shadow-lg shadow-sky-900/10"
                        >
                            Login & Lanjutkan
                        </button>

                    </form>

                </div>

                <div
                    x-show="activeTab === 'register'"
                    x-transition
                >

                    <form action="{{ route('order.check_register.process') }}" method="POST" class="space-y-5">

                        @csrf

                        <div>

                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Nama
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autocomplete="name"
                                class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3.5 text-sm text-slate-900 outline-none focus:border-[#0369a1] focus:ring-4 focus:ring-sky-100"
                                placeholder="Nama lengkap"
                            >

                        </div>

                        <div>

                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3.5 text-sm text-slate-900 outline-none focus:border-[#0369a1] focus:ring-4 focus:ring-sky-100"
                                placeholder="nama@email.com"
                            >

                        </div>

                        <div>

                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3.5 text-sm text-slate-900 outline-none focus:border-[#0369a1] focus:ring-4 focus:ring-sky-100"
                                placeholder="Minimal 8 karakter"
                            >

                        </div>

                        <div>

                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Konfirmasi Password
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3.5 text-sm text-slate-900 outline-none focus:border-[#0369a1] focus:ring-4 focus:ring-sky-100"
                                placeholder="Ulangi password"
                            >

                        </div>

                        <button
                            type="submit"
                            class="w-full rounded-2xl bg-[#0369a1] hover:bg-[#075985] text-white font-black py-4 px-6 transition shadow-lg shadow-sky-900/10"
                        >
                            Daftar & Lanjutkan
                        </button>

                    </form>

                </div>

                <div class="mt-7 pt-6 border-t border-slate-100">

                    <form action="{{ route('order.checkout.reset_payment') }}" method="POST">

                        @csrf

                        <button
                            type="submit"
                            class="w-full rounded-2xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-600 font-bold py-3.5 transition"
                        >
                            ← Kembali Pilih Metode Pembayaran
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <div class="lg:col-span-5">

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="h-56 sm:h-64 bg-slate-900 overflow-hidden">

                <img
                    src="{{ asset($template->images->where('is_primary', true)->first()?->image_path ?? 'tech1.png') }}"
                    alt="{{ $template->name }}"
                    class="w-full h-full object-cover"
                >

            </div>

            <div class="p-6 sm:p-7">

                <span class="text-[10px] text-[#0369a1] font-black uppercase tracking-[0.15em]">
                    Your Order
                </span>

                <h2 class="text-xl font-black text-slate-900 mt-1">
                    {{ $template->name }}
                </h2>

                <div class="mt-6 space-y-4">

                    <div class="flex justify-between gap-4 text-sm">

                        <span class="text-slate-500">
                            Domain
                        </span>

                        <span class="font-bold text-slate-800 text-right break-all">
                            {{ $domain }}
                        </span>

                    </div>

                    <div class="flex justify-between gap-4 text-sm">

                        <span class="text-slate-500">
                            Paket
                        </span>

                        <span class="font-bold text-slate-800">
                            {{ $package->name }}
                        </span>

                    </div>

                    <div class="flex justify-between gap-4 text-sm">

                        <span class="text-slate-500">
                            Paket Website
                        </span>

                        <span class="font-bold text-slate-800 whitespace-nowrap">
                            Rp {{ number_format($package->price_annually, 0, ',', '.') }}
                        </span>

                    </div>

                    <div class="flex justify-between gap-4 text-sm">

                        <span class="text-slate-500">
                            Domain
                        </span>

                        <span class="font-bold text-slate-800 whitespace-nowrap">
                            Rp {{ number_format($domainPrice, 0, ',', '.') }}
                        </span>

                    </div>

                </div>

                <div class="border-t border-slate-100 mt-6 pt-5">

                    <div class="flex justify-between items-end gap-4">

                        <div>

                            <p class="text-xs font-bold text-slate-500">
                                Total
                            </p>

                            <p class="text-[10px] text-slate-400 mt-1">
                                Pembayaran pesanan
                            </p>

                        </div>

                        <span class="text-2xl font-black text-[#0369a1] whitespace-nowrap">
                            Rp {{ number_format($totalAmount, 0, ',', '.') }}
                        </span>

                    </div>

                </div>

            </div>

            <div class="px-6 sm:px-7 pb-7">

                <div class="mt-4 rounded-2xl border border-slate-100 bg-slate-50 p-4">

                    <div class="flex items-start gap-3">

                        <div class="w-9 h-9 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-[#0369a1] shrink-0">
                            👤
                        </div>

                        <div>

                            <p class="text-xs font-black text-slate-800">
                                Your Account, Your Order
                            </p>

                            <p class="text-[10px] leading-relaxed text-slate-500 mt-1">
                                Your order will be linked to your account for easier access and tracking.
                            </p>

                        </div>

                    </div>

                </div>

                <div class="mt-4 rounded-2xl border border-slate-100 bg-slate-50 p-4">

                    <div class="flex items-start gap-3">

                        <div class="w-9 h-9 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-[#0369a1] shrink-0">
                            🔒
                        </div>

                        <div>

                            <p class="text-xs font-black text-slate-800">
                                100% Aman & Terpercaya
                            </p>

                            <p class="text-[10px] leading-relaxed text-slate-500 mt-1">
                                Akun diperlukan untuk memastikan pesanan tercatat pada profil kamu dan memudahkan proses setelah pembayaran.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
