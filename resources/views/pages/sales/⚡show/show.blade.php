<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">

        <div>
            <flux:heading size="xl">
                {{ $sale->sale_no }}
            </flux:heading>

            <flux:text>
                Kelola transaksi penjualan sampah.
            </flux:text>
        </div>

        @if ($sale->status === \App\Enums\SaleStatus::Draft)
            <flux:button variant="primary" wire:click="confirmPost">
                Terbitkan
            </flux:button>
        @endif

    </div>

    {{-- SALE INFO --}}
    <flux:card>

        <div class="flex items-center justify-between">
            <flux:heading>
                Informasi Penjualan
            </flux:heading>

            <flux:badge color="{{ $sale->status->color() }}">
                {{ $sale->status->label() }}
            </flux:badge>
        </div>

        <div class="mt-6 grid gap-6 md:grid-cols-2">

            <div>
                <flux:text class="font-medium">Tanggal</flux:text>
                <div class="mt-1">
                    {{ optional($sale->sale_date)->format('d F Y') }}
                </div>
            </div>

            <div>
                <flux:text class="font-medium">Biaya Operasional</flux:text>
                <div class="mt-1">
                    {{ number_format($sale->operational_percent, 2) }}%
                </div>
            </div>

            <div>
                <flux:text class="font-medium">Jumlah Kotor</flux:text>
                <div class="mt-1">
                    Rp {{ number_format($this->financials['gross'], 2) }}
                </div>
            </div>

            <div>
                <flux:text class="font-medium">Jumlah Biaya</flux:text>
                <div class="mt-1">
                    Rp {{ number_format($this->financials['operational'], 2) }}
                </div>
            </div>

            <div>
                <flux:text class="font-medium">Jumlah Bersih</flux:text>
                <div class="mt-1 font-semibold">
                    Rp {{ number_format($this->financials['net'], 2) }}
                </div>
            </div>

            <div>
                <flux:text class="font-medium">Dibuat Oleh</flux:text>
                <div class="mt-1">
                    {{ $sale->creator->name ?? '-' }}
                </div>
            </div>

            @if ($sale->notes)
                <div class="md:col-span-2">
                    <flux:text class="font-medium">Catatan</flux:text>
                    <div class="mt-1 whitespace-pre-line">
                        {{ $sale->notes }}
                    </div>
                </div>
            @endif

        </div>

    </flux:card>

    {{-- ITEMS --}}
    <flux:card>

        <div class="flex items-center justify-between">

            <flux:heading>
                Daftar Item
            </flux:heading>

            @if ($sale->status === \App\Enums\SaleStatus::Draft)
                <flux:button variant="primary" wire:click="createItem">
                    Tambah Item
                </flux:button>
            @endif

        </div>

        <div class="mt-4">

            <flux:table>

                <flux:table.columns>

                    <flux:table.column>Jenis</flux:table.column>
                    <flux:table.column>Satuan</flux:table.column>
                    <flux:table.column align="end">Kuantitas</flux:table.column>
                    <flux:table.column align="end">Harga Satuan</flux:table.column>
                    <flux:table.column align="end">Subtotal</flux:table.column>

                    @if ($sale->status === \App\Enums\SaleStatus::Draft)
                        <flux:table.column align="end"></flux:table.column>
                    @endif

                </flux:table.columns>

                <flux:table.rows>

                    @forelse ($sale->items as $item)
                        <flux:table.row>

                            <flux:table.cell class="font-medium">
                                {{ $item->wasteType->name }}
                            </flux:table.cell>

                            <flux:table.cell align="end">
                                {{ $item->wasteType->unit->value }}
                            </flux:table.cell>

                            <flux:table.cell align="end">
                                {{ number_format($item->quantity, 3) }}
                            </flux:table.cell>

                            <flux:table.cell align="end">
                                Rp {{ number_format($item->unit_price, 2) }}
                            </flux:table.cell>

                            <flux:table.cell align="end">
                                Rp {{ number_format($item->subtotal, 2) }}
                            </flux:table.cell>

                            @if ($sale->status === \App\Enums\SaleStatus::Draft)
                                <flux:table.cell align="end">

                                    <flux:dropdown>

                                        <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal"
                                            inset="top bottom" />

                                        <flux:menu>

                                            <flux:menu.item wire:click="editItem({{ $item->id }})" icon="pencil">
                                                Edit
                                            </flux:menu.item>

                                            <flux:menu.separator />

                                            <flux:menu.item variant="danger"
                                                wire:click="deleteItem({{ $item->id }})" icon="trash">
                                                Hapus
                                            </flux:menu.item>

                                        </flux:menu>

                                    </flux:dropdown>

                                </flux:table.cell>
                            @endif

                        </flux:table.row>

                    @empty

                        <flux:table.row>

                            <flux:table.cell colspan="{{ $sale->status === \App\Enums\SaleStatus::Draft ? 5 : 4 }}"
                                class="py-10 text-center text-zinc-500">
                                Belum ada item yang ditambah.
                            </flux:table.cell>

                        </flux:table.row>
                    @endforelse

                </flux:table.rows>

            </flux:table>

        </div>

    </flux:card>

    {{-- ITEM MODAL --}}
    <flux:modal wire:model="itemModal" class="w-sm">

        <div class="space-y-6">

            <flux:heading>
                {{ $editingItemId ? 'Edit Item' : 'Tambah Item' }}
            </flux:heading>

            <flux:select wire:model.live.debounce.300="wasteTypeId" label="Jenis">

                <option value="">Pilih jenis sampah</option>

                @foreach ($this->wasteTypes as $wasteType)
                    <option value="{{ $wasteType->id }}">
                        {{ $wasteType->name }}
                    </option>
                @endforeach

            </flux:select>

            <div>
                <flux:text class="font-medium">Stok Tersedia</flux:text>

                <div class="mt-2">
                    <flux:badge color="green">
                        {{ number_format($this->availableStock, 3) }} kg
                    </flux:badge>
                </div>
            </div>

            <flux:field>

                <flux:label>Kuantitas</flux:label>

                <flux:input.group>

                    <flux:input wire:model.live.debounce.300="quantity" type="number" step="0.001" placeholder="0" />

                    <flux:input.group.suffix>kg</flux:input.group.suffix>

                </flux:input.group>

                <flux:error name="quantity" />

            </flux:field>

            <flux:field>

                <flux:label>Harga Satuan</flux:label>

                <flux:input.group>

                    <flux:input.group.prefix>Rp</flux:input.group.prefix>

                    <flux:input wire:model.live="unitPrice" type="number" step="0.01" placeholder="0" />

                </flux:input.group>

                <flux:error name="unitPrice" />

            </flux:field>

            <div>
                <flux:text class="font-medium">Subtotal</flux:text>

                <div class="mt-1 text-lg font-semibold">
                    Rp {{ number_format($this->subtotal, 2) }}
                </div>
            </div>

            <flux:textarea wire:model="notes" label="Catatan" rows="3" />

            <div class="flex justify-end gap-2">

                <flux:button variant="ghost" wire:click="$set('itemModal', false)">
                    Batal
                </flux:button>

                <flux:button variant="primary" wire:click="saveItem">
                    Simpan
                </flux:button>

            </div>

        </div>

    </flux:modal>

    {{-- POST MODAL --}}
    <flux:modal wire:model="postModal" class="w-sm">

        <div class="space-y-6">
            <flux:heading>
                Terbitkan Penjualan
            </flux:heading>

            <flux:text color="red">
                Anda akan menerbitkan penjualan ini.
            </flux:text>

            <flux:callout>

                <flux:text>• Penjualan tidak dapat diubah lagi</flux:text>
                <flux:text>• Alokasi FIFO akan di eksekusi</flux:text>
                <flux:text>• Saldo anggota akan diperbarui</flux:text>
                <flux:text>• Pendapatan bank sampah akan dicatat</flux:text>

            </flux:callout>

            <div class="flex justify-end gap-2">

                <flux:button variant="ghost" wire:click="$set('postModal', false)">
                    Batal
                </flux:button>

                <flux:button variant="primary" wire:click="post">
                    Terbitkan
                </flux:button>

            </div>
        </div>

    </flux:modal>

</div>
