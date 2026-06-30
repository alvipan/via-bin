<flux:card>

    <flux:table>

        <flux:table.columns>

            <flux:table.column>No. Penarikan</flux:table.column>

            <flux:table.column>Tanggal</flux:table.column>

            <flux:table.column>Anggota</flux:table.column>

            <flux:table.column align="end">
                Jumlah
            </flux:table.column>

            <flux:table.column>Status</flux:table.column>

            <flux:table.column></flux:table.column>

        </flux:table.columns>

        <flux:table.rows>

            @forelse($withdrawals as $withdrawal)
                <flux:table.row>

                    <flux:table.cell>
                        {{ $withdrawal->withdrawal_no }}
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ $withdrawal->created_at->format('d M Y') }}
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ $withdrawal->member->name }}
                    </flux:table.cell>

                    <flux:table.cell align="end">
                        {{ number_format($withdrawal->amount, 2) }}
                    </flux:table.cell>

                    <flux:table.cell>

                        <flux:badge color="{{ $withdrawal->status->color() }}">
                            {{ $withdrawal->status->label() }}
                        </flux:badge>

                    </flux:table.cell>

                    <flux:table.cell align="end">

                        <flux:button size="sm" variant="ghost" :href="route('withdrawals.show', $withdrawal)"
                            wire:navigate>
                            Detail
                        </flux:button>

                    </flux:table.cell>

                </flux:table.row>

            @empty

                <flux:table.row>

                    <flux:table.cell colspan="6">

                        <div class="py-10 text-center">

                            <span class="font-medium">
                                Tidak ada data di temukan.
                            </span>

                        </div>

                    </flux:table.cell>

                </flux:table.row>
            @endforelse

        </flux:table.rows>

    </flux:table>

    {{ $withdrawals->links() }}

</flux:card>
