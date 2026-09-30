<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">

    <div class="mb-6">
        <span class="text-[10px] font-bold uppercase tracking-widest text-[#0369a1]">
            General
        </span>

        <h2 class="mt-1 text-xl font-bold text-slate-900">
            General Information
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Atur informasi dasar template.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Template Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $template->name) }}"
                required
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:border-[#0369a1] focus:ring-2 focus:ring-sky-100 outline-none"
            >
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Template Type
            </label>

            <select
                name="template_type_id"
                required
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:border-[#0369a1] focus:ring-2 focus:ring-sky-100 outline-none"
            >
                <option value="">Choose type</option>

                @foreach($types as $type)
                    <option
                        value="{{ $type->id }}"
                        @selected(
                            old(
                                'template_type_id',
                                $template->template_type_id
                            ) == $type->id
                        )
                    >
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Slug
            </label>

            <input
                type="text"
                name="slug"
                value="{{ old('slug', $template->slug) }}"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:border-[#0369a1] focus:ring-2 focus:ring-sky-100 outline-none"
            >

            <p class="mt-1.5 text-[11px] text-slate-400">
                Digunakan sebagai nama file template JSON.
            </p>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-2">
                Difficulty
            </label>

            <select
                name="difficulty"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:border-[#0369a1] focus:ring-2 focus:ring-sky-100 outline-none"
            >
                <option value="">Choose difficulty</option>

                @foreach(['Easy', 'Medium', 'Advanced'] as $difficulty)
                    <option
                        value="{{ $difficulty }}"
                        @selected(
                            old(
                                'difficulty',
                                $template->difficulty
                            ) === $difficulty
                        )
                    >
                        {{ $difficulty }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="mt-5">

        <label class="block text-xs font-semibold text-slate-600 mb-2">
            Demo URL
        </label>

        <input
            type="url"
            name="demo_url"
            value="{{ old('demo_url', $template->demo_url) }}"
            placeholder="https://..."
            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:border-[#0369a1] focus:ring-2 focus:ring-sky-100 outline-none"
        >

    </div>

    <div class="mt-5">

        <label class="block text-xs font-semibold text-slate-600 mb-2">
            Description
        </label>

        <textarea
            name="description"
            rows="5"
            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:border-[#0369a1] focus:ring-2 focus:ring-sky-100 outline-none"
        >{{ old('description', $template->description) }}</textarea>

    </div>

    <div class="mt-5 flex flex-wrap gap-6">

        <label class="flex items-center gap-2 text-xs text-slate-600">

            <input
                type="checkbox"
                name="is_featured"
                value="1"
                @checked(
                    old(
                        'is_featured',
                        $template->is_featured
                    )
                )
                class="rounded border-slate-300 text-[#0369a1] focus:ring-[#0369a1]"
            >

            Featured

        </label>

        <label class="flex items-center gap-2 text-xs text-slate-600">

            <input
                type="checkbox"
                name="is_active"
                value="1"
                @checked(
                    old(
                        'is_active',
                        $template->is_active
                    )
                )
                class="rounded border-slate-300 text-[#0369a1] focus:ring-[#0369a1]"
            >

            Active

        </label>

    </div>

</div>