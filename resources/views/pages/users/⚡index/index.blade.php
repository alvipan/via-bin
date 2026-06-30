<div class="space-y-6">

    <div class="flex flex-col gap-4 lg:flex-row lg:items-center">
        <div class="flex-1">
            <flux:heading size="xl">Tim</flux:heading>
            <flux:text>
                Kelola anggota tenant dan peran mereka.
            </flux:text>
        </div>

        <div class="flex items-center gap-2">
            <flux:input wire:model.live.debounce.300ms="search" placeholder="Pencarian..." />

            <flux:button variant="primary" icon="plus" wire:click="create">
                Tambah
            </flux:button>
        </div>
    </div>

    {{-- Content --}}
    <div class="hidden md:block">
        @include('components.admin.users.index.table')
    </div>

    <div class="md:hidden">
        @include('components.admin.users.index.card')
    </div>

    {{-- Modal: Create/Edit --}}
    <flux:modal wire:model="showFormModal" class="w-64">

        <div class="space-y-4">

            <flux:heading>
                {{ $userId ? 'Edit Anggota' : 'Tambah Anggota' }}
            </flux:heading>

            <flux:input label="Email" wire:model="email" />

            <flux:select label="Role" wire:model="role">
                <option value="owner">Owner</option>
                <option value="admin">Admin</option>
                <option value="cashier">Cashier</option>
            </flux:select>

            <flux:select label="Status" wire:model="status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="suspended">Suspended</option>
            </flux:select>

            <div class="flex justify-end gap-2">

                <flux:button variant="ghost" wire:klick='$showFormModal = false'>
                    Batal
                </flux:button>

                <flux:button variant="primary" wire:click="save">
                    Simpan
                </flux:button>

            </div>

        </div>

    </flux:modal>

    {{-- Modal: Delete --}}
    <flux:modal wire:model="showDeleteModal">

        <div class="space-y-4">

            <flux:heading>
                Hapus Anggota
            </flux:heading>

            <flux:text>
                Apakah kamu yakin ingin menghapus anggota ini dari tenant?
            </flux:text>

            <div class="flex justify-end gap-2">

                <flux:button variant="ghost" wire:click='$showDeleteModal = false'>
                    Batal
                </flux:button>

                <flux:button variant="danger" wire:click="delete">
                    Hapus
                </flux:button>

            </div>

        </div>

    </flux:modal>

</div>
