<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>
            <flux:heading size="xl">
                Penarikan
            </flux:heading>

            <flux:text>
                Kelola pencairan dana anggota.
            </flux:text>
        </div>

        <flux:button icon="plus" variant="primary" wire:click="create">
            Tambah
        </flux:button>

    </div>

    <div class="hidden md:block">
        @include('components.admin.withdrawals.index.table')
    </div>

    <div class="md:hidden">
        @include('components.admin.withdrawals.index.card')
    </div>

    <flux:modal class="w-sm" wire:model="showModal" class="w-64">

        <div class="space-y-4">

            <flux:heading>
                Penarikan Dana
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
