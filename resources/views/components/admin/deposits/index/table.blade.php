<flux:card>
    <flux:table>
        <flux:table.columns>
            <flux:table.column>
                No. Setoran
            </flux:table.column>

            <flux:table.column>
                Penyetor
            </flux:table.column>

            <flux:table.column>
                Status
            </flux:table.column>

            <flux:table.column>
                Dibuat
            </flux:table.column>

            <flux:table.column />
        </flux:table.columns>

        <flux:table.rows>

            @forelse ($deposits as $deposit)
                <flux:table.row>

                    <flux:table.cell>
                        {{ $deposit->deposit_no }}
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ $deposit->member->name }}
                    </flux:table.cell>

                    <flux:table.cell>
                        <flux:badge size="sm" :color="$deposit->status->color()">
                            {{ $deposit->status->label() }}
                        </flux:badge>
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ $deposit->created_at->format('d M Y H:i') }}
                    </flux:table.cell>

                    <flux:table.cell align="end">

                        <flux:button size="sm" variant="ghost" :href="route('deposits.show', $deposit->deposit_no)"
                            wire:navigate>
                            Detail
                        </flux:button>

                    </flux:table.cell>

                </flux:table.row>

            @empty

                <flux:table.row>
                    <flux:table.cell colspan="5">
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

    {{ $deposits->links() }}

</flux:card>
