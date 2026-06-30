<div class="space-y-4">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($deposits as $deposit)
            <flux:card class="flex flex-col justify-between space-y-4"
                :href="route('deposits.show', $deposit->deposit_no)" wire:navigate>
                <!-- Header Kartu: No Setoran & Status -->
                <div class="flex items-start justify-between">
                    <div class="space-y-1">
                        <flux:heading class="font-semibold">{{ $deposit->deposit_no }}</flux:heading>
                    </div>

                    <flux:badge size="sm" :color="$deposit->status->color()">
                        {{ $deposit->status->label() }}
                    </flux:badge>
                </div>

                <!-- Konten Kartu: Penyetor & Tanggal Dibuat -->
                <flux:callout>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <flux:text size="sm">Penyetor</flux:text>
                            <flux:heading>{{ $deposit->member->name }}</flux:heading>
                        </div>
                        <div>
                            <flux:text size="sm">Dibuat</flux:text>
                            <flux:heading>{{ $deposit->created_at->format('d M Y H:i') }}</flux:heading>
                        </div>
                    </div>
                </flux:callout>

            </flux:card>
        @empty
            <!-- Tampilan Jika Data Kosong -->
            <flux:card class="col-span-full flex flex-col items-center justify-center py-12 text-center">
                <span class="font-medium text-zinc-500 dark:text-zinc-400">
                    Tidak ada data ditemukan.
                </span>
            </flux:card>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pt-2">
        {{ $deposits->links() }}
    </div>
</div>
