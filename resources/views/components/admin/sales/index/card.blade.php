<div>
    <!-- Grid Wrapper: 1 kolom di mobile, 2 di tablet, 3 di desktop -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($sales as $sale)
            <flux:card class="flex flex-col justify-between space-y-4" :href="route('sales.show', $sale)" wire:navigate>

                <!-- Header Card: Nomor Penjualan & Status -->
                <div class="flex items-start justify-between">
                    <div>
                        <flux:heading>{{ $sale->sale_no }}</flux:heading>
                        <flux:text size="sm">
                            {{ $sale->sale_date->format('d M Y') }}
                        </flux:text>
                    </div>
                    <flux:badge size="sm" color="{{ $sale->status->color() }}">
                        {{ $sale->status->label() }}
                    </flux:badge>
                </div>

                <!-- Konten Utama Card: Breakdown Keuangan -->
                <flux:callout>
                    <!-- Pendapatan Kotor -->
                    <div class="flex items-center justify-between">
                        <flux:text size="sm">Kotor</flux:text>
                        <flux:heading>
                            {{ number_format($sale->gross_amount, 0) }}
                        </flux:heading>
                    </div>

                    <!-- Biaya Operasional -->
                    <div class="flex items-center justify-between">
                        <flux:text size="sm">Biaya</flux:text>
                        <flux:heading class="text-red-500">
                            - {{ number_format($sale->operational_amount, 0) }}
                        </flux:heading>
                    </div>

                    <!-- Pendapatan Bersih (Highlight Box) -->
                    <div class="mt-1 flex items-center justify-between">
                        <flux:text size="sm">Bersih</flux:text>
                        <flux:heading class="text-emerald-500">
                            {{ number_format($sale->net_amount, 0) }}
                        </flux:heading>
                    </div>
                </flux:callout>

            </flux:card>
        @empty
            <!-- State ketika data kosong -->
            <div class="col-span-full">
                <flux:card class="py-12 text-center">
                    <span class="font-medium text-zinc-500 dark:text-zinc-400">
                        Tidak ada penjualan ditemukan.
                    </span>
                </flux:card>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $sales->links() }}
    </div>
</div>
