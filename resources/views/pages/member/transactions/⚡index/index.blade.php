<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <flux:heading size="xl" class="font-extrabold tracking-tight">
                Riwayat Transaksi & Saldo
            </flux:heading>

            <flux:text class="mt-0.5 text-zinc-500 dark:text-zinc-400">
                Pantau mutasi kredit, debit, dan sisa saldo akun Anda.
            </flux:text>
        </div>
    </div>

    <!-- Filter Controls -->
    <flux:card class="flex gap-1 p-1">
        <div class="max-sm:flex-1">
            <flux:input wire:model.live="search" placeholder="Cari transaksi..." icon="magnifying-glass" />
        </div>

        <flux:select class="w-full sm:w-48" wire:model.live="type">
            <flux:select.option value="">Semua Tipe</flux:select.option>
            @foreach (\App\Enums\MemberLedgerType::cases() as $ledgerType)
                <flux:select.option value="{{ $ledgerType->value }}">
                    {{ method_exists($ledgerType, 'label') ? $ledgerType->label() : $ledgerType->name }}
                </flux:select.option>
            @endforeach
        </flux:select>
    </flux:card>

    <!-- 1. MOBILE VIEW: Card List -->
    <div class="grid gap-3 md:hidden">
        @forelse ($ledgers as $ledger)
            <flux:card class="space-y-3 border border-zinc-200/80 p-4 shadow-sm dark:border-zinc-800">

                <div class="flex items-center justify-between border-b border-zinc-100 pb-2.5 dark:border-zinc-800/60">
                    <flux:badge size="sm" :color="$ledger->isCredit() ? 'emerald' : 'rose'">
                        {{ $ledger->isCredit() ? 'Kredit (+)' : 'Debit (-)' }}
                    </flux:badge>
                    <span class="text-xs text-zinc-400">
                        {{ $ledger->created_at->format('d M Y, H:i') }}
                    </span>
                </div>

                <div class="space-y-1">
                    <!-- Link ke Detail Transaksi -->
                    <a href="{{ route('member.transactions.show', $ledger->id) }}" wire:navigate
                        class="block text-sm font-medium text-zinc-900 transition-colors hover:text-blue-600 hover:underline dark:text-white dark:hover:text-blue-400">
                        {{ $ledger->description ?? 'Mutasi Saldo' }}
                    </a>

                    @if ($ledger->type)
                        <flux:text class="font-mono text-xs text-zinc-500">
                            Tipe:
                            {{ method_exists($ledger->type, 'label') ? $ledger->type->label() : $ledger->type->value }}
                        </flux:text>
                    @endif
                </div>

                <div class="space-y-1 border-t border-zinc-100 pt-2 dark:border-zinc-800/60">
                    <div class="flex items-center justify-between">
                        <flux:text class="text-xs text-zinc-500">Nominal</flux:text>
                        <span
                            class="{{ $ledger->isCredit() ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }} text-sm font-bold">
                            {{ $ledger->isCredit() ? '+' : '-' }}{{ Number::currency($ledger->amount(), 'IDR') }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <flux:text class="text-zinc-400">Sisa Saldo</flux:text>
                        <span class="font-mono text-zinc-700 dark:text-zinc-300">
                            {{ Number::currency($ledger->balance, 'IDR') }}
                        </span>
                    </div>
                </div>

            </flux:card>
        @empty
            <flux:card class="border border-dashed border-zinc-300 py-8 text-center dark:border-zinc-700">
                <flux:text class="text-zinc-500 dark:text-zinc-400">
                    Belum ada riwayat mutasi saldo ditemukan.
                </flux:text>
            </flux:card>
        @endforelse
    </div>

    <!-- 2. DESKTOP VIEW: Flux Table -->
    <div class="hidden md:block">
        <flux:card class="overflow-hidden border border-zinc-200/80 py-2.5 shadow-sm dark:border-zinc-800">
            <flux:table>
                <flux:table.columns>
                    <flux:table.column class="pl-6">Tanggal</flux:table.column>
                    <flux:table.column>Tipe</flux:table.column>
                    <flux:table.column>Keterangan</flux:table.column>
                    <flux:table.column align="end">Mutasi</flux:table.column>
                    <flux:table.column align="end" class="pr-6">Saldo Akhir</flux:table.column>
                    <flux:table.column align="end" class="pr-6">Aksi</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @forelse ($ledgers as $ledger)
                        <flux:table.row class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/30">

                            <flux:table.cell class="whitespace-nowrap pl-6 text-xs text-zinc-500 dark:text-zinc-400">
                                {{ $ledger->created_at->format('d M Y, H:i') }}
                            </flux:table.cell>

                            <flux:table.cell>
                                <flux:badge size="sm" color="zinc">
                                    {{ method_exists($ledger->type, 'label') ? $ledger->type->label() : $ledger->type?->value }}
                                </flux:badge>
                            </flux:table.cell>

                            <flux:table.cell class="font-medium text-zinc-900 dark:text-white">
                                <!-- Link ke Detail Transaksi -->
                                {{ $ledger->description ?? '-' }}
                            </flux:table.cell>

                            <flux:table.cell align="end">
                                <flux:text
                                    class="{{ $ledger->isCredit() ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }} whitespace-nowrap font-bold">
                                    {{ $ledger->isCredit() ? '+' : '-' }}{{ Number::currency($ledger->amount(), 'IDR') }}
                                </flux:text>
                            </flux:table.cell>

                            <flux:table.cell align="end">
                                <flux:text class="whitespace-nowrap font-medium">
                                    {{ Number::currency($ledger->balance, 'IDR') }}
                                </flux:text>
                            </flux:table.cell>

                            <flux:table.cell align="end" class="pr-6">
                                <flux:button :href="route('member.transactions.show', $ledger)" wire:navigate
                                    variant="subtle" size="sm">
                                    Detail
                                </flux:button>
                            </flux:table.cell>

                        </flux:table.row>
                    @empty
                        <flux:table.row>
                            <flux:table.cell colspan="5" class="py-12 text-center">
                                <flux:text class="text-zinc-500 dark:text-zinc-400">
                                    Belum ada riwayat mutasi saldo ditemukan.
                                </flux:text>
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse
                </flux:table.rows>
            </flux:table>

            <!-- Pagination -->
            @if ($ledgers->hasPages())
                <div class="border-t border-zinc-200/80 p-4 dark:border-zinc-800">
                    {{ $ledgers->links() }}
                </div>
            @endif
        </flux:card>
    </div>

</div>
