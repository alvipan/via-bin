<div class="space-y-6">

    <div class="flex flex-col gap-2 lg:flex-row lg:items-center">

        <div class="flex-1">

            <flux:heading size="xl">
                Lots
            </flux:heading>

            <flux:text>
                Monitor lot hasil setoran yang telah diterbitkan.
            </flux:text>

        </div>

        <div class="flex items-center gap-2">

            <flux:input wire:model.live.debounce.300ms="search" placeholder="Pencarian..." />

            <flux:select wire:model.live="status">

                <option value="">
                    Semua Status
                </option>

                @foreach ($this->statuses as $status)
                    <option value="{{ $status->value }}">
                        {{ $status->label() }}
                    </option>
                @endforeach

            </flux:select>

        </div>

    </div>

    <flux:card>

        <flux:table>

            <flux:table.columns>

                <flux:table.column>
                    No. Lot
                </flux:table.column>

                <flux:table.column>
                    No. Setoran
                </flux:table.column>

                <flux:table.column>
                    Anggota
                </flux:table.column>

                <flux:table.column>
                    Jenis Sampah
                </flux:table.column>

                <flux:table.column align="end">
                    Diterima
                </flux:table.column>

                <flux:table.column align="end">
                    Sisa
                </flux:table.column>

                <flux:table.column>
                    Status
                </flux:table.column>

                <flux:table.column />

            </flux:table.columns>

            <flux:table.rows>

                @forelse ($this->lots as $lot)
                    <flux:table.row>

                        <flux:table.cell>
                            {{ $lot->lot_no }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $lot->deposit_no }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $lot->member->name }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $lot->waste_type_name }}
                        </flux:table.cell>

                        <flux:table.cell align="end">
                            {{ number_format($lot->quantity_received, 3) }}
                            {{ $lot->unit }}
                        </flux:table.cell>

                        <flux:table.cell align="end">
                            {{ number_format($lot->quantity_remaining, 3) }}
                            {{ $lot->unit }}
                        </flux:table.cell>

                        <flux:table.cell>

                            <flux:badge size="sm" :color="$lot->status->color()">
                                {{ $lot->status->label() }}
                            </flux:badge>

                        </flux:table.cell>

                        <flux:table.cell align="end">

                            <flux:button size="sm" variant="ghost" :href="route('lots.show', $lot->lot_no)"
                                wire:navigate>

                                Detail

                            </flux:button>

                        </flux:table.cell>

                    </flux:table.row>

                @empty

                    <flux:table.row>

                        <flux:table.cell colspan="8">

                            <div class="py-10 text-center">

                                <span class="font-medium">
                                    Tidak ada lot ditemukan.
                                </span>

                            </div>

                        </flux:table.cell>

                    </flux:table.row>
                @endforelse

            </flux:table.rows>

        </flux:table>

        {{ $this->lots->links() }}

    </flux:card>

</div>
