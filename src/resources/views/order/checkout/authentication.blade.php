<div
    class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start"
    x-data="{
        tab: '{{ old('name') || $errors->has('name') ? 'register' : 'login' }}'
    }">

    <div class="lg:col-span-7">

        <form
            action="{{ route('order.checkout.reset_payment') }}"
            method="POST"
            class="mb-6">

            @csrf

            <button
                type="submit"
                class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-[#0369a1]">

                ← Kembali Pilih Metode

            </button>

        </form>

        <div class="flex items-center gap-4 mb-8">

            <div class="w-10 h-10 rounded-full bg-[#057A55] text-white flex items-center justify-center font-bold">
                ✓
            </div>

            <div>

                <h1 class="text-2xl sm:text-3xl font-black text-slate-900">
                    Buat Akun Dulu!
                </h1>

                <p class="text-slate-500 text-sm mt-1">
                    Silakan login atau buat akun untuk melanjutkan pembayaran.
                </p>

            </div>

        </div>

        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">

            <div class="flex rounded-xl bg-slate-100 p-1.5 mb-8">

                <button
                    type="button"
                    @click="tab = 'register'"
                    :class="tab === 'register'
                        ? 'bg-white text-slate-900 shadow-sm'
                        : 'text-slate-500'"
                    class="flex-1 py-3 text-xs font-bold uppercase rounded-lg">

                    Register

                </button>

                <button
                    type="button"
                    @click="tab = 'login'"
                    :class="tab === 'login'
                        ? 'bg-white text-slate-900 shadow-sm'
                        : 'text-slate-500'"
                    class="flex-1 py-3 text-xs font-bold uppercase rounded-lg">

                    Login

                </button>

            </div>

            <div x-show="tab === 'register'" x-cloak>

                <form
                    action="{{ route('order.check_register.process') }}"
                    method="POST"
                    class="space-y-5">

                    @csrf

                    <div>

                        <label class="block text-xs font-bold text-slate-500 mb-2">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            class="w-full px-4 py-3 bg-slate-50 border-0 rounded-xl">

                    </div>

                    <div>

                        <label class="block text-xs font-bold text-slate-500 mb-2">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="w-full px-4 py-3 bg-slate-50 border-0 rounded-xl">

                    </div>

                    <div>

                        <label class="block text-xs font-bold text-slate-500 mb-2">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            required
                            class="w-full px-4 py-3 bg-slate-50 border-0 rounded-xl">

                    </div>

                    <div>

                        <label class="block text-xs font-bold text-slate-500 mb-2">
                            Konfirmasi Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            required
                            class="w-full px-4 py-3 bg-slate-50 border-0 rounded-xl">

                    </div>

                    <button
                        type="submit"
                        class="w-full bg-[#0369a1] hover:bg-[#027ea8] text-white py-4 rounded-xl font-bold">

                        Daftar & Lanjut Bayar

                    </button>

                </form>

            </div>

            <div x-show="tab === 'login'" x-cloak>

                <form
                    action="{{ route('order.check_login.process') }}"
                    method="POST"
                    class="space-y-5">

                    @csrf

                    <div>

                        <label class="block text-xs font-bold text-slate-500 mb-2">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="w-full px-4 py-3 bg-slate-50 border-0 rounded-xl">

                    </div>

                    <div>

                        <label class="block text-xs font-bold text-slate-500 mb-2">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            required
                            class="w-full px-4 py-3 bg-slate-50 border-0 rounded-xl">

                    </div>

                    <button
                        type="submit"
                        class="w-full bg-[#0369a1] hover:bg-[#027ea8] text-white py-4 rounded-xl font-bold">

                        Login & Lanjut Bayar

                    </button>

                </form>

            </div>

        </div>

    </div>

    <div class="lg:col-span-5 lg:sticky lg:top-28">

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

            <img
                src="{{ asset(
                    $template->images
                        ->where('is_primary', true)
                        ->first()
                        ->image_path ?? 'tech1.png'
                ) }}"
                class="w-full h-56 object-cover">

            <div class="p-6">

                <span class="text-xs font-bold text-[#0369a1] uppercase">
                    Template Terpilih
                </span>

                <h2 class="text-2xl font-black text-slate-900 mt-1">
                    {{ $template->name }}
                </h2>

                <div class="mt-6 space-y-4">

                    <div class="flex justify-between">
                        <span class="text-sm text-slate-500">
                            Domain
                        </span>

                        <span class="font-bold text-sm">
                            {{ $domain }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-sm text-slate-500">
                            Paket
                        </span>

                        <span class="font-bold text-sm">
                            {{ $package->name }}
                        </span>
                    </div>

                    <div class="border-t border-slate-100 pt-4 flex justify-between">
                        <span class="font-bold">
                            Total
                        </span>

                        <span class="font-black text-[#0369a1]">
                            Rp {{ number_format($totalAmount, 0, ',', '.') }}
                        </span>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>