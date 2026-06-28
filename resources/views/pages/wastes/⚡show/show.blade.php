<div class="space-y-6">

    <div class="flex items-start justify-between">

        <div>
            <flux:heading size="xl">
                {{ $waste->name }}
            </flux:heading>

            <flux:text>
                Rincian jenis limbah dan statistik penggunaan.
            </flux:text>
        </div>

        <flux:button icon="arrow-left" variant="ghost" :href="route('wastes.index')" wire:navigate>
            Kembali
        </flux:button>

    </div>

    <div class="grid gap-4 md:grid-cols-3">

        <flux:card>
            <flux:text size="sm">Total Setoran</flux:text>

            <flux:heading size="xl" class="mt-2">
                {{ number_format($stats['usage_count']) }}
            </flux:heading>
        </flux:card>

        <flux:card>
            <flux:text size="sm">Total Quantity</flux:text>

            <flux:heading size="xl" class="mt-2">
                {{ number_format($stats['total_quantity'], 2) }}
            </flux:heading>
        </flux:card>

        <flux:card>
            <flux:text size="sm">Perkiraan Nilai</flux:text>

            <flux:heading size="xl" class="mt-2">
                Rp {{ number_format($stats['total_amount']) }}
            </flux:heading>
        </flux:card>

    </div>

    <flux:card>

        <flux:heading>
            Informasi
        </flux:heading>

        <div class="mt-6 grid gap-6 md:grid-cols-2">

            <div>
                <flux:text size="sm">Nama</flux:text>

                <div class="mt-1 font-medium">
                    {{ $waste->name }}
                </div>
            </div>

            <div>
                <flux:text size="sm">Unit</flux:text>

                <div class="mt-1 font-medium">
                    {{ $waste->unit }}
                </div>
            </div>

            <div>
                <flux:text size="sm">Perkiraan Harga</flux:text>

                <div class="mt-1 font-medium">
                    Rp {{ number_format($waste->estimated_price) }}
                </div>
            </div>

            <div>
                <flux:text size="sm">Status</flux:text>

                <div class="mt-1">
                    @if ($waste->is_active)
                        <flux:badge color="green">
                            Active
                        </flux:badge>
                    @else
                        <flux:badge color="zinc">
                            Inactive
                        </flux:badge>
                    @endif
                </div>
            </div>

            @if ($waste->description)
                <div class="md:col-span-2">
                    <flux:text size="sm">Description</flux:text>

                    <div class="mt-1">
                        {{ $waste->description }}
                    </div>
                </div>
            @endif

        </div>

    </flux:card>

    <flux:card>

        <div class="flex items-center justify-between">

            <flux:heading>
                Setoran Terbaru
            </flux:heading>

            <flux:text>
                10 Setoran Terakhir
            </flux:text>

        </div>

        <div class="mt-6 overflow-x-auto">

            <flux:table>

                <flux:table.columns>

                    <flux:table.column>
                        Tanggal
                    </flux:table.column>

                    <flux:table.column>
                        Anggota
                    </flux:table.column>

                    <flux:table.column align="end">
                        Quantity
                    </flux:table.column>

                    <flux:table.column align="end">
                        Harga
                    </flux:table.column>

                    <flux:table.column align="end">
                        Total
                    </flux:table.column>

                </flux:table.columns>

                <flux:table.rows>

                    @forelse ($recentDeposits as $item)
                        <flux:table.row>

                            <flux:table.cell>
                                {{ $item->created_at->format('d M Y') }}
                            </flux:table.cell>

                            <flux:table.cell>
                                {{ $item->deposit?->member?->name ?? '-' }}
                            </flux:table.cell>

                            <flux:table.cell align="end">
                                {{ number_format($item->quantity, 2) }}
                            </flux:table.cell>

                            <flux:table.cell align="end">
                                Rp {{ number_format($item->wasteType->estimated_price) }}
                            </flux:table.cell>

                            <flux:table.cell align="end">
                                Rp {{ number_format(($item->quantity ?? 0) * $item->wasteType->estimated_price) }}
                            </flux:table.cell>

                        </flux:table.row>

                    @empty

                        <flux:table.row>

                            <flux:table.cell colspan="5">
                                <div class="py-10 text-center">

                                    <span class="font-medium">
                                        Belum ada setoran.
                                    </span>

                                </div>
                            </flux:table.cell>

                        </flux:table.row>
                    @endforelse

                </flux:table.rows>

            </flux:table>

        </div>

    </flux:card>

</div>
