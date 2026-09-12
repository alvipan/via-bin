<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <flux:heading size="xl" class="font-extrabold tracking-tight">
                Riwayat Setoran
            </flux:heading>

            <flux:text class="mt-0.5 text-zinc-500 dark:text-zinc-400">
                Pantau seluruh status setoran sampah dan detail transaksi lot Anda.
            </flux:text>
        </div>
    </div>

    <!-- Filter & Search Controls -->
    <flux:card class="flex gap-1 p-1">
        <div class="max-sm:flex-1">
            <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass"
                placeholder="Cari nomor setoran..." />
        </div>

        <div class="w-40">
            <flux:select wire:model.live="statusFilter">
                <flux:select.option value="">Semua Status</flux:select.option>
                @foreach ($statuses as $status)
                    <flux:select.option value="{{ $status->value }}">
                        {{ $status->label() }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </flux:card>

    <!-- 1. MOBILE VIEW: Card List (Tampil di layar < md) -->
    <div class="grid gap-4 md:hidden">
        @forelse ($deposits as $deposit)
            <flux:card class="cursor-pointer space-y-3 p-4" :href="route('member.deposits.show', $deposit)"
                wire:navigate>

                <!-- Card Header: No Setoran & Status -->
                <div class="flex items-center justify-between border-b border-zinc-100 pb-2.5 dark:border-zinc-800/60">
                    <span class="font-mono !font-bold text-zinc-900 dark:text-white">
                        {{ $deposit->deposit_no }}
                    </span>

                    <flux:badge size="sm" :color="$deposit->status->color()">
                        {{ $deposit->status->label() }}
                    </flux:badge>
                </div>

                <!-- Card Body: Tanggal & Jumlah Item -->
                <div class="grid grid-cols-2 gap-2 pt-1 text-sm">
                    <div>
                        <flux:text class="text-xs text-zinc-500 dark:text-zinc-400">Tanggal</flux:text>
                        <p class="font-medium text-zinc-700 dark:text-zinc-300">
                            {{ $deposit->posted_at ? $deposit->posted_at->format('d M Y, H:i') : '-' }}
                        </p>
                    </div>

                    <div class="text-right">
                        <flux:text class="text-xs text-zinc-500 dark:text-zinc-400">Total Item</flux:text>
                        <p class="font-semibold text-zinc-800 dark:text-zinc-200">
                            {{ $deposit->items->count() }} Item
                        </p>
                    </div>
                </div>

                @if ($deposit->notes)
                    <div class="border-t border-zinc-100 pt-2 text-xs text-zinc-500 dark:border-zinc-800/40">
                        <span class="font-medium">Catatan:</span> {{ $deposit->notes }}
                    </div>
                @endif

            </flux:card>
        @empty
            <flux:card class="py-12 text-center">
                <flux:text class="text-zinc-500 dark:text-zinc-400">
                    Tidak ada data setoran ditemukan.
                </flux:text>
            </flux:card>
        @endforelse
    </div>

    <!-- 2. DESKTOP VIEW: Table (Tampil di layar >= md) -->
    <div class="hidden md:block">
        <flux:card class="overflow-hidden border border-zinc-200/80 py-2.5 shadow-sm dark:border-zinc-800">
            <flux:table>
                <flux:table.columns>
                    <flux:table.column class="pl-6">No. Setoran</flux:table.column>
                    <flux:table.column>Tanggal</flux:table.column>
                    <flux:table.column align="center">Total Item</flux:table.column>
                    <flux:table.column>Catatan</flux:table.column>
                    <flux:table.column align="center">Status</flux:table.column>
                    <flux:table.column align="end" class="pr-6">Aksi</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @forelse ($deposits as $deposit)
                        <flux:table.row class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/30">

                            <flux:table.cell class="font-mono !font-bold text-zinc-900 dark:text-white">
                                {{ $deposit->deposit_no }}
                            </flux:table.cell>

                            <flux:table.cell class="text-zinc-600 dark:text-zinc-300">
                                {{ $deposit->posted_at ? $deposit->posted_at->format('d M Y, H:i') : '-' }}
                            </flux:table.cell>

                            <flux:table.cell align="center">
                                <flux:badge variant="flat" color="zinc" size="sm">
                                    {{ $deposit->items->count() }} Item
                                </flux:badge>
                            </flux:table.cell>

                            <flux:table.cell class="max-w-xs truncate text-zinc-500">
                                {{ $deposit->notes ?? '-' }}
                            </flux:table.cell>

                            <flux:table.cell align="center">
                                <flux:badge size="sm" :color="$deposit->status->color()">
                                    {{ $deposit->status->label() }}
                                </flux:badge>
                            </flux:table.cell>

                            <!-- Tombol Detail (Desktop) -->
                            <flux:table.cell align="end">
                                <flux:button :href="route('member.deposits.show', $deposit)" wire:navigate
                                    variant="subtle" size="sm">
                                    Detail
                                </flux:button>
                            </flux:table.cell>

                        </flux:table.row>
                    @empty
                        <flux:table.row>
                            <flux:table.cell colspan="6" class="py-12 text-center">
                                <flux:text class="text-zinc-500 dark:text-zinc-400">
                                    Tidak ada data setoran ditemukan.
                                </flux:text>
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse
                </flux:table.rows>
            </flux:table>
        </flux:card>
    </div>

    <!-- Pagination -->
    <div>
        {{ $deposits->links() }}
    </div>

</div>
