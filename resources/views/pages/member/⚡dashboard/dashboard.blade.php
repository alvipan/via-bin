<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <flux:heading size="xl" class="font-extrabold tracking-tight text-zinc-900 dark:text-white">
                Halo, {{ member()->name }}
            </flux:heading>
            <flux:text class="mt-1 text-zinc-500 dark:text-zinc-400">
                Selamat datang kembali di Portal Member ViaBin.
            </flux:text>
        </div>
    </div>

    <!-- Stat Cards Grid -->
    <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3">

        <!-- Card Saldo (Primary Highlight) -->
        <flux:card
            class="relative overflow-hidden border-0 bg-gradient-to-br from-teal-500 to-emerald-600 p-5 text-white shadow-lg shadow-teal-500/20">
            <div class="flex items-start justify-between">
                <div class="space-y-1">
                    <flux:text class="text-xs font-semibold uppercase tracking-wider text-teal-100">
                        Saldo
                    </flux:text>
                    <flux:heading size="xl" class="font-bold text-white">
                        {{ Number::currency($summary['balance'], 'IDR') }}
                    </flux:heading>
                </div>
                <div class="rounded-xl bg-white/10 p-2.5 text-white backdrop-blur-md">
                    <flux:icon name="wallet" class="h-6 w-6" />
                </div>
            </div>
            <!-- Decorative Light Blur -->
            <div class="pointer-events-none absolute -bottom-4 -right-4 h-24 w-24 rounded-full bg-white/10 blur-xl">
            </div>
        </flux:card>

        <!-- Card Lot Aktif -->
        <flux:card
            class="border border-zinc-200/80 p-5 shadow-sm transition-shadow hover:shadow-md dark:border-zinc-800">
            <div class="flex items-start justify-between">
                <div class="space-y-1">
                    <flux:text class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                        Lot Aktif
                    </flux:text>
                    <flux:heading size="xl" class="font-bold text-zinc-800 dark:text-white">
                        {{ $summary['active_lot_count'] }}
                    </flux:heading>
                </div>
                <div class="rounded-xl bg-teal-50 p-2.5 text-teal-600 dark:bg-teal-950/50 dark:text-teal-400">
                    <flux:icon name="archive-box" class="h-6 w-6" />
                </div>
            </div>
        </flux:card>

        <!-- Card Estimasi Pendapatan -->
        <flux:card
            class="border border-zinc-200/80 p-5 shadow-sm transition-shadow hover:shadow-md sm:col-span-2 md:col-span-1 dark:border-zinc-800">
            <div class="flex items-start justify-between">
                <div class="space-y-1">
                    <flux:text class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                        Estimasi Pendapatan
                    </flux:text>
                    <flux:heading size="xl" class="font-bold text-emerald-600 dark:text-emerald-400">
                        {{ Number::currency($summary['estimated_income'], 'IDR') }}
                    </flux:heading>
                </div>
                <div
                    class="rounded-xl bg-emerald-50 p-2.5 text-emerald-600 dark:bg-emerald-950/50 dark:text-emerald-400">
                    <flux:icon name="banknotes" class="h-6 w-6" />
                </div>
            </div>
        </flux:card>

    </div>

    <!-- Section Lot Aktif Table / Mobile Cards -->
    <div class="space-y-4">

        <!-- Header Section Table -->
        <div class="flex items-center justify-between px-1">
            <div class="flex items-center gap-2">
                <flux:heading size="lg" class="font-bold">
                    Lot Aktif
                </flux:heading>
                <flux:badge size="sm" variant="flat" color="teal">
                    {{ $summary['active_lot_count'] }} Lot
                </flux:badge>
            </div>
        </div>

        <!-- 1. MOBILE VIEW: Tampilan Card (Hidden di Desktop / 'md:hidden') -->
        <div class="grid gap-3 md:hidden">
            @forelse ($summary['active_lots'] as $lot)
                <flux:card class="space-y-3 border border-zinc-200/80 p-4 shadow-sm dark:border-zinc-800">
                    <!-- Top Info: Lot ID & Jenis Sampah -->
                    <div
                        class="flex items-center justify-between border-b border-zinc-100 pb-2.5 dark:border-zinc-800/60">
                        <div class="flex items-center gap-2">
                            <flux:badge variant="solid" color="zinc" class="font-mono font-bold">
                                {{ $lot->lot_no }}
                            </flux:badge>
                        </div>
                        <span class="text-sm font-semibold text-zinc-800 dark:text-zinc-200">
                            {{ $lot->wasteTypeName }}
                        </span>
                    </div>

                    <!-- Bottom Info: Sisa & Estimasi -->
                    <div class="grid grid-cols-2 gap-2 pt-1 text-sm">
                        <div>
                            <flux:text class="text-xs text-zinc-500 dark:text-zinc-400">Sisa</flux:text>
                            <p class="font-medium text-zinc-700 dark:text-zinc-300">
                                {{ Number::format($lot->quantity_remaining, 3) }} {{ $lot->unit }}
                            </p>
                        </div>
                        <div class="text-right">
                            <flux:text class="text-xs text-zinc-500 dark:text-zinc-400">Estimasi</flux:text>
                            <p class="font-semibold text-emerald-600 dark:text-emerald-400">
                                {{ Number::currency($lot->estimated_income, 'IDR') }}
                            </p>
                        </div>
                    </div>
                </flux:card>
            @empty
                <flux:card class="border border-dashed border-zinc-300 py-8 text-center dark:border-zinc-700">
                    <flux:text class="text-zinc-500 dark:text-zinc-400">
                        Belum memiliki lot aktif.
                    </flux:text>
                </flux:card>
            @endforelse
        </div>

        <!-- 2. DESKTOP VIEW: Tampilan Table (Hidden di Mobile / 'hidden md:block') -->
        <div class="hidden md:block">
            <flux:card class="overflow-hidden border border-zinc-200/80 py-2 shadow-sm dark:border-zinc-800">
                <flux:table>
                    <flux:table.columns>
                        <flux:table.column class="pl-6">Lot</flux:table.column>
                        <flux:table.column>Jenis Sampah</flux:table.column>
                        <flux:table.column align="end">Sisa</flux:table.column>
                        <flux:table.column align="end" class="pr-6">Estimasi</flux:table.column>
                    </flux:table.columns>

                    <flux:table.rows>
                        @forelse ($summary['active_lots'] as $lot)
                            <flux:table.row class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/30">
                                <flux:table.cell variant="strong"
                                    class="pl-6 font-mono font-bold text-zinc-900 dark:text-white">
                                    {{ $lot->lot_no }}
                                </flux:table.cell>

                                <flux:table.cell class="font-medium">
                                    {{ $lot->wasteTypeName }}
                                </flux:table.cell>

                                <flux:table.cell align="end">
                                    <span class="font-medium text-zinc-700 dark:text-zinc-300">
                                        {{ Number::format($lot->quantity_remaining, 3) }}
                                    </span>
                                    <span class="ml-1 text-xs text-zinc-400">
                                        {{ $lot->unit }}
                                    </span>
                                </flux:table.cell>

                                <flux:table.cell align="end"
                                    class="pr-6 font-semibold text-emerald-600 dark:text-emerald-400">
                                    {{ Number::currency($lot->estimated_income, 'IDR') }}
                                </flux:table.cell>
                            </flux:table.row>
                        @empty
                            <flux:table.row>
                                <flux:table.cell colspan="4" class="py-12 text-center">
                                    <flux:text class="text-zinc-500 dark:text-zinc-400">
                                        Belum memiliki lot aktif.
                                    </flux:text>
                                </flux:table.cell>
                            </flux:table.row>
                        @endforelse
                    </flux:table.rows>
                </flux:table>
            </flux:card>
        </div>

    </div>

</div>
