<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
    @forelse ($wastes as $waste)
        <flux:card class="flex flex-col justify-between space-y-4">
            <!-- Header Card: Nama & Status -->
            <div class="flex items-start justify-between gap-2">

                <flux:heading class="font-semibold" :href="route('wastes.show', $waste)" wire:navigate>
                    {{ $waste->name }}
                </flux:heading>

                <div class="flex items-center justify-end gap-2">
                    @if ($waste->is_active)
                        <flux:badge color="green" size="sm">Aktif</flux:badge>
                    @else
                        <flux:badge color="zinc" size="sm">Nonaktif</flux:badge>
                    @endif

                    <flux:dropdown>
                        <flux:button variant="ghost" size="sm" icon="ellipsis-vertical" />

                        <flux:menu>

                            <flux:menu.item wire:click="edit({{ $waste->id }})">
                                Edit
                            </flux:menu.item>

                            <flux:menu.item wire:click="toggle({{ $waste->id }})">
                                {{ $waste->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </flux:menu.item>

                        </flux:menu>

                    </flux:dropdown>
                </div>
            </div>

            <!-- Konten Utama: Detail Informasi -->
            <flux:callout>
                <div class="grid grid-cols-2 gap-3 md:grid-cols-3">
                    <div>
                        <flux:text size="sm">Lot Aktif</flux:text>
                        <flux:heading>{{ $waste->depositItems->count() }}</flux:heading>
                    </div>
                    <div>
                        <flux:text size="sm">Satuan</flux:text>
                        <flux:heading>{{ $waste->unit }}</flux:heading>
                    </div>
                    <div>
                        <flux:text size="sm">Harga Estimasi</flux:text>
                        <flux:heading>Rp
                            {{ number_format($waste->estimated_price) }}</flux:heading>
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
