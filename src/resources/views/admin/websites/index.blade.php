@extends('layouts.editor')
@section('title', 'Website Editor | Bisma Labs')

@section('content')
<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: #94a3b8; }
</style>

<div class="flex flex-col h-screen bg-white font-sans" x-data="{ viewMode: 'desktop' }">
    {{-- TOPBAR --}}
    @include('admin.websites.partials.topbar')

    <div class="flex flex-1 min-h-0 overflow-hidden">
        {{-- SIDEBAR KIRI --}}
        @if($tab === 'editor')
            @include('admin.websites.partials.sidebar')
        @endif

        {{-- AREA FORM TENGAH --}}
        @include('admin.websites.partials.form')

        {{-- AREA PREVIEW MOCKUP KANAN --}}
        @include('admin.websites.partials.preview')
    </div>
</div>
@endsection