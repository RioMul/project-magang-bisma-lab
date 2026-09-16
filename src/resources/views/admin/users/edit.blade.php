@extends('layouts.admin')

@section('title', 'Edit User | Admin Panel')

@section('content')
<div class="mx-auto max-w-3xl">

    <div class="mb-6">
        <a
            href="{{ route('admin.users.show', $user) }}"
            class="text-[10px] font-semibold text-sky-600"
        >
            ← Back to User
        </a>

        <h1 class="mt-4 text-2xl font-bold text-slate-800">
            Edit User
        </h1>

        <p class="mt-1 text-xs text-slate-500">
            Update customer account information.
        </p>
    </div>

    <div class="rounded-xl border border-slate-100 bg-white p-6 shadow-sm">

        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="text-[10px] font-semibold text-slate-600">
                    Full Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    required
                    class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-xs outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500"
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
                    value="{{ old('email', $user->email) }}"
                    required
                    class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-xs outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500"
                >

                @error('email')
                    <p class="mt-1 text-[10px] text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid gap-5 sm:grid-cols-2">

                <div>
                    <label class="text-[10px] font-semibold text-slate-600">
                        New Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-xs outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500"
                        placeholder="Leave blank to keep current"
                    >

                    @error('password')
                        <p class="mt-1 text-[10px] text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-[10px] font-semibold text-slate-600">
                        Confirm New Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-xs outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500"
                        placeholder="Repeat new password"
                    >
                </div>

            </div>

            <div class="flex justify-between border-t border-slate-100 pt-5">

                <form
                    method="POST"
                    action="{{ route('admin.users.destroy', $user) }}"
                    onsubmit="return confirm('Hapus user ini?')"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="rounded-lg bg-red-50 px-4 py-2 text-[10px] font-semibold text-red-500 hover:bg-red-100"
                    >
                        Delete User
                    </button>
                </form>

                <div class="flex gap-2">

                    <a
                        href="{{ route('admin.users.show', $user) }}"
                        class="rounded-lg border border-slate-200 px-4 py-2 text-[10px] font-semibold text-slate-600"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="rounded-lg bg-sky-600 px-4 py-2 text-[10px] font-semibold text-white hover:bg-sky-700"
                    >
                        Save Changes
                    </button>

                </div>

            </div>

        </form>

    </div>
</div>
@endsection