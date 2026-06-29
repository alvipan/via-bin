<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>
            <flux:heading size="xl">
                {{ $lot->lot_no }}
            </flux:heading>

            <flux:text>
                Detail lot dan riwayat penjualan.
            </flux:text>
        </div>

        <flux:badge :color="$lot->status->color()">
            {{ $lot->status->label() }}
        </flux:badge>

    </div>

    {{-- Lot Information --}}

    <flux:card>
        <flux:heading size="lg">
            Informasi Lot
        </flux:heading>

        <div class="mt-6 grid gap-6 md:grid-cols-2">

            <div>
                <flux:text class="font-medium">
                    Penyetor
                </flux:text>

                <div class="mt-1">
                    {{ $lot->member->member_code }}
                    -
                    {{ $lot->member->name }}
                </div>
            </div>

            <div>
                <flux:text class="font-medium">
                    No. Setoran
                </flux:text>

                <div class="mt-1">
                    {{ $lot->depositItem->deposit->deposit_no }}
                </div>
            </div>

            <div>
                <flux:text class="font-medium">
                    Jenis
                </flux:text>

                <div class="mt-1">
                    {{ $lot->depositItem->wasteType->name }}
                </div>
            </div>

            <div>
                <flux:text class="font-medium">
                    Satuan
                </flux:text>

                <div class="mt-1">
                    {{ $lot->depositItem->wasteType->unit->value }}
                </div>
            </div>

            <div>
                <flux:text class="font-medium">
                    Dibuat
                </flux:text>

                <div class="mt-1">
                    {{ $lot->created_at->format('d M Y H:i') }}
                </div>
            </div>

        </div>
    </flux:card>

    {{-- Inventory Summary --}}

    <flux:card>
        <flux:heading size="lg">
            Ringkasan Inventaris
        </flux:heading>

        <div class="mt-6 grid gap-6 md:grid-cols-3">

            <div>

                <flux:text>
                    Kuantitas Diterima
                </flux:text>

                <div class="mt-2 text-xl font-semibold">
                    {{ number_format($lot->quantity_received, 3) }}
                    {{ $lot->depositItem->wasteType->unit->value }}
                </div>

            </div>

            <div>
                <flux:text>
                    Kuantitas Terjual
                </flux:text>

                <div class="mt-2 text-xl font-semibold">
                    {{ number_format($this->quantitySold, 3) }}
                    {{ $lot->depositItem->wasteType->unit->value }}
                </div>
            </div>

            <div>
                <flux:text>
                    Kuantitas Tersisa
                </flux:text>

                <div class="mt-2 text-xl font-semibold">
                    {{ number_format($lot->quantity_remaining, 3) }}
                    {{ $lot->depositItem->wasteType->unit->value }}
                </div>
            </div>

        </div>
    </flux:card>

    {{-- Sales History --}}

    <flux:card>
        <div class="mb-4">
            <flux:heading>
                Riwayat Penjualan
            </flux:heading>

            <flux:text>
                Semua transaksi penjualan yang menggunakan lot ini.
            </flux:text>
        </div>

        <flux:table>
            <flux:table.columns>
                <flux:table.column>No. Penjualan</flux:table.column>
                <flux:table.column>Tanggal</flux:table.column>
                <flux:table.column>Satuan</flux:table.column>
                <flux:table.column align="end">Kuantitas</flux:table.column>
                <flux:table.column align="end">Harga</flux:table.column>
                <flux:table.column align="end">Subtotal</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>

                @forelse ($lot->saleItemLots as $usage)
                    <flux:table.row>
                        <flux:table.cell>
                            {{ $usage->saleItem->sale->sale_no }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $usage->saleItem->sale->posted_at->format('d M Y') }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $usage->lot->wasteType->unit->value }}
                        </flux:table.cell>

                        <flux:table.cell align="end">
                            {{ number_format($usage->quantity, 3) }}
                        </flux:table.cell>

                        <flux:table.cell align="end">
                            Rp {{ number_format($usage->saleItem->unit_price, 2) }}
                        </flux:table.cell>

                        <flux:table.cell align="end">
                            Rp {{ number_format($usage->quantity * $usage->saleItem->unit_price, 2) }}
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="5" class="py-8 text-center text-zinc-500">
                            Belum ada riwayat penjualan.
                        </flux:table.cell>
                    </flux:table.row>
                @endforelse

            </flux:table.rows>
        </flux:table>
    </flux:card>

</div>
