<div class="space-y-6">

    <div class="flex flex-col gap-4 lg:flex-row lg:items-center">
        <div class="flex-1">
            <flux:heading size="xl">
                Setoran
            </flux:heading>

            <flux:text>
                Kelola setoran sampah.
            </flux:text>
        </div>

        <div class="flex items-center gap-2">
            <flux:input wire:model.live.debounce.300ms="search" placeholder="Pencarian..." />

            <flux:button variant="primary" icon="plus" wire:click="create">
                Tambah
            </flux:button>
        </div>
    </div>

    <div class="hidden lg:block">
        @include('components.admin.deposits.index.table')
    </div>

    <div class="lg:hidden">
        @include('components.admin.deposits.index.card')
    </div>

    <flux:modal wire:model="createModal" class="w-64">

        <div class="space-y-4">

            <flux:heading>
                Tambah Setoran
            </flux:heading>

            <flux:select wire:model="memberId" label="Member">
                <option value="">
                    Pilih Anggota
                </option>

                @foreach ($members as $member)
                    <option value="{{ $member->id }}">
                        {{ $member->member_code }}
                        -
                        {{ $member->name }}
                    </option>
                @endforeach
            </flux:select>

            <flux:textarea wire:model="notes" label="Catatan" />

            <div class="flex justify-end gap-2">

                <flux:modal.close>
                    <flux:button variant="ghost">
                        Batal
                    </flux:button>
                </flux:modal.close>

                <flux:button variant="primary" wire:click="store">
                    Simpan
                </flux:button>

            </div>

        </div>

    </flux:modal>

</div>
