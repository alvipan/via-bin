<div class="space-y-6">

    <div class="flex flex-col gap-2 lg:flex-row lg:items-center">
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

    <flux:card>
        <flux:table>
            <flux:table.columns>
                <flux:table.column>
                    No. Setoran
                </flux:table.column>

                <flux:table.column>
                    Penyetor
                </flux:table.column>

                <flux:table.column>
                    Status
                </flux:table.column>

                <flux:table.column>
                    Dibuat
                </flux:table.column>

                <flux:table.column />
            </flux:table.columns>

            <flux:table.rows>

                @forelse ($deposits as $deposit)
                    <flux:table.row>

                        <flux:table.cell>
                            {{ $deposit->deposit_no }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $deposit->member->name }}
                        </flux:table.cell>

                        <flux:table.cell>
                            <flux:badge size="sm" :color="$deposit->status->color()">
                                {{ $deposit->status->label() }}
                            </flux:badge>
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $deposit->created_at->format('d M Y H:i') }}
                        </flux:table.cell>

                        <flux:table.cell align="end">

                            <flux:button size="sm" variant="ghost"
                                :href="route('deposits.show', $deposit->deposit_no)" wire:navigate>
                                Detail
                            </flux:button>

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

        {{ $deposits->links() }}

    </flux:card>

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
