<div class="space-y-6">

    <div>
        <flux:heading size="xl">
            Halo, {{ member()->name }} 👋
        </flux:heading>

        <flux:text class="mt-1">
            Selamat datang kembali di Portal Member ViaBin.
        </flux:text>
    </div>

    <div class="grid gap-4 md:grid-cols-3">

        <flux:card class="space-y-2">
            <flux:text size="sm">
                Saldo Member
            </flux:text>

            <flux:heading size="lg">
                {{ Number::currency($summary['balance'], 'IDR') }}
            </flux:heading>
        </flux:card>

        <flux:card class="space-y-2">
            <flux:text size="sm">
                Lot Aktif
            </flux:text>

            <flux:heading size="lg">
                {{ $summary['active_lot_count'] }}
            </flux:heading>
        </flux:card>

        <flux:card class="space-y-2">
            <flux:text size="sm">
                Estimasi Pendapatan
            </flux:text>

            <flux:heading size="lg">
                {{ Number::currency($summary['estimated_income'], 'IDR') }}
            </flux:heading>
        </flux:card>

    </div>

    <flux:card>

        <div class="mb-4 flex items-center justify-between">

            <flux:heading>
                Lot Aktif
            </flux:heading>

            <flux:text>
                {{ $summary['active_lot_count'] }} Lot
            </flux:text>

        </div>

        <flux:table>

            <flux:table.columns>

                <flux:table.column>Lot</flux:table.column>

                <flux:table.column>Jenis Sampah</flux:table.column>

                <flux:table.column align="end">
                    Sisa
                </flux:table.column>

                <flux:table.column align="end">
                    Estimasi
                </flux:table.column>

            </flux:table.columns>

            <flux:table.rows>

                @forelse ($summary['active_lots'] as $lot)
                    <flux:table.row>

                        <flux:table.cell variant="strong">
                            {{ $lot->lot_no }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $lot->wasteTypeName }}
                        </flux:table.cell>

                        <flux:table.cell align="end">
                            {{ Number::format($lot->quantity_remaining, 3) }}
                            {{ $lot->unit }}
                        </flux:table.cell>

                        <flux:table.cell align="end">
                            {{ Number::currency($lot->estimated_income, 'IDR') }}
                        </flux:table.cell>

                    </flux:table.row>

                @empty

                    <flux:table.row>

                        <flux:table.cell colspan="4" class="py-10 text-center">
                            <flux:text class="text-zinc-500">
                                Belum memiliki lot aktif.
                            </flux:text>
                        </flux:table.cell>

                    </flux:table.row>
                @endforelse

            </flux:table.rows>

        </flux:table>

    </flux:card>

</div>
