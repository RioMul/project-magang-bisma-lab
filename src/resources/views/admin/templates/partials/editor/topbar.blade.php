<div class="bg-white border border-slate-100 rounded-2xl shadow-sm">

    <div class="px-5 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div class="flex items-center gap-4">

            <a
                href="{{ route('admin.templates.index') }}"
                class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center text-slate-500 hover:text-[#0369a1] hover:bg-slate-50 transition"
                title="Back to Templates"
            >
                <svg
                    class="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>
            </a>

            <div>
                <div class="flex items-center gap-2">

                    <h1 class="text-lg font-bold text-slate-900">
                        {{ $template->name }}
                    </h1>

                    @if($template->is_active)
                        <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-600 text-[9px] font-bold uppercase tracking-wider">
                            Active
                        </span>
                    @else
                        <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-500 text-[9px] font-bold uppercase tracking-wider">
                            Inactive
                        </span>
                    @endif

                </div>

                <p class="text-xs text-slate-400 mt-0.5">
                    Edit template content and appearance
                </p>
            </div>

        </div>

        <div class="flex items-center gap-2">

            @if($template->demo_url)

                <a
                    href="{{ $template->demo_url }}"
                    target="_blank"
                    class="px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition"
                >
                    Preview
                </a>

            @endif

            <button
                type="button"
                class="px-4 py-2.5 rounded-xl bg-[#0369a1] hover:bg-[#027ea7] text-white text-xs font-semibold transition shadow-sm"
            >
                Save Changes
            </button>

        </div>

    </div>

</div>