@php
    $website = config('website');
@endphp

<footer class="border-t border-slate-100 bg-white py-12">
    <div class="mx-auto max-w-6xl px-6">

        <div class="flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-center">

            <div class="max-w-md">

                <div class="flex items-center gap-2">
                    <span class="font-bold text-slate-800">
                        {{ $website['header']['site_name'] ?? 'Bisma Labs' }}
                    </span>
                </div>

                <p class="mt-2 text-xs leading-relaxed text-slate-500">
                    {{ $website['footer']['description'] ?? '' }}
                </p>

                <p class="mt-3 text-xs text-slate-400">
                    {{ $website['footer']['copyright'] ?? '' }}
                </p>

            </div>

            <div class="flex flex-wrap items-center gap-6 text-xs text-slate-500">

                <a
                    href="#"
                    class="transition hover:text-slate-800"
                >
                    Terms of Service
                </a>

                <a
                    href="#"
                    class="transition hover:text-slate-800"
                >
                    Privacy Policy
                </a>

                @if(!empty($website['sidebar']['whatsapp']))
                    <a
                        href="https://wa.me/{{ $website['sidebar']['whatsapp'] }}?text={{ urlencode($website['sidebar']['whatsapp_message'] ?? '') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="transition hover:text-slate-800"
                    >
                        Contact Support
                    </a>
                @endif

            </div>

        </div>

    </div>
</footer>