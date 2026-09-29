{{-- EDITOR FORMS --}}
<div class="mb-8">
    <h2 class="text-[22px] font-normal text-slate-800 tracking-tight">General Settings</h2>
    <p class="text-[13px] text-slate-500 mt-2 leading-relaxed pr-4">
        Customize your basic business information. Changes will reflect in the live preview instantly.
    </p>
</div>

@if($section === 'header')
    <div class="space-y-6">
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Business Name</label>
            <input type="text" name="site_name" value="{{ old('site_name', $website['header']['site_name']) }}" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition">
        </div>
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Header Badge</label>
            <input type="text" name="badge" value="{{ old('badge', $website['header']['badge']) }}" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition">
        </div>
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Button Text</label>
            <input type="text" name="button_text" value="{{ old('button_text', $website['header']['button_text']) }}" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition">
        </div>
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Button Link</label>
            <input type="text" name="button_link" value="{{ old('button_link', $website['header']['button_link']) }}" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition">
        </div>
    </div>

@elseif($section === 'body')
    <div class="space-y-6">
        {{-- Hero Section --}}
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Hero Title</label>
            <input type="text" name="hero_title" value="{{ old('hero_title', $website['body']['hero_title']) }}" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition">
        </div>
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Highlight Text</label>
            <input type="text" name="hero_highlight" value="{{ old('hero_highlight', $website['body']['hero_highlight']) }}" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition">
        </div>
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Description</label>
            <textarea name="hero_description" rows="4" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition resize-none">{{ old('hero_description', $website['body']['hero_description']) }}</textarea>
        </div>
        
        {{-- Upload Box Sesuai Desain --}}
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Upload Images</label>
            <div class="w-full border-2 border-dashed border-slate-200 rounded-2xl bg-white p-8 flex flex-col items-center justify-center text-center cursor-pointer hover:bg-slate-50 transition relative overflow-hidden">
                <div class="w-12 h-12 rounded-full bg-[#e8f4fc] text-[#0369a1] flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
                <span class="text-[13px] font-bold text-slate-800">Drag and drop images</span>
                <span class="text-[11px] font-medium text-slate-400 mt-1">JPG, PNG, or WebP up to 10MB</span>
                <input type="file" name="hero_image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
            </div>
        </div>

        <hr class="border-slate-200 my-6">
        <h3 class="text-sm font-bold text-slate-700 mb-4">Problems Section</h3>
        
        {{-- Problems --}}
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Problem 1 Title</label>
            <input type="text" name="problem_1_title" value="{{ old('problem_1_title', $website['body']['problem_1_title']) }}" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition">
        </div>
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Problem 1 Description</label>
            <textarea name="problem_1_description" rows="3" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition resize-none">{{ old('problem_1_description', $website['body']['problem_1_description']) }}</textarea>
        </div>

        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Problem 2 Title</label>
            <input type="text" name="problem_2_title" value="{{ old('problem_2_title', $website['body']['problem_2_title']) }}" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition">
        </div>
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Problem 2 Description</label>
            <textarea name="problem_2_description" rows="3" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition resize-none">{{ old('problem_2_description', $website['body']['problem_2_description']) }}</textarea>
        </div>

        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Problem 3 Title</label>
            <input type="text" name="problem_3_title" value="{{ old('problem_3_title', $website['body']['problem_3_title']) }}" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition">
        </div>
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Problem 3 Description</label>
            <textarea name="problem_3_description" rows="3" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition resize-none">{{ old('problem_3_description', $website['body']['problem_3_description']) }}</textarea>
        </div>

        <hr class="border-slate-200 my-6">
        <h3 class="text-sm font-bold text-slate-700 mb-4">Solution & CTA</h3>
        
        {{-- Solution & CTA --}}
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Solution Title</label>
            <input type="text" name="solution_title" value="{{ old('solution_title', $website['body']['solution_title']) }}" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition">
        </div>
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Solution Description</label>
            <textarea name="solution_description" rows="3" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition resize-none">{{ old('solution_description', $website['body']['solution_description']) }}</textarea>
        </div>
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">CTA Title</label>
            <input type="text" name="cta_title" value="{{ old('cta_title', $website['body']['cta_title']) }}" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition">
        </div>
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">CTA Description</label>
            <textarea name="cta_description" rows="3" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition resize-none">{{ old('cta_description', $website['body']['cta_description']) }}</textarea>
        </div>
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">CTA Button Text</label>
            <input type="text" name="cta_button_text" value="{{ old('cta_button_text', $website['body']['cta_button_text']) }}" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition">
        </div>
    </div>

@elseif($section === 'sidebar')
    <div class="space-y-6">
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Phone Number</label>
            <div class="relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                <input type="text" name="phone" value="{{ old('phone', $website['sidebar']['phone']) }}" class="w-full pl-11 pr-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition">
            </div>
        </div>
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Business Address</label>
            <textarea name="address" rows="4" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition resize-none">{{ old('address', $website['sidebar']['address']) }}</textarea>
        </div>
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">WhatsApp Number</label>
            <input type="text" name="whatsapp" value="{{ old('whatsapp', $website['sidebar']['whatsapp']) }}" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition">
        </div>
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">WhatsApp Message</label>
            <input type="text" name="whatsapp_message" value="{{ old('whatsapp_message', $website['sidebar']['whatsapp_message']) }}" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition">
        </div>
    </div>

@elseif($section === 'footer')
    <div class="space-y-6">
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Footer Description</label>
            <textarea name="footer_description" rows="5" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition resize-none">{{ old('footer_description', $website['footer']['description']) }}</textarea>
        </div>
        <div>
            <label class="block text-[13px] font-medium text-slate-500 mb-2">Copyright Text</label>
            <input type="text" name="copyright" value="{{ old('copyright', $website['footer']['copyright']) }}" class="w-full px-4 py-3.5 rounded-xl border-none shadow-sm bg-white text-[13px] font-medium text-slate-700 outline-none focus:ring-2 focus:ring-[#0369a1] transition">
        </div>
    </div>
@endif