<div>
    <!-- Grid Wrapper: Responsif dari HP hingga Desktop -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($withdrawals as $withdrawal)
            <flux:card class="flex flex-col justify-between space-y-4" :href="route('withdrawals.show', $withdrawal)"
                wire:navigate>

                <!-- Header Card: Nomor Penarikan & Status -->
                <div class="flex items-start justify-between">
                    <div>
                        <flux:heading>
                            {{ $withdrawal->withdrawal_no }}</flux:heading>
                        <flux:text size="sm">
                            {{ $withdrawal->created_at->format('d M Y') }}
                        </flux:text>
                    </div>
                    <flux:badge size="sm" color="{{ $withdrawal->status->color() }}">
                        {{ $withdrawal->status->label() }}
                    </flux:badge>
                </div>

                <!-- Konten Utama Card: Anggota & Jumlah Penarikan -->
                <flux:callout>
                    <div class="flex justify-between gap-2">
                        <!-- Informasi Nama Anggota -->
                        <div>
                            <flux:text size="sm">Anggota</flux:text>
                            <flux:heading>
                                {{ $withdrawal->member->name }}
                            </flux:heading>
                        </div>

                        <!-- Informasi Jumlah Penarikan (Highlight Box) -->
                        <div class="text-end">
                            <flux:text size="sm">Jumlah
                                Penarikan</flux:text>
                            <flux:heading class="text-emerald-500">
                                {{ number_format($withdrawal->amount, 0) }}
                            </flux:heading>
                        </div>
                    </div>
                </flux:callout>

            </flux:card>
        @empty
            <!-- State ketika data kosong -->
            <div class="col-span-full">
                <flux:card class="py-12 text-center">
                    <span class="font-medium text-zinc-500 dark:text-zinc-400">
                        Tidak ada data ditemukan.
                    </span>
                </flux:card>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $withdrawals->links() }}
    </div>
</div>
