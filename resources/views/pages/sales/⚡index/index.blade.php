<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>
            <flux:heading size="xl">
                Penjualan
            </flux:heading>

            <flux:text>
                Kelola penjualan sampah.
            </flux:text>
        </div>

        <flux:button icon="plus" variant="primary" wire:click="create">
            Tambah
        </flux:button>

    </div>

    <flux:card class="overflow-hidden">

        <flux:table>

            <flux:table.columns>

                <flux:table.column>
                    No. Penjualan
                </flux:table.column>

                <flux:table.column>
                    Tanggal
                </flux:table.column>

                <flux:table.column align="end">
                    Kotor
                </flux:table.column>

                <flux:table.column align="end">
                    Biaya
                </flux:table.column>

                <flux:table.column align="end">
                    Bersih
                </flux:table.column>

                <flux:table.column>
                    Status
                </flux:table.column>

                <flux:table.column align="end">
                </flux:table.column>

            </flux:table.columns>

            <flux:table.rows>

                @forelse ($sales as $sale)
                    <flux:table.row>

                        <flux:table.cell class="font-medium">
                            {{ $sale->sale_no }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $sale->sale_date->format('d M Y') }}
                        </flux:table.cell>

                        <flux:table.cell align="end">
                            {{ number_format($sale->gross_amount, 2) }}
                        </flux:table.cell>

                        <flux:table.cell align="end">
                            {{ number_format($sale->operational_amount, 2) }}
                        </flux:table.cell>

                        <flux:table.cell align="end">
                            {{ number_format($sale->net_amount, 2) }}
                        </flux:table.cell>

                        <flux:table.cell>

                            <flux:badge color="{{ $sale->status->color() }}">
                                {{ $sale->status->label() }}
                            </flux:badge>

                        </flux:table.cell>

                        <flux:table.cell align="end">

                            <flux:button size="sm" variant="ghost" :href="route('sales.show', $sale)"
                                wire:navigate>
                                Detail
                            </flux:button>

                        </flux:table.cell>

                    </flux:table.row>

                @empty

                    <flux:table.row>

                        <flux:table.cell colspan="7" class="py-10 text-center text-zinc-500">
                            Tidak ada penjualan ditemukan.
                        </flux:table.cell>

                    </flux:table.row>
                @endforelse

            </flux:table.rows>

        </flux:table>

    </flux:card>

    {{ $sales->links() }}

</div>
