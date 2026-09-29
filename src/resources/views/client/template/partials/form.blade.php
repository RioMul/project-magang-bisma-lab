<div class="w-[420px] bg-[#f8fafc] border-r border-slate-100 overflow-y-auto shrink-0 custom-scrollbar relative">
    {{-- Form mengarah ke update controller JSON --}}
    <form id="editor-form" method="POST" action="{{ route('client.website.update') }}" enctype="multipart/form-data" class="p-8 space-y-6">
        @csrf
        @method('PUT')

        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-emerald-700 bg-emerald-50 rounded-xl font-bold border border-emerald-200">
                {{ session('success') }}
            </div>
        @endif

        {{-- TAB 1: GENERAL EDITOR --}}
        <div x-show="activeTab === 'editor'" x-transition.opacity>
            <div class="mb-8">
                <h2 class="text-[22px] font-normal text-slate-800 tracking-tight">General Settings</h2>
                <p class="text-[13px] text-slate-500 mt-2 leading-relaxed pr-4">Sesuaikan identitas website Anda. Perubahan warna dan teks akan tampil langsung di *Live Preview*.</p>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="block text-[13px] font-medium text-slate-500 mb-2">Upload Banner Baru</label>
                    <input type="file" name="hero_image" accept="image/*" @change="previewImage" class="w-full px-4 py-2 rounded-xl border border-slate-200 bg-white text-xs file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-[#0369a1] hover:file:bg-sky-100">
                </div>
                <div>
                    <label class="block text-[13px] font-medium text-slate-500 mb-2">Nama Website / Toko</label>
                    <input type="text" name="business_name" x-model="formData.business_name" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1]">
                </div>
                <div>
                    <label class="block text-[13px] font-medium text-slate-500 mb-2">Deskripsi Singkat</label>
                    <textarea name="description" x-model="formData.description" rows="4" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] resize-none"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[13px] font-medium text-slate-500 mb-2">Teks Tombol</label>
                        <input type="text" name="button_text" x-model="formData.button_text" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1]">
                    </div>
                    <div>
                        <label class="block text-[13px] font-medium text-slate-500 mb-2">Warna Tema</label>
                        <input type="color" name="theme_color" x-model="formData.theme_color" class="w-full h-12 rounded-xl cursor-pointer border-none shadow-sm">
                    </div>
                </div>
            </div>
        </div>

        {{-- TAB 2: SEO CONFIGURATION --}}
        <div x-show="activeTab === 'seo'" x-cloak x-transition.opacity>
            <div class="mb-8">
                <h2 class="text-[22px] font-normal text-slate-800 tracking-tight">SEO Configuration</h2>
                <p class="text-[13px] text-slate-500 mt-2 leading-relaxed pr-4">Optimalkan pencarian website Anda di Google.</p>
            </div>
            <div class="space-y-6">
                <div>
                    <label class="block text-[13px] font-medium text-slate-500 mb-2">Meta Title</label>
                    <input type="text" name="meta_title" x-model="formData.meta_title" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1]">
                </div>
                <div>
                    <label class="block text-[13px] font-medium text-slate-500 mb-2">Meta Description</label>
                    <textarea name="meta_description" x-model="formData.meta_description" rows="5" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] resize-none"></textarea>
                </div>
            </div>
        </div>

    </form>
</div>