<div class="space-y-6">

    <div class="flex flex-col gap-2 lg:flex-row lg:items-center">
        <div class="flex-1">
            <flux:heading size="xl">Anggota</flux:heading>
            <flux:text>
                Kelola data anggota.
            </flux:text>
        </div>

        <div class="flex items-center gap-2">
            <flux:input wire:model.live.debounce.300ms="search" placeholder="Pencarian..." />

            <flux:button variant="primary" icon="plus" wire:click="create">
                Tambah
            </flux:button>
        </div>
    </div>

    <div class="hidden md:block">
        @include('components.admin.members.index.table')
    </div>

    <div class="md:hidden">
        @include('components.admin.members.index.card')
    </div>

    <flux:modal name="member-form" class="w-64">

        <div class="space-y-4">

            <flux:heading>
                {{ $memberId ? 'Edit Anggota' : 'Tambah Anggota' }}
            </flux:heading>

            <flux:input label="Nama" wire:model="name" />

            <flux:input label="No HP" wire:model="phone" />

            <flux:textarea label="Alamat" wire:model="address" />

            <flux:select label="Status" wire:model="is_active">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </flux:select>

            <div class="flex justify-end gap-2">

                <flux:button variant="ghost" x-on:click="$flux.modal('member-form').close()">
                    Cancel
                </flux:button>

                <flux:button variant="primary" wire:click="save">
                    Save
                </flux:button>

            </div>

        </div>

    </flux:modal>

    <flux:modal name="delete-member" class="w-64">

        <div class="space-y-4">

            <flux:heading>
                Delete Member
            </flux:heading>

            <flux:text>
                Are you sure you want to delete this member?
            </flux:text>

            <div class="flex justify-end gap-2">

                <flux:button variant="ghost" x-on:click="$flux.modal('delete-member').close()">
                    Cancel
                </flux:button>

                <flux:button variant="danger" wire:click="delete">
                    Delete
                </flux:button>

            </div>

        </div>

    </flux:modal>

</div>
