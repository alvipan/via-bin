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

    <div class="hidden md:block">
        @include('components.admin.wastes.index.table')
    </div>

    <div class="md:hidden">
        @include('components.admin.wastes.index.card')
    </div>

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
