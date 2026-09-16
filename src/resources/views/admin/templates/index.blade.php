@extends('admin.layouts.app')

@section('title', 'Templates')

@section('content')

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

    <div>
        <h1 class="text-2xl font-bold text-slate-800">
            Templates
        </h1>

        <p class="text-xs text-slate-500 mt-1">
            Manage website templates available for customers.
        </p>
    </div>

    <a
        href="{{ route('admin.templates.create') }}"
        class="px-4 py-2.5 rounded-lg bg-[#0879b9] text-white text-xs font-semibold">

        + New Template

    </a>

</div>

<div class="bg-white rounded-xl border border-slate-100 overflow-hidden">

    <div class="p-4 border-b border-slate-100">

        <form method="GET">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search template..."
                class="w-full max-w-sm px-4 py-2.5 rounded-lg border border-slate-200 bg-slate-50 text-xs focus:ring-2 focus:ring-cyan-100 focus:border-[#0879b9]">

        </form>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-left">

            <thead class="bg-slate-50">

                <tr class="text-[9px] uppercase tracking-wider text-slate-400">

                    <th class="px-5 py-3">Template</th>
                    <th class="px-5 py-3">Type</th>
                    <th class="px-5 py-3">Difficulty</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3">Action</th>

                </tr>

            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($templates as $template)

                    <tr class="text-xs">

                        <td class="px-5 py-4">
                            <div class="font-semibold text-slate-700">
                                {{ $template->name }}
                            </div>

                            <div class="text-[10px] text-slate-400">
                                /{{ $template->slug }}
                            </div>
                        </td>

                        <td class="px-5 py-4 text-slate-500">
                            {{ $template->type?->name ?? '-' }}
                        </td>

                        <td class="px-5 py-4 text-slate-500">
                            {{ $template->difficulty ?? '-' }}
                        </td>

                        <td class="px-5 py-4">

                            <span class="px-2 py-1 rounded-full text-[9px]
                                {{ $template->is_active
                                    ? 'bg-emerald-50 text-emerald-600'
                                    : 'bg-slate-100 text-slate-500' }}">

                                {{ $template->is_active ? 'Active' : 'Inactive' }}

                            </span>

                        </td>

                        <td class="px-5 py-4">

                            <div class="flex items-center gap-3">

                                <a
                                    href="{{ route('admin.templates.edit', $template) }}"
                                    class="text-[#0879b9]">
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('admin.templates.destroy', $template) }}"
                                    onsubmit="return confirm('Hapus template ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-500">
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="px-5 py-10 text-center text-xs text-slate-400">
                            Belum ada template.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="p-4">
        {{ $templates->links() }}
    </div>

</div>

@endsection