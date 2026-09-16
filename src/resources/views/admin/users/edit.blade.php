@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="mx-auto max-w-3xl space-y-6">

    <div>
        <a
            href="{{ route('admin.users.show', $user) }}"
            class="text-[10px] font-semibold text-sky-600 hover:text-sky-700"
        >
            ← Back to User Detail
        </a>

        <h1 class="mt-3 text-2xl font-bold text-slate-800">
            Edit User
        </h1>

        <p class="mt-1 text-xs text-slate-500">
            Update customer account information.
        </p>
    </div>

    <form
        method="POST"
        action="{{ route('admin.users.update', $user) }}"
        class="rounded-xl border border-slate-100 bg-white p-6 shadow-sm"
    >

        @csrf
        @method('PUT')

        <div class="space-y-5">

            <div>
                <label class="text-[10px] font-semibold text-slate-600">
                    Full Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    required
                    class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm text-slate-700 outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100"
                >

                @error('name')
                    <p class="mt-1 text-[10px] text-red-500">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label class="text-[10px] font-semibold text-slate-600">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    required
                    class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm text-slate-700 outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100"
                >

                @error('email')
                    <p class="mt-1 text-[10px] text-red-500">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="border-t border-slate-100 pt-5">

                <p class="text-xs font-semibold text-slate-700">
                    Change Password
                </p>

                <p class="mt-1 text-[10px] text-slate-400">
                    Kosongkan jika password tidak ingin diubah.
                </p>

            </div>

            <div class="grid gap-5 sm:grid-cols-2">

                <div>
                    <label class="text-[10px] font-semibold text-slate-600">
                        New Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm text-slate-700 outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100"
                    >
                </div>

                <div>
                    <label class="text-[10px] font-semibold text-slate-600">
                        Confirm New Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm text-slate-700 outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100"
                    >
                </div>

            </div>

            @error('password')
                <p class="text-[10px] text-red-500">
                    {{ $message }}
                </p>
            @enderror

        </div>

        <div class="mt-8 flex justify-end gap-2 border-t border-slate-100 pt-5">

            <a
                href="{{ route('admin.users.show', $user) }}"
                class="rounded-lg border border-slate-200 px-4 py-2 text-[10px] font-semibold text-slate-600 hover:bg-slate-50"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="rounded-lg bg-[#0879b9] px-5 py-2 text-[10px] font-semibold text-white hover:bg-[#076da7]"
            >
                Save Changes
            </button>

        </div>

    </form>

</div>

@endsection