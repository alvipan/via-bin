<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>
            <flux:heading size="xl">
                Dashboard
            </flux:heading>

            <flux:text>
                Ringkasan aktivitas Bank Sampah.
            </flux:text>
        </div>

    </div>

    {{-- KPI --}}
    <div class="grid gap-4 lg:grid-cols-4">

        <flux:card>

            <flux:text class="text-zinc-500">
                Total Anggota
            </flux:text>

            <flux:heading size="xl" class="mt-2">
                {{ number_format($totalMembers) }}
            </flux:heading>

        </flux:card>

        <flux:card>

            <flux:text class="text-zinc-500">
                Saldo Anggota
            </flux:text>

            <flux:heading size="xl" class="mt-2">
                Rp {{ number_format($totalMemberBalance, 0, ',', '.') }}
            </flux:heading>

        </flux:card>

        <flux:card>

            <flux:text class="text-zinc-500">
                Lots Open
            </flux:text>

            <flux:heading size="xl" class="mt-2">
                {{ number_format($openLots) }}
            </flux:heading>

        </flux:card>

        <flux:card>

            <flux:text class="text-zinc-500">
                Stok Aktif
            </flux:text>

            <flux:heading size="xl" class="mt-2">
                {{ number_format($activeStock, 3, ',', '.') }} Kg
            </flux:heading>

        </flux:card>

    </div>

    <div class="grid gap-4 lg:grid-cols-4">

        <flux:card>

            <flux:text class="text-zinc-500">
                Saldo Bank Sampah
            </flux:text>

            <flux:heading size="xl" class="mt-2">
                Rp {{ number_format($tenantBalance, 0, ',', '.') }}
            </flux:heading>

        </flux:card>

        <flux:card>

            <flux:text class="text-zinc-500">
                Setoran Hari Ini
            </flux:text>

            <flux:heading size="xl" class="mt-2">
                {{ number_format($todayDeposits) }}
            </flux:heading>

        </flux:card>

        <flux:card>

            <flux:text class="text-zinc-500">
                Penjualan Hari Ini
            </flux:text>

            <flux:heading size="xl" class="mt-2">
                {{ number_format($todaySales) }}
            </flux:heading>

        </flux:card>

        <flux:card>

            <flux:text class="text-zinc-500">
                Pencairan Hari Ini
            </flux:text>

            <flux:heading size="xl" class="mt-2">
                {{ number_format($todayWithdrawals) }}
            </flux:heading>

        </flux:card>

    </div>

    {{-- Aktivitas Terbaru --}}
    <div class="grid gap-6 xl:grid-cols-2">

        {{-- Setoran Terbaru --}}
        <flux:card>

            <div class="mb-4 flex items-center justify-between">

                <div>
                    <flux:heading size="lg">
                        Setoran Terbaru
                    </flux:heading>

                    <flux:text>
                        5 transaksi terakhir.
                    </flux:text>
                </div>

                <flux:button size="sm" variant="ghost" href="{{ route('deposits.index') }}" wire:navigate>
                    Lihat Semua
                </flux:button>

            </div>

            <flux:table>

                <flux:table.columns>
                    <flux:table.column>No</flux:table.column>
                    <flux:table.column>Anggota</flux:table.column>
                    <flux:table.column>Status</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>

                    @forelse ($latestDeposits as $deposit)
                        <flux:table.row>

                            <flux:table.cell>
                                {{ $deposit->deposit_no }}
                            </flux:table.cell>

                            <flux:table.cell>
                                {{ $deposit->member->name }}
                            </flux:table.cell>

                            <flux:table.cell>
                                <flux:badge :color="$deposit->status->color()">
                                    {{ $deposit->status->label() }}
                                </flux:badge>
                            </flux:table.cell>

                        </flux:table.row>

                    @empty

                        <flux:table.row>
                            <flux:table.cell colspan="3" class="text-center text-zinc-500">
                                Belum ada data.
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse

                </flux:table.rows>

            </flux:table>

        </flux:card>

        {{-- Lots Terbaru --}}
        <flux:card>

            <div class="mb-4 flex items-center justify-between">

                <div>
                    <flux:heading size="lg">
                        Lots Terbaru
                    </flux:heading>

                    <flux:text>
                        5 lot terakhir.
                    </flux:text>
                </div>

                <flux:button size="sm" variant="ghost" href="{{ route('lots.index') }}" wire:navigate>
                    Lihat Semua
                </flux:button>

            </div>

            <flux:table>

                <flux:table.columns>
                    <flux:table.column>No</flux:table.column>
                    <flux:table.column>Jenis</flux:table.column>
                    <flux:table.column>Sisa</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>

                    @forelse ($latestLots as $lot)
                        <flux:table.row>

                            <flux:table.cell>
                                {{ $lot->lot_no }}
                            </flux:table.cell>

                            <flux:table.cell>
                                {{ $lot->waste_type_name }}
                            </flux:table.cell>

                            <flux:table.cell>
                                {{ number_format($lot->quantity_remaining, 3) }}
                                {{ $lot->unit }}
                            </flux:table.cell>

                        </flux:table.row>

                    @empty

                        <flux:table.row>
                            <flux:table.cell colspan="3" class="text-center text-zinc-500">
                                Belum ada data.
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse

                </flux:table.rows>

            </flux:table>

        </flux:card>

        {{-- Penjualan Terbaru --}}
        <flux:card>

            <div class="mb-4 flex items-center justify-between">

                <div>
                    <flux:heading size="lg">
                        Penjualan Terbaru
                    </flux:heading>

                    <flux:text>
                        5 transaksi terakhir.
                    </flux:text>
                </div>

                <flux:button size="sm" variant="ghost" href="{{ route('sales.index') }}" wire:navigate>
                    Lihat Semua
                </flux:button>

            </div>

            <flux:table>

                <flux:table.columns>
                    <flux:table.column>No</flux:table.column>
                    <flux:table.column>Tanggal</flux:table.column>
                    <flux:table.column>Status</flux:table.column>
                    <flux:table.column align="end">
                        Total
                    </flux:table.column>
                </flux:table.columns>

                <flux:table.rows>

                    @forelse ($latestSales as $sale)
                        <flux:table.row>

                            <flux:table.cell>
                                {{ $sale->sale_no }}
                            </flux:table.cell>

                            <flux:table.cell>
                                {{ $sale->sale_date->format('d M Y') }}
                            </flux:table.cell>

                            <flux:table.cell>
                                <flux:badge :color="$sale->status->color()">
                                    {{ $sale->status->label() }}
                                </flux:badge>
                            </flux:table.cell>

                            <flux:table.cell align="end">
                                Rp {{ number_format($sale->net_amount, 0, ',', '.') }}
                            </flux:table.cell>

                        </flux:table.row>

                    @empty

                        <flux:table.row>
                            <flux:table.cell colspan="4" class="text-center text-zinc-500">
                                Belum ada data.
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse

                </flux:table.rows>

            </flux:table>

        </flux:card>

        {{-- Pencairan Terbaru --}}
        <flux:card>

            <div class="mb-4 flex items-center justify-between">

                <div>
                    <flux:heading size="lg">
                        Pencairan Terbaru
                    </flux:heading>

                    <flux:text>
                        5 transaksi terakhir.
                    </flux:text>
                </div>

                <flux:button size="sm" variant="ghost" href="{{ route('withdrawals.index') }}" wire:navigate>
                    Lihat Semua
                </flux:button>

            </div>

            <flux:table>

                <flux:table.columns>
                    <flux:table.column>No</flux:table.column>
                    <flux:table.column>Anggota</flux:table.column>
                    <flux:table.column>Status</flux:table.column>
                    <flux:table.column align="end">
                        Nominal
                    </flux:table.column>
                </flux:table.columns>

                <flux:table.rows>

                    @forelse ($latestWithdrawals as $withdrawal)
                        <flux:table.row>

                            <flux:table.cell>
                                {{ $withdrawal->withdrawal_no }}
                            </flux:table.cell>

                            <flux:table.cell>
                                {{ $withdrawal->member->name }}
                            </flux:table.cell>

                            <flux:table.cell>
                                <flux:badge :color="$withdrawal->status->color()">
                                    {{ $withdrawal->status->label() }}
                                </flux:badge>
                            </flux:table.cell>

                            <flux:table.cell align="end">
                                Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}
                            </flux:table.cell>

                        </flux:table.row>

                    @empty

                        <flux:table.row>
                            <flux:table.cell colspan="4" class="text-center text-zinc-500">
                                Belum ada data.
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse

                </flux:table.rows>

            </flux:table>

        </flux:card>

    </div>

</div>
