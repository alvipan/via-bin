<div class="space-y-6">

    <!-- Header Section & Tombol Kembali -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-2">
                <flux:heading size="xl" class="font-mono font-extrabold tracking-tight">
                    {{ $deposit->deposit_no }}
                </flux:heading>
                <flux:badge size="sm" :color="$deposit->status->color()">
                    {{ $deposit->status->label() }}
                </flux:badge>
            </div>
            <flux:text class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">
                Rincian setoran sampah dan status lot yang terbentuk.
            </flux:text>
        </div>
    </div>

    <!-- Hitung Kumulasi/Total -->
    @php
        $totalEstimatedIncome = $deposit->items->sum(fn($item) => $item->lot?->estimated_income ?? 0);
        $totalRemainingQty = $deposit->items->sum(fn($item) => (float) ($item->lot?->quantity_remaining ?? 0));
        $totalReceivedQty = $deposit->items->sum(fn($item) => (float) ($item->quantity ?? 0));
    @endphp

    <!-- Card Ringkasan & Stat Kumulasi -->
    <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
        <!-- Info Setoran -->
        <flux:card class="border border-zinc-200/80 p-5 shadow-sm md:col-span-2 dark:border-zinc-800">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1">
                    <flux:text class="text-xs font-semibold uppercase tracking-wider text-zinc-400">
                        Tanggal Dibukukan
                    </flux:text>
                    <p class="font-medium text-zinc-800 dark:text-zinc-200">
                        {{ $deposit->posted_at ? $deposit->posted_at->format('d M Y, H:i') : 'Belum Dibukukan' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <flux:text class="text-xs font-semibold uppercase tracking-wider text-zinc-400">
                        Total Jenis Sampah
                    </flux:text>
                    <p class="font-medium text-zinc-800 dark:text-zinc-200">
                        {{ $deposit->items->count() }} Jenis
                    </p>
                </div>
            </div>
            @if ($deposit->notes)
                <div class="mt-3 space-y-0.5 border-t border-zinc-100 pt-3 dark:border-zinc-800">
                    <flux:text class="text-xs font-semibold uppercase tracking-wider text-zinc-400">
                        Catatan
                    </flux:text>
                    <p class="text-sm text-zinc-700 dark:text-zinc-300">
                        {{ $deposit->notes }}
                    </p>
                </div>
            @endif
        </flux:card>

        <!-- Stat Total Sisa Stok -->
        <flux:card class="flex flex-col justify-between border border-zinc-200/80 p-5 shadow-sm dark:border-zinc-800">
            <flux:text class="text-xs font-semibold uppercase tracking-wider text-zinc-400">
                Total Sisa Stok Lot
            </flux:text>
            <div class="mt-2">
                <p class="text-2xl font-bold text-zinc-900 dark:text-white">
                    {{ Number::format($totalRemainingQty, 3) }}
                </p>
                <flux:text class="text-xs text-zinc-400">
                    dari {{ Number::format($totalReceivedQty, 3) }} total diterima
                </flux:text>
            </div>
        </flux:card>

        <!-- Stat Kumulasi Estimasi Pendapatan -->
        <flux:card
            class="flex flex-col justify-between border border-emerald-500/20 bg-emerald-500/5 p-5 shadow-sm dark:border-emerald-500/30">
            <flux:text class="text-xs font-semibold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">
                Kumulasi Estimasi
            </flux:text>
            <div class="mt-2">
                <p class="text-2xl font-extrabold text-emerald-600 dark:text-emerald-400">
                    {{ Number::currency($totalEstimatedIncome, 'IDR') }}
                </p>
                <flux:text class="text-xs text-emerald-700/60 dark:text-emerald-400/60">
                    *Berdasarkan sisa stok lot
                </flux:text>
            </div>
        </flux:card>
    </div>

    <!-- Section Heading -->
    <div class="flex items-center justify-between px-1 pt-2">
        <flux:heading size="lg" class="font-bold">
            Item Sampah & Detail Lot
        </flux:heading>
    </div>

    <!-- 1. MOBILE VIEW: Card List -->
    <div class="grid gap-3 md:hidden">
        @forelse ($deposit->items as $item)
            @php $lot = $item->lot; @endphp
            <flux:card class="space-y-3 border border-zinc-200/80 p-4 shadow-sm dark:border-zinc-800">
                <div class="flex items-center justify-between border-b border-zinc-100 pb-2.5 dark:border-zinc-800/60">
                    <span class="font-semibold text-zinc-900 dark:text-white">
                        {{ $item->wasteType?->name ?? '-' }}
                    </span>
                    @if ($lot)
                        <flux:badge variant="solid" color="zinc" size="sm" class="font-mono">
                            {{ $lot->lot_no }}
                        </flux:badge>
                    @else
                        <flux:badge variant="flat" color="amber" size="sm">
                            Pending Lot
                        </flux:badge>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-2 pt-1 text-sm">
                    <div>
                        <flux:text class="text-xs text-zinc-500 dark:text-zinc-400">Berat Awal Setor</flux:text>
                        <p class="font-medium text-zinc-800 dark:text-zinc-200">
                            {{ Number::format($item->quantity, 3) }} {{ $item->wasteType?->unit->value ?? 'kg' }}
                        </p>
                    </div>

                    @if ($lot)
                        <div class="text-right">
                            <flux:text class="text-xs text-zinc-500 dark:text-zinc-400">Sisa / Estimasi</flux:text>
                            <p class="font-semibold text-emerald-600 dark:text-emerald-400">
                                {{ Number::format($lot->quantity_remaining, 3) }} {{ $lot->unit }}
                            </p>
                            <p class="text-xs text-zinc-400">
                                ({{ Number::currency($lot->estimated_income, 'IDR') }})
                            </p>
                        </div>
                    @endif
                </div>
            </flux:card>
        @empty
            <flux:card class="border border-dashed border-zinc-300 py-8 text-center dark:border-zinc-700">
                <flux:text class="text-zinc-500 dark:text-zinc-400">
                    Tidak ada item dalam setoran ini.
                </flux:text>
            </flux:card>
        @endforelse
    </div>

    <!-- 2. DESKTOP VIEW: Flux Table + Ringkasan Footer -->
    <div class="hidden md:block">
        <flux:card class="py-2.5">
            <flux:table bleed>
                <flux:table.columns>
                    <flux:table.column class="pl-6">Jenis Sampah</flux:table.column>
                    <flux:table.column sortable>No. Lot</flux:table.column>
                    <flux:table.column align="end">Diterima</flux:table.column>
                    <flux:table.column align="end">Sisa Stok</flux:table.column>
                    <flux:table.column align="end" class="pr-6">Estimasi Pendapatan</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @forelse ($deposit->items as $item)
                        @php $lot = $item->lot; @endphp
                        <flux:table.row class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/30">

                            <flux:table.cell variant="strong" class="pl-6 font-medium text-zinc-900 dark:text-white">
                                {{ $item->wasteType?->name ?? '-' }}
                            </flux:table.cell>

                            <flux:table.cell>
                                @if ($lot)
                                    <span class="font-mono font-bold text-zinc-800 dark:text-zinc-200">
                                        {{ $lot->lot_no }}
                                    </span>
                                @else
                                    <span class="text-xs italic text-zinc-400">Belum diproses</span>
                                @endif
                            </flux:table.cell>

                            <flux:table.cell align="end" class="font-medium text-zinc-700 dark:text-zinc-300">
                                {{ Number::format($item->quantity, 3) }}
                                <span
                                    class="ml-0.5 text-xs text-zinc-400">{{ $item->wasteType?->unit->value ?? 'kg' }}</span>
                            </flux:table.cell>

                            <flux:table.cell align="end" class="font-semibold text-zinc-800 dark:text-zinc-200">
                                @if ($lot)
                                    {{ Number::format($lot->quantity_remaining, 3) }}
                                    <span class="ml-0.5 text-xs font-normal text-zinc-400">{{ $lot->unit }}</span>
                                @else
                                    -
                                @endif
                            </flux:table.cell>

                            <flux:table.cell align="end"
                                class="pr-6 font-semibold text-emerald-600 dark:text-emerald-400">
                                @if ($lot)
                                    {{ Number::currency($lot->estimated_income, 'IDR') }}
                                @else
                                    -
                                @endif
                            </flux:table.cell>

                        </flux:table.row>
                    @empty
                        <flux:table.row>
                            <flux:table.cell colspan="5" class="py-12 text-center">
                                <flux:text class="text-zinc-500 dark:text-zinc-400">
                                    Tidak ada item dalam setoran ini.
                                </flux:text>
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse
                </flux:table.rows>
            </flux:table>

            <!-- Table Footer untuk Kumulasi Totals -->
            @if ($deposit->items->isNotEmpty())
                <div
                    class="flex items-center justify-between border-t border-zinc-200/80 py-3.5 text-sm font-semibold dark:border-zinc-800">
                    <span class="text-xs uppercase tracking-wider text-zinc-600 dark:text-zinc-400">
                        Total Kumulasi
                    </span>
                    <div class="flex items-center gap-8 text-right">
                        <div>
                            <span class="block text-xs font-normal text-zinc-400">Total Diterima</span>
                            <span
                                class="text-zinc-800 dark:text-zinc-200">{{ Number::format($totalReceivedQty, 3) }}</span>
                        </div>
                        <div>
                            <span class="block text-xs font-normal text-zinc-400">Total Sisa Stok</span>
                            <span
                                class="text-zinc-800 dark:text-zinc-200">{{ Number::format($totalRemainingQty, 3) }}</span>
                        </div>
                        <div>
                            <span class="block text-xs font-normal text-emerald-600/70 dark:text-emerald-400/70">Total
                                Estimasi</span>
                            <span
                                class="text-base font-bold text-emerald-600 dark:text-emerald-400">{{ Number::currency($totalEstimatedIncome, 'IDR') }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </flux:card>
    </div>

</div>
