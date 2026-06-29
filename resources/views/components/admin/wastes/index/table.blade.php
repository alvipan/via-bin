<flux:card>

    <flux:table>

        <flux:table.columns>

            <flux:table.column>
                Nama
            </flux:table.column>

            <flux:table.column>
                Satuan
            </flux:table.column>

            <flux:table.column>
                Harga Estimasi
            </flux:table.column>

            <flux:table.column>
                Digunakan
            </flux:table.column>

            <flux:table.column>
                Status
            </flux:table.column>

            <flux:table.column />

        </flux:table.columns>

        <flux:table.rows>

            @forelse ($wastes as $waste)
                <flux:table.row>

                    <flux:table.cell>

                        <div class="font-medium">
                            {{ $waste->name }}
                        </div>

                    </flux:table.cell>

                    <flux:table.cell>
                        {{ $waste->unit }}
                    </flux:table.cell>

                    <flux:table.cell>
                        Rp {{ number_format($waste->estimated_price) }}
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ $waste->depositItems->count() }}
                    </flux:table.cell>

                    <flux:table.cell>

                        @if ($waste->is_active)
                            <flux:badge color="green" size="sm">
                                Aktif
                            </flux:badge>
                        @else
                            <flux:badge color="zinc" size="sm">
                                Nonaktif
                            </flux:badge>
                        @endif

                    </flux:table.cell>

                    <flux:table.cell align="end">

                        <div class="flex justify-end gap-2">
                            <flux:button variant="ghost" size="sm" :href="route('wastes.show', $waste)"
                                wire:navigate>
                                Detail
                            </flux:button>

                            <flux:button size="sm" wire:click="edit({{ $waste->id }})" wire:navigate>
                                Edit
                            </flux:button>

                            <flux:button variant="primary" :color="$waste->is_active ? 'red' : 'teal'" size="sm"
                                wire:click="toggle({{ $waste->id }})" wire:navigate>
                                {{ $waste->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </flux:button>
                        </div>

                    </flux:table.cell>

                </flux:table.row>

            @empty

                <flux:table.row>

                    <flux:table.cell colspan="6">

                        <div class="py-10 text-center">

                            <span class="font-medium">
                                Belum ada jenis sampah
                            </span>

                        </div>

                    </flux:table.cell>

                </flux:table.row>
            @endforelse

        </flux:table.rows>

    </flux:table>

</flux:card>
