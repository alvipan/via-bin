<div>
    <!-- Grid Wrapper: 1 kolom di mobile, 2 di tablet, 3 di desktop -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($this->lots as $lot)
            <flux:card class="flex flex-col justify-between space-y-4" :href="route('lots.show', $lot->lot_no)"
                wire:navigate>

                <!-- Header Card: Nomor Lot & Status -->
                <div class="flex items-start justify-between">
                    <flux:heading class="font-semibold">{{ $lot->lot_no }}</flux:heading>

                    <flux:badge size="sm" :color="$lot->status->color()">
                        {{ $lot->status->label() }}
                    </flux:badge>
                </div>

                <flux:callout>

                    <!-- Konten Utama Card -->
                    <div class="space-y-3 text-sm">

                        <div class="grid grid-cols-2 gap-2">
                            <!-- Penyetor & No Setoran -->
                            <div>
                                <flux:text size="sm">Setoran: {{ $lot->deposit_no }}</flux:text>
                                <flux:heading>{{ $lot->member->name }}</flux:heading>
                            </div>

                            <!-- Jenis Sampah -->
                            <div>
                                <flux:text size="sm">Jenis</flux:text>
                                <flux:heading>{{ $lot->waste_type_name }}</flux:heading>
                            </div>
                        </div>

                        <!-- Informasi Jumlah (Diterima & Sisa) -->
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <flux:text size="sm">Diterima</flux:text>
                                <flux:heading>
                                    {{ number_format($lot->quantity_received, 3) }} <span
                                        class="text-xs font-normal">{{ $lot->unit }}</span>
                                </flux:heading>
                            </div>
                            <div>
                                <flux:text size="sm">Sisa</flux:text>
                                <flux:heading class="text-emerald-500">
                                    {{ number_format($lot->quantity_remaining, 3) }} <span
                                        class="text-xs font-normal text-zinc-500">{{ $lot->unit }}</span>
                                </flux:heading>
                            </div>
                        </div>
                    </div>

                </flux:callout>

            </flux:card>
        @empty
            <!-- State ketika data kosong -->
            <div class="col-span-full">
                <flux:card class="py-12 text-center">
                    <span class="font-medium text-zinc-500 dark:text-zinc-400">
                        Tidak ada lot ditemukan.
                    </span>
                </flux:card>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $this->lots->links() }}
    </div>
</div>
