@extends('admin.layouts.app')

@section('title', 'Create User')

@section('content')

<div class="mx-auto max-w-3xl space-y-6">

    <div>
        <a
            href="{{ route('admin.users.index') }}"
            class="text-[10px] font-semibold text-sky-600 hover:text-sky-700"
        >
            ← Back to Users
        </a>

        <h1 class="mt-3 text-2xl font-bold text-slate-800">
            Create New User
        </h1>

        <p class="mt-1 text-xs text-slate-500">
            Add a new customer account to the platform.
        </p>
    </div>

    <form
        method="POST"
        action="{{ route('admin.users.store') }}"
        class="rounded-xl border border-slate-100 bg-white p-6 shadow-sm"
    >

        @csrf

        <div class="space-y-5">

            <div>
                <label class="text-[10px] font-semibold text-slate-600">
                    Full Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm text-slate-700 outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100"
                    placeholder="Customer name"
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
                    value="{{ old('email') }}"
                    required
                    class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm text-slate-700 outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100"
                    placeholder="customer@example.com"
                >

                @error('email')
                    <p class="mt-1 text-[10px] text-red-500">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="grid gap-5 sm:grid-cols-2">

                <div>
                    <label class="text-[10px] font-semibold text-slate-600">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        required
                        class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm text-slate-700 outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100"
                    >

                    @error('password')
                        <p class="mt-1 text-[10px] text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="text-[10px] font-semibold text-slate-600">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm text-slate-700 outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100"
                    >
                </div>

            </div>

        </div>

        <div class="mt-8 flex justify-end gap-2 border-t border-slate-100 pt-5">

            <a
                href="{{ route('admin.users.index') }}"
                class="rounded-lg border border-slate-200 px-4 py-2 text-[10px] font-semibold text-slate-600 hover:bg-slate-50"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="rounded-lg bg-[#0879b9] px-5 py-2 text-[10px] font-semibold text-white hover:bg-[#076da7]"
            >
                Create User
            </button>

        </div>

    </form>

</div>

@endsection