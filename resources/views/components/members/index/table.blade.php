<flux:card>
    <flux:table>

        <flux:table.columns>
            <flux:table.column>Kode</flux:table.column>
            <flux:table.column>Nama</flux:table.column>
            <flux:table.column align="end">Lot Aktif</flux:table.column>
            <flux:table.column align="end">Saldo</flux:table.column>
            <flux:table.column>Status</flux:table.column>
            <flux:table.column></flux:table.column>
        </flux:table.columns>

        <flux:table.rows>

            @forelse($members as $member)
                <flux:table.row>

                    <flux:table.cell>
                        {{ $member->member_code }}
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ $member->name }}
                    </flux:table.cell>

                    <flux:table.cell align="end">
                        {{ $member->lots_count ?? 0 }}
                    </flux:table.cell>

                    <flux:table.cell align="end">
                        Rp {{ number_format($member->balance(), 0, ',', '.') }}
                    </flux:table.cell>

                    <flux:table.cell>

                        @if ($member->is_active)
                            <flux:badge color="green" size="sm">
                                Active
                            </flux:badge>
                        @else
                            <flux:badge color="zinc" size="sm">
                                Inactive
                            </flux:badge>
                        @endif

                    </flux:table.cell>

                    <flux:table.cell align="end">

                        <flux:dropdown>

                            <flux:button variant="ghost" icon="ellipsis-horizontal" />

                            <flux:menu>

                                <flux:menu.item wire:click="$dispatch('member-edit', { id: {{ $member->id }} })">
                                    Edit
                                </flux:menu.item>

                                <flux:menu.item variant="danger"
                                    wire:click="$dispatch('member-delete', { id: {{ $member->id }} })">
                                    Delete
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
                                Tidak ada anggota di temukan.
                            </span>
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @endforelse

        </flux:table.rows>

    </flux:table>

    {{ $members->links() }}

</flux:card>
