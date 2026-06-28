<div class="space-y-6">

    <div class="flex flex-col gap-2 lg:flex-row lg:items-center">
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

    {{-- Table --}}
    <flux:card>

        <flux:table>

            <flux:table.columns>
                <flux:table.column>Nama</flux:table.column>
                <flux:table.column>Email</flux:table.column>
                <flux:table.column>Role</flux:table.column>
                <flux:table.column>Status</flux:table.column>
                <flux:table.column></flux:table.column>
            </flux:table.columns>

            <flux:table.rows>

                @forelse ($users as $member)
                    <flux:table.row wire:key="user-{{ $member->id }}">

                        <flux:table.cell>
                            {{ $member->user->name }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $member->user->email }}
                        </flux:table.cell>

                        <flux:table.cell>
                            <flux:badge :color="$member->role->color()">
                                {{ $member->role->label() }}
                            </flux:badge>
                        </flux:table.cell>

                        <flux:table.cell>
                            <flux:badge :color="$member->status->color()">
                                {{ $member->status->label() }}
                            </flux:badge>
                        </flux:table.cell>

                        <flux:table.cell align="end">

                            <flux:dropdown>

                                <flux:button variant="ghost" icon="ellipsis-horizontal" />

                                <flux:menu>

                                    <flux:menu.item wire:click="edit({{ $member->id }})">
                                        Edit
                                    </flux:menu.item>

                                    <flux:menu.item variant="danger" wire:click="confirmDelete({{ $member->id }})">
                                        Remove
                                    </flux:menu.item>

                                </flux:menu>

                            </flux:dropdown>

                        </flux:table.cell>

                    </flux:table.row>

                @empty

                    <flux:table.row>
                        <flux:table.cell colspan="5">
                            <div class="py-10 text-center">
                                <span class="font-medium">
                                    Tidak ada anggota ditemukan.
                                </span>
                            </div>
                        </flux:table.cell>
                    </flux:table.row>
                @endforelse

            </flux:table.rows>

        </flux:table>

        <div class="mt-4">
            {{ $users->links() }}
        </div>

    </flux:card>

    {{-- Modal: Create/Edit --}}
    <flux:modal wire:model="showFormModal" class="w-sm">

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
