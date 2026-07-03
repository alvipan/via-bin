<div class="space-y-6">

    <div class="flex flex-col gap-4 lg:flex-row lg:items-center">
        <div class="flex-1">
            <flux:heading size="xl">Kas Bank Sampah</flux:heading>
            <flux:text>
                Kelola data kas bank sampah.
            </flux:text>
        </div>

        <div class="flex items-center gap-2">
            <flux:button icon="plus" variant="primary" wire:click="$set('expenseModal', true)">
                Pengeluaran
            </flux:button>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-4">

        <flux:card>
            <div class="text-sm text-zinc-500">
                Saldo Kas
            </div>

            <div class="mt-2 text-2xl font-bold">
                {{ money($this->balance) }}
            </div>
        </flux:card>

        <flux:card>
            <div class="text-sm text-zinc-500">
                Pendapatan
            </div>

            <div class="mt-2 text-2xl font-bold text-green-600">
                {{ money($this->totalCredit) }}
            </div>
        </flux:card>

        <flux:card>
            <div class="text-sm text-zinc-500">
                Pengeluaran
            </div>

            <div class="mt-2 text-2xl font-bold text-red-600">
                {{ money($this->totalDebit) }}
            </div>
        </flux:card>

        <flux:card>
            <div class="text-sm text-zinc-500">
                Transaksi
            </div>

            <div class="mt-2 text-2xl font-bold">
                {{ $this->totalTransaction }}
            </div>
        </flux:card>

    </div>

    <flux:card>

        <div class="grid gap-4 md:grid-cols-4">

            <flux:input wire:model.live.debounce.300ms="search" label="Cari" placeholder="Keterangan..." />

            <flux:select wire:model.live="type" label="Jenis">
                <option value="">Semua</option>

                @foreach ($types as $type)
                    <option value="{{ $type->value }}">
                        {{ $type->label() }}
                    </option>
                @endforeach
            </flux:select>

            <flux:input type="date" wire:model.live="startDate" label="Dari" />

            <flux:input type="date" wire:model.live="endDate" label="Sampai" />

        </div>

    </flux:card>

    <flux:card>

        <flux:table>

            <flux:table.columns>

                <flux:table.column>Tanggal</flux:table.column>
                <flux:table.column>Jenis</flux:table.column>
                <flux:table.column>Keterangan</flux:table.column>
                <flux:table.column align="end">Masuk</flux:table.column>
                <flux:table.column align="end">Keluar</flux:table.column>
                <flux:table.column align="end">Saldo</flux:table.column>

            </flux:table.columns>

            <flux:table.rows>

                @forelse($this->ledgers as $ledger)
                    <flux:table.row>

                        <flux:table.cell>
                            {{ $ledger->created_at->format('d M Y H:i') }}
                        </flux:table.cell>

                        <flux:table.cell>

                            <flux:badge size="sm" color="{{ $ledger->type->color() }}">
                                {{ $ledger->type->label() }}
                            </flux:badge>

                        </flux:table.cell>

                        <flux:table.cell>

                            {{ $ledger->description }}

                        </flux:table.cell>

                        <flux:table.cell align="end">

                            @if ($ledger->credit)
                                {{ money($ledger->credit) }}
                            @endif

                        </flux:table.cell>

                        <flux:table.cell align="end">

                            @if ($ledger->debit)
                                {{ money($ledger->debit) }}
                            @endif

                        </flux:table.cell>

                        <flux:table.cell align="end">

                            {{ money($ledger->balance) }}

                        </flux:table.cell>

                    </flux:table.row>

                @empty

                    <flux:table.row>

                        <flux:table.cell colspan="6">

                            Belum ada transaksi.

                        </flux:table.cell>

                    </flux:table.row>
                @endforelse

            </flux:table.rows>

        </flux:table>

        <div class="mt-4">

            {{ $this->ledgers->links() }}

        </div>

    </flux:card>

    <flux:modal wire:model="expenseModal">
        <div class="space-y-4">

            <flux:input wire:model="amount" type="number" label="Nominal" />

            <flux:textarea wire:model="description" label="Keterangan" />

            <div class="flex justify-end">
                <flux:button variant="primary" wire:click="expense">
                    Simpan
                </flux:button>
            </div>

        </div>
    </flux:modal>

</div>
