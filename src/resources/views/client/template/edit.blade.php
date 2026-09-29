@extends('layouts.editor')
@section('title', 'Website Editor | Bisma Labs')

@section('content')
<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
</style>

{{-- Container Utama dengan State Alpine.js --}}
<div class="flex flex-col h-screen bg-white font-sans" x-data="atelierEditor()">
    
    {{-- 1. Memanggil Topbar --}}
    @include('client.template.partials.topbar')

    <div class="flex flex-1 min-h-0 overflow-hidden">
        
        {{-- 2. Memanggil Sidebar Kiri --}}
        @include('client.template.partials.sidebar')
        
        {{-- 3. Memanggil Form Tengah --}}
        @include('client.template.partials.form')

        {{-- 4. Memanggil iFrame Preview Kanan --}}
        @include('client.template.partials.preview')

    </div>
</div>

{{-- Script Data Binding Alpine.js --}}
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('atelierEditor', () => ({
            activeTab: 'editor', // Tab default yang terbuka
            viewMode: 'desktop', // Mode iframe default
            
            // Data ditarik dari file JSON milik user (Tanpa Database)
            formData: {
                business_name: '{!! addslashes($websiteData["business_name"] ?? "Toko Anda") !!}',
                description: '{!! addslashes($websiteData["description"] ?? "") !!}',
                button_text: '{!! addslashes($websiteData["button_text"] ?? "Mulai Sekarang") !!}',
                theme_color: '{!! $websiteData["theme_color"] ?? "#0369a1" !!}',
                meta_title: '{!! addslashes($websiteData["meta_title"] ?? "") !!}',
                meta_description: '{!! addslashes($websiteData["meta_description"] ?? "") !!}'
            },

            // Logika Preview Gambar Instan sebelum di-save
            @php 
                $img = $websiteData['hero_image'] ?? 'jpg1.jpg';
                $imgPath = str_starts_with($img, 'storage/') ? asset($img) : asset($img);
            @endphp
            image_preview: '{{ $imgPath }}',
            
            previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    this.image_preview = URL.createObjectURL(file);
                }
            }
        }))
    })
</script>
@endsection