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
                                    Hapus
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
