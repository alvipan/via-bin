<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>
            <flux:heading size="xl">
                {{ $deposit->deposit_no }}
            </flux:heading>

            <flux:text>
                Rincian setoran dan daftar sampah.
            </flux:text>
        </div>

        <div class="flex gap-2">

            @if ($deposit->isDraft())
                <flux:button variant="primary" wire:click="confirmPost">
                    Terbitkan
                </flux:button>
            @endif

        </div>

    </div>

    {{-- Deposit Information --}}

    <flux:card>

        <div class="grid gap-6 md:grid-cols-2">

            <div>
                <flux:text class="font-medium">
                    Penyetor
                </flux:text>

                <div class="mt-1">
                    {{ $deposit->member->member_code }}
                    -
                    {{ $deposit->member->name }}
                </div>
            </div>

            <div>
                <flux:text class="font-medium">
                    Status
                </flux:text>

                <div class="mt-1">
                    <flux:badge :color="$deposit->status->color()">
                        {{ $deposit->status->label() }}
                    </flux:badge>
                </div>
            </div>

            <div>
                <flux:text class="font-medium">
                    Dibuat
                </flux:text>

                <div class="mt-1">
                    {{ $deposit->created_at->format('d M Y H:i') }}
                </div>
            </div>

            <div>
                <flux:text class="font-medium">
                    Diterbitkan
                </flux:text>

                <div class="mt-1">
                    {{ $deposit->posted_at?->format('d M Y H:i') ?? '-' }}
                </div>
            </div>

        </div>

    </flux:card>

    {{-- Items --}}

    <flux:card>

        <div class="mb-4 flex items-center justify-between">

            <flux:heading size="lg">
                Daftar Sampah
            </flux:heading>

            @if ($deposit->isDraft())
                <flux:button variant="primary" wire:click="addItem">
                    Tambah Item
                </flux:button>
            @endif

        </div>

        <flux:table>

            <flux:table.columns>
                <flux:table.column>
                    Jenis
                </flux:table.column>

                <flux:table.column>
                    Satuan
                </flux:table.column>

                <flux:table.column>
                    Kuantitas
                </flux:table.column>

                <flux:table.column>
                    Estimasi
                </flux:table.column>

                <flux:table.column />
            </flux:table.columns>

            <flux:table.rows>

                @forelse ($deposit->items as $item)
                    <flux:table.row>

                        <flux:table.cell>
                            {{ $item->wasteType->name }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $item->wasteType->unit }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ number_format($item->quantity, 3) }}
                        </flux:table.cell>

                        <flux:table.cell>
                            Rp
                            {{ number_format($item->quantity * $item->wasteType->estimated_price) }}
                        </flux:table.cell>

                        <flux:table.cell>

                            @if ($deposit->isDraft())
                                <div class="flex justify-end gap-2">

                                    <flux:button size="sm" variant="ghost"
                                        wire:click="editItem({{ $item->id }})">
                                        Edit
                                    </flux:button>

                                    <flux:button size="sm" variant="danger"
                                        wire:click="confirmDeleteItem({{ $item->id }})">
                                        Hapus
                                    </flux:button>

                                </div>
                            @endif

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

    </flux:card>

    {{-- Summary --}}

    <flux:card>

        <flux:heading size="lg">
            Ringkasan
        </flux:heading>

        <div class="mt-4">

            <flux:text>
                Perkiraan Nilai
            </flux:text>

            <div class="mt-1 text-2xl font-semibold">
                Rp {{ number_format($this->estimatedValue) }}
            </div>

        </div>

    </flux:card>

    {{-- Item Modal --}}

    <flux:modal class="max-w-sm" wire:model="itemModal">

        <div class="space-y-4">

            <flux:heading>
                {{ $editingItemId ? 'Edit Item' : 'Tambah Item' }}
            </flux:heading>

            <flux:select wire:model.live.debounce.300="wasteTypeId" label="Jenis Sampah">
                <option value="">
                    Pilih jenis sampah
                </option>

                @foreach ($wasteTypes as $wasteType)
                    <option value="{{ $wasteType->id }}">
                        {{ $wasteType->name }}
                    </option>
                @endforeach
            </flux:select>

            <flux:field>

                <flux:label>
                    Kuantitas
                </flux:label>

                <flux:input.group>

                    <flux:input wire:model="quantity" type="number" step="0.001" />

                    <flux:input.group.suffix>
                        {{ $this->selectedWasteType?->unit->value ?? '-' }}
                    </flux:input.group.suffix>

                </flux:input.group>

            </flux:field>

            <div class="flex justify-end gap-2">

                <flux:modal.close>
                    <flux:button variant="ghost">
                        Batal
                    </flux:button>
                </flux:modal.close>

                <flux:button variant="primary" wire:click="saveItem">
                    Simpan
                </flux:button>

            </div>

        </div>

    </flux:modal>

    <flux:modal class="max-w-sm" wire:model="postModal">

        <div class="space-y-4">

            <flux:heading>
                Terbitkan Setoran
            </flux:heading>

            <flux:text>
                Tindakan ini akan menyelesaikan setoran dan membuat lot inventaris.
                Setoran yang telah terbitkan tidak dapat diedit lagi.
            </flux:text>

            <flux:callout>

                <div>
                    <flux:heading>No. Setoran:</flux:heading>
                    <flux:text>{{ $deposit->deposit_no }}</flux:text>
                </div>

                <div>
                    <flux:heading>Anggota</flux:heading>
                    <flux:text>{{ $deposit->member->name }}</flux:text>
                </div>

                <div>
                    <flux:heading>Items</flux:heading>
                    <flux:text>{{ $deposit->items->count() }}</flux:text>
                </div>

                <div>
                    <flux:heading>Perkiraan Nilai</flux:heading>
                    <flux:text>Rp {{ number_format($this->estimatedValue) }}</flux:text>
                </div>

            </flux:callout>

            <div class="flex justify-end gap-2">

                <flux:modal.close>
                    <flux:button variant="ghost">
                        Batal
                    </flux:button>
                </flux:modal.close>

                <flux:button variant="primary" wire:click="post">
                    Terbitkan
                </flux:button>

            </div>

        </div>

    </flux:modal>

    <flux:modal class="max-w-sm" wire:model="deleteItemModal">

        <div class="space-y-4">

            <flux:heading>
                Hapus Item
            </flux:heading>

            <flux:text>
                Item yang dihapus akan dikeluarkan dari daftar setoran.
                Tindakan ini tidak dapat dibatalkan.
            </flux:text>

            <flux:callout>
                <div>
                    <flux:heading>No. Setoran:</flux:heading>
                    <flux:text>{{ $deposit->deposit_no }}</flux:text>
                </div>

                <div>
                    <flux:heading>Item:</flux:heading>
                    <flux:text>
                        {{ $deletingItem?->wasteType->name }}
                    </flux:text>
                </div>

                <div>
                    <flux:heading>Kuantitas:</flux:heading>
                    <flux:text>
                        {{ number_format($deletingItem?->quantity, 3) }}
                        {{ $deletingItem?->wasteType->unit->value }}
                    </flux:text>
                </div>
            </flux:callout>

            <div class="flex justify-end gap-2">
                <flux:modal.close>
                    <flux:button variant="ghost">
                        Batal
                    </flux:button>
                </flux:modal.close>

                <flux:button variant="danger" wire:click="deleteItem">
                    Hapus
                </flux:button>
            </div>

        </div>

    </flux:modal>

</div>
