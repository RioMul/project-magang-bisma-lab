@props([
    'title',
    'label',
    'value',
    'icon',
    'type' => 'default'
])

@php
    $iconClass = match ($type) {
        'success' => 'bg-emerald-50 text-emerald-600',
        'info' => 'bg-sky-50 text-sky-700',
        'purple' => 'bg-violet-50 text-violet-600',
        default => 'bg-slate-50 text-slate-600',
    };
@endphp

<div class="bg-white border border-slate-200 rounded-2xl p-6">

    <div class="flex items-center justify-between mb-5">

        <div class="w-10 h-10 rounded-xl {{ $iconClass }} flex items-center justify-center">

            @if($icon === 'check')

                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>

            @elseif($icon === 'globe')

                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="9"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M12 3a14 14 0 010 18M12 3a14 14 0 000 18"/>
                </svg>

            @elseif($icon === 'package')

                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="4" y="4" width="16" height="16" rx="2"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 9h8M8 13h5"/>
                </svg>

            @endif

        </div>

        <span class="text-[10px] uppercase tracking-wider text-slate-400">
            {{ $title }}
        </span>

    </div>

    <p class="text-sm text-slate-500 mb-1">
        {{ $label }}
    </p>

    <h2 class="text-xl font-bold text-slate-800 truncate">
        {{ $value }}
    </h2>

</div>