<div class="space-y-6">

    {{-- Header --}}

    <div class="flex flex-col gap-4 lg:flex-row lg:items-center">

        <div class="flex-1">

            <flux:heading size="xl">
                Jenis Sampah
            </flux:heading>

            <flux:text>
                Kelola jenis sampah dan harga estimasi.
            </flux:text>

        </div>

        <flux:button variant="primary" icon="plus" wire:click="create">
            Tambah
        </flux:button>

    </div>

    {{-- Table --}}

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

                            <flux:dropdown position="bottom" align="end">

                                <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal"
                                    inset="top bottom" />

                                <flux:menu>

                                    <flux:menu.item icon="eye" :href="route('wastes.show', $waste)" wire:navigate>
                                        Detail
                                    </flux:menu.item>

                                    <flux:menu.item icon="pencil" wire:click="edit({{ $waste->id }})">
                                        Edit
                                    </flux:menu.item>

                                    <flux:menu.separator />

                                    <flux:menu.item :icon="$waste->is_active ? 'pause' : 'play'"
                                        wire:click="toggle({{ $waste->id }})">
                                        {{ $waste->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </flux:menu.item>

                                </flux:menu>

                            </flux:dropdown>

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

    {{-- Modal --}}

    <flux:modal wire:model="modal" class="w-64">

        <div class="space-y-4">

            <div>

                <flux:heading>
                    {{ $editingId ? 'Edit Jenis Sampah' : 'Tambah Jenis Sampah' }}
                </flux:heading>

                <flux:text>
                    Informasi ini digunakan saat pencatatan setoran.
                </flux:text>

            </div>

            <flux:input wire:model="name" label="Nama" placeholder="Contoh: Plastik PET" />

            <flux:select wire:model="unit" label="Satuan" placeholder="Pilih satuan">
                @foreach (\App\Enums\Unit::cases() as $unit)
                    <flux:select.option :value="$unit->value">
                        {{ $unit->label() }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            <flux:input wire:model="estimatedPrice" type="number" step="0.01" label="Harga Estimasi" />

            <div class="flex justify-end gap-2">

                <flux:modal.close>
                    <flux:button variant="ghost">
                        Batal
                    </flux:button>
                </flux:modal.close>

                <flux:button variant="primary" wire:click="save">
                    Simpan
                </flux:button>

            </div>

        </div>

    </flux:modal>

</div>
