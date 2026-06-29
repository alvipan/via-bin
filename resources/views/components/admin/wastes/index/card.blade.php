<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
    @forelse ($wastes as $waste)
        <flux:card class="flex flex-col justify-between space-y-4">
            <!-- Header Card: Nama & Status -->
            <div class="flex items-start justify-between gap-2">

                <div class="text-base font-semibold text-zinc-800 dark:text-white">
                    {{ $waste->name }}
                </div>

                <div class="flex items-center justify-end gap-2">
                    @if ($waste->is_active)
                        <flux:badge color="green" size="sm">Aktif</flux:badge>
                    @else
                        <flux:badge color="zinc" size="sm">Nonaktif</flux:badge>
                    @endif
                    <flux:dropdown position="bottom" align="end">
                        <flux:button variant="ghost" size="sm" icon="ellipsis-vertical" inset="top bottom" />

                        <flux:menu>
                            <flux:menu.item :href="route('wastes.show', $waste)" wire:navigate>
                                Detail
                            </flux:menu.item>

                            <flux:menu.item wire:click="edit({{ $waste->id }})">
                                Edit
                            </flux:menu.item>

                            <flux:menu.separator />

                            <flux:menu.item wire:click="toggle({{ $waste->id }})">
                                {{ $waste->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </flux:menu.item>

                        </flux:menu>

                    </flux:dropdown>
                </div>
            </div>

            <!-- Konten Utama: Detail Informasi -->
            <flux:callout>
                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <span class="block text-xs text-zinc-400">Satuan</span>
                        <span class="font-medium text-zinc-700 dark:text-zinc-300">{{ $waste->unit }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-zinc-400">Harga Estimasi</span>
                        <span class="font-medium text-zinc-700 dark:text-zinc-300">Rp
                            {{ number_format($waste->estimated_price) }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-zinc-400">Lot Aktif</span>
                        <span
                            class="font-medium text-zinc-700 dark:text-zinc-300">{{ $waste->depositItems->count() }}</span>
                    </div>
                </div>
            </flux:callout>
        </flux:card>
    @empty
        <!-- State ketika data kosong -->
        <flux:card class="col-span-full">
            <div class="py-10 text-center">
                <span class="font-medium text-zinc-500 dark:text-zinc-400">
                    Belum ada jenis sampah
                </span>
            </div>
        </flux:card>
    @endforelse
</div>
