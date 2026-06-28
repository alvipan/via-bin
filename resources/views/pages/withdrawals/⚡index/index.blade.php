<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>
            <flux:heading size="xl">
                Pencairan
            </flux:heading>

            <flux:text>
                Kelola pencairan dana anggota.
            </flux:text>
        </div>

        <flux:button icon="plus" variant="primary" wire:click="create">
            Tambah
        </flux:button>

    </div>

    <flux:card>

        <flux:table>

            <flux:table.columns>

                <flux:table.column>No. Pencairan</flux:table.column>

                <flux:table.column>Tanggal</flux:table.column>

                <flux:table.column>Anggota</flux:table.column>

                <flux:table.column align="end">
                    Jumlah
                </flux:table.column>

                <flux:table.column>Status</flux:table.column>

                <flux:table.column></flux:table.column>

            </flux:table.columns>

            <flux:table.rows>

                @forelse($withdrawals as $withdrawal)
                    <flux:table.row>

                        <flux:table.cell>
                            {{ $withdrawal->withdrawal_no }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $withdrawal->date->format('d M Y') }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $withdrawal->member->name }}
                        </flux:table.cell>

                        <flux:table.cell align="end">
                            {{ number_format($withdrawal->amount, 2) }}
                        </flux:table.cell>

                        <flux:table.cell>

                            <flux:badge color="{{ $withdrawal->status->color() }}">
                                {{ $withdrawal->status->label() }}
                            </flux:badge>

                        </flux:table.cell>

                        <flux:table.cell align="end">

                            <flux:button size="sm" variant="ghost" :href="route('withdrawals.show', $withdrawal)"
                                wire:navigate>
                                Detail
                            </flux:button>

                        </flux:table.cell>

                    </flux:table.row>

                @empty

                    <flux:table.row>

                        <flux:table.cell colspan="6">

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

    {{ $withdrawals->links() }}

    <flux:modal class="w-sm" wire:model="showModal">

        <div class="space-y-6">

            <flux:heading>
                Pencairan Dana
            </flux:heading>

            <flux:field>
                <flux:label>Kode Anggota</flux:label>

                <flux:input.group>
                    <flux:input wire:model="memberCode" />

                    <flux:button wire:click="checkMember">
                        Cek
                    </flux:button>
                </flux:input.group>

                <flux:error name="memberCode" />
            </flux:field>

            @if ($member)
                <flux:card>

                    <div class="space-y-3">

                        <div>

                            <flux:text>
                                Nama
                            </flux:text>

                            <flux:heading size="lg">
                                {{ $member->name }}
                            </flux:heading>

                        </div>

                        <div>

                            <flux:text>
                                Saldo
                            </flux:text>

                            <flux:heading size="lg">
                                Rp {{ number_format($balance, 2) }}
                            </flux:heading>

                        </div>

                    </div>

                </flux:card>
            @endif

            <flux:input wire:model="amount" type="number" step="0.01" label="Amount" />

            <flux:textarea wire:model="notes" label="Catatan" />

            <div class="flex justify-end gap-2">

                <flux:button variant="ghost" wire:click="$set('showModal', false)">
                    Batal
                </flux:button>

                <flux:button variant="primary" wire:click="store">
                    Simpan
                </flux:button>

            </div>

        </div>

    </flux:modal>

</div>
