<div class="overflow-x-auto">

    <table class="w-full min-w-[900px]">

        <thead>

            <tr class="border-b border-slate-100 bg-slate-50/70">

                <th class="px-5 py-4 text-left text-[8px] font-bold uppercase tracking-wider text-slate-400">
                    Website
                </th>

                <th class="px-5 py-4 text-left text-[8px] font-bold uppercase tracking-wider text-slate-400">
                    Owner
                </th>

                <th class="px-5 py-4 text-left text-[8px] font-bold uppercase tracking-wider text-slate-400">
                    Template
                </th>

                <th class="px-5 py-4 text-left text-[8px] font-bold uppercase tracking-wider text-slate-400">
                    Plan
                </th>

                <th class="px-5 py-4 text-left text-[8px] font-bold uppercase tracking-wider text-slate-400">
                    Status
                </th>

                <th class="px-5 py-4 text-left text-[8px] font-bold uppercase tracking-wider text-slate-400">
                    Expiry
                </th>

                <th class="px-5 py-4 text-right text-[8px] font-bold uppercase tracking-wider text-slate-400">
                    Action
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($websites as $website)

                @php

                    $statusClass = match($website->status) {
                        'active', 'published' => 'bg-emerald-50 text-emerald-600',
                        'building', 'pending' => 'bg-amber-50 text-amber-600',
                        'expired' => 'bg-red-50 text-red-500',
                        default => 'bg-slate-100 text-slate-500',
                    };

                @endphp

                <tr class="border-b border-slate-100 last:border-0 hover:bg-slate-50/50">

                    <td class="px-5 py-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-sky-50 text-sky-600">

                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <rect
                                        x="3"
                                        y="4"
                                        width="18"
                                        height="16"
                                        rx="2"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        d="M3 9h18"
                                    />

                                </svg>

                            </div>

                            <div class="min-w-0">

                                <p class="max-w-[220px] truncate text-[10px] font-semibold text-slate-700">
                                    {{ $website->domain_name }}
                                </p>

                                <p class="text-[8px] text-slate-400">
                                    Website
                                </p>

                            </div>

                        </div>

                    </td>

                    <td class="px-5 py-4">

                        @if($website->order?->user)

                            <a
                                href="{{ route('admin.users.show', $website->order->user) }}"
                                class="text-[10px] font-semibold text-slate-700 hover:text-sky-600"
                            >
                                {{ $website->order->user->name }}
                            </a>

                            <p class="max-w-[170px] truncate text-[8px] text-slate-400">
                                {{ $website->order->user->email }}
                            </p>

                        @else

                            <span class="text-[10px] text-slate-400">
                                —
                            </span>

                        @endif

                    </td>

                    <td class="px-5 py-4">

                        <span class="text-[9px] text-slate-600">
                            {{ $website->order?->template?->name ?? '—' }}
                        </span>

                    </td>

                    <td class="px-5 py-4">

                        <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[8px] font-medium text-slate-500">
                            {{ $website->order?->package?->name ?? '—' }}
                        </span>

                    </td>

                    <td class="px-5 py-4">

                        <span class="inline-flex rounded-full px-2.5 py-1 text-[8px] font-semibold {{ $statusClass }}">
                            {{ ucfirst($website->status) }}
                        </span>

                    </td>

                    <td class="px-5 py-4">

                        @if($website->expires_at)

                            <span class="text-[9px] text-slate-500">
                                {{ $website->expires_at->format('d M Y') }}
                            </span>

                            @if($website->expires_at->isPast())

                                <p class="mt-1 text-[8px] font-medium text-red-500">
                                    Expired
                                </p>

                            @endif

                        @else

                            <span class="text-[9px] text-slate-400">
                                No expiry
                            </span>

                        @endif

                    </td>

                    <td class="px-5 py-4">

                        <div class="flex justify-end">

                            @if($website->order?->user)

                                <a
                                    href="{{ route('admin.users.show', $website->order->user) }}"
                                    class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[8px] font-semibold text-slate-600 transition hover:border-sky-200 hover:text-sky-600"
                                >
                                    View User
                                </a>

                            @else

                                <span class="text-[8px] text-slate-300">
                                    —
                                </span>

                            @endif

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="7"
                        class="px-5 py-16 text-center"
                    >

                        <div class="text-sm font-semibold text-slate-400">
                            Belum ada website.
                        </div>

                        <p class="mt-1 text-[10px] text-slate-400">
                            Website yang dibuat dari pesanan client akan muncul di sini.
                        </p>

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@if($websites->hasPages())

    <div class="border-t border-slate-100 px-5 py-4">

        {{ $websites->links() }}

    </div>

@endif