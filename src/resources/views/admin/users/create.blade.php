@extends('layouts.admin')

@section('title', 'New User | Admin Panel')

@section('content')
<div class="mx-auto max-w-3xl">

    <div class="mb-6">
        <a
            href="{{ route('admin.users.index') }}"
            class="text-[10px] font-semibold text-sky-600"
        >
            ← Back to Users
        </a>

        <h1 class="mt-4 text-2xl font-bold text-slate-800">
            Create New User
        </h1>

        <p class="mt-1 text-xs text-slate-500">
            Add a new customer account to the platform.
        </p>
    </div>

    <div class="rounded-xl border border-slate-100 bg-white p-6 shadow-sm">

        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="text-[10px] font-semibold text-slate-600">
                    Full Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-xs outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500"
                    placeholder="Enter full name"
                >

                @error('name')
                    <p class="mt-1 text-[10px] text-red-500">{{ $message }}</p>
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
                    class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-xs outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500"
                    placeholder="customer@example.com"
                >

                @error('email')
                    <p class="mt-1 text-[10px] text-red-500">{{ $message }}</p>
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
                        class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-xs outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500"
                        placeholder="Minimum 8 characters"
                    >

                    @error('password')
                        <p class="mt-1 text-[10px] text-red-500">{{ $message }}</p>
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
                        class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-xs outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500"
                        placeholder="Repeat password"
                    >
                </div>

            </div>

            <div class="flex justify-end gap-2 border-t border-slate-100 pt-5">

                <a
                    href="{{ route('admin.users.index') }}"
                    class="rounded-lg border border-slate-200 px-4 py-2 text-[10px] font-semibold text-slate-600"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-lg bg-sky-600 px-4 py-2 text-[10px] font-semibold text-white hover:bg-sky-700"
                >
                    Create User
                </button>

            </div>
        </form>

    </div>
</div>
@endsection