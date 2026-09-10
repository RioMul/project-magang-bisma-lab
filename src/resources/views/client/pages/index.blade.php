@extends('layouts.client')

@section('title', 'Halaman | Bisma Labs')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Halaman</h1>
        <p class="text-slate-500 text-sm mt-1">Manage your website's architecture and content structure in one place.</p>
    </div>
    <button class="inline-flex items-center gap-2 bg-[#0369a1] hover:bg-[#0284c7] text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-sm transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Create Page
    </button>
</div>

<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden mb-8">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead class="bg-slate-50 border-b border-slate-100 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4">Page Name</th>
                    <th class="px-6 py-4">URL Slug</th>
                    <th class="px-6 py-4">Last Modified</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($pages as $page)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4 font-bold text-slate-800">{{ $page['name'] }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ $page['slug'] }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ $page['updated_at'] }}</td>
                    <td class="px-6 py-4">
                        @if($page['status'] === 'Published')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Published
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Draft
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('client.pages.edit', $page['id']) }}" class="p-2 text-sky-600 hover:bg-sky-50 rounded-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <button class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-6">
    <div class="flex items-center gap-4">
        <div class="flex -space-x-3">
            <div class="w-10 h-10 rounded-full border-2 border-white bg-slate-800"></div>
            <div class="w-10 h-10 rounded-full border-2 border-white bg-slate-300"></div>
            <div class="w-10 h-10 rounded-full border-2 border-white bg-[#0369a1] text-white flex items-center justify-center text-xs font-bold">+2</div>
        </div>
        <p class="text-sm text-slate-500">Active collaborators working on current pages.</p>
    </div>
    <div class="flex items-center gap-8 sm:gap-12">
        <div class="text-center">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Pages</p>
            <p class="text-2xl font-black text-[#0369a1]">12</p>
        </div>
        <div class="text-center border-l border-slate-200 pl-8 sm:pl-12">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Live Links</p>
            <p class="text-2xl font-black text-emerald-500">9</p>
        </div>
        <div class="text-center border-l border-slate-200 pl-8 sm:pl-12">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">SEO Score</p>
            <p class="text-2xl font-black text-slate-800">94%</p>
        </div>
    </div>
</div>
@endsection