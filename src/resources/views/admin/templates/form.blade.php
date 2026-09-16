@csrf

<div class="grid lg:grid-cols-2 gap-5">

    <div>
        <label class="block text-xs font-medium text-slate-600 mb-1.5">
            Template Name
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $template->name ?? '') }}"
            required
            class="w-full px-4 py-3 rounded-lg border border-slate-200 text-sm">
    </div>

    <div>
        <label class="block text-xs font-medium text-slate-600 mb-1.5">
            Template Type
        </label>

        <select
            name="template_type_id"
            required
            class="w-full px-4 py-3 rounded-lg border border-slate-200 text-sm">

            <option value="">Choose type</option>

            @foreach($types as $type)

                <option
                    value="{{ $type->id }}"
                    @selected(
                        old(
                            'template_type_id',
                            $template->template_type_id ?? ''
                        ) == $type->id
                    )>

                    {{ $type->name }}

                </option>

            @endforeach

        </select>
    </div>

    <div>
        <label class="block text-xs font-medium text-slate-600 mb-1.5">
            Slug
        </label>

        <input
            type="text"
            name="slug"
            value="{{ old('slug', $template->slug ?? '') }}"
            class="w-full px-4 py-3 rounded-lg border border-slate-200 text-sm">
    </div>

    <div>
        <label class="block text-xs font-medium text-slate-600 mb-1.5">
            Difficulty
        </label>

        <select
            name="difficulty"
            class="w-full px-4 py-3 rounded-lg border border-slate-200 text-sm">

            <option value="">Choose difficulty</option>

            @foreach(['Easy', 'Medium', 'Advanced'] as $difficulty)

                <option
                    value="{{ $difficulty }}"
                    @selected(
                        old(
                            'difficulty',
                            $template->difficulty ?? ''
                        ) === $difficulty
                    )>

                    {{ $difficulty }}

                </option>

            @endforeach

        </select>
    </div>

</div>

<div class="mt-5">

    <label class="block text-xs font-medium text-slate-600 mb-1.5">
        Demo URL
    </label>

    <input
        type="url"
        name="demo_url"
        value="{{ old('demo_url', $template->demo_url ?? '') }}"
        placeholder="https://..."
        class="w-full px-4 py-3 rounded-lg border border-slate-200 text-sm">

</div>

<div class="mt-5">

    <label class="block text-xs font-medium text-slate-600 mb-1.5">
        Description
    </label>

    <textarea
        name="description"
        rows="5"
        class="w-full px-4 py-3 rounded-lg border border-slate-200 text-sm">{{ old('description', $template->description ?? '') }}</textarea>

</div>

<div class="mt-5 flex flex-wrap gap-5">

    <label class="flex items-center gap-2 text-xs text-slate-600">

        <input
            type="checkbox"
            name="is_featured"
            value="1"
            @checked(old('is_featured', $template->is_featured ?? false))>

        Featured

    </label>

    <label class="flex items-center gap-2 text-xs text-slate-600">

        <input
            type="checkbox"
            name="is_active"
            value="1"
            @checked(old('is_active', $template->is_active ?? true))>

        Active

    </label>

</div>