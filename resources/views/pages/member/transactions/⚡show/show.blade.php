<div class="space-y-6">

    <!-- Header Section & Tombol Kembali -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <flux:heading size="xl" class="font-extrabold tracking-tight">
                Detail Transaksi
            </flux:heading>
            <flux:text class="text-xs text-zinc-500 dark:text-zinc-400">
                Rincian mutasi saldo dan informasi sumber transaksi.
            </flux:text>
        </div>

        <div>
            <flux:button variant="outline" icon="printer" size="sm" onclick="window.print()">
                Cetak Bukti
            </flux:button>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

        <!-- BAGIAN KIRI: Rincian Mutasi Saldo (Buku Besar) -->
        <div class="space-y-4 md:col-span-1">
            <flux:card class="space-y-4">
                <div>
                    <flux:heading size="md" class="font-bold">
                        Informasi Mutasi
                    </flux:heading>
                    <flux:separator class="mt-3" />
                </div>

                <div class="space-y-3">
                    <div>
                        <flux:text class="text-xs text-zinc-500">Waktu Mutasi</flux:text>
                        <flux:heading>
                            {{ $ledger->created_at->format('d M Y, H:i') }}
                        </flux:heading>
                    </div>

                    <div>
                        <flux:text class="text-xs text-zinc-500">Keterangan</flux:text>
                        <flux:heading>
                            {{ $ledger->description ?? '-' }}
                        </flux:heading>
                    </div>

                    <div>
                        <flux:text class="text-xs text-zinc-500">Tipe Transaksi</flux:text>
                        <div class="mt-1">
                            <flux:badge size="sm" color="zinc">
                                {{ method_exists($ledger->type, 'label') ? $ledger->type->label() : $ledger->type?->value ?? $ledger->type }}
                            </flux:badge>
                        </div>
                    </div>

                    <flux:separator />

                    <div class="flex items-center justify-between">
                        <flux:text class="text-sm text-zinc-500">Nominal Mutasi</flux:text>
                        <flux:heading
                            class="{{ $ledger->isCredit() ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }} text-lg font-bold">
                            {{ $ledger->isCredit() ? '+' : '-' }}{{ Number::currency($ledger->amount(), 'IDR') }}
                        </flux:heading>
                    </div>

                    <div class="flex items-center justify-between">
                        <flux:text class="text-sm text-zinc-500">Saldo Akhir</flux:text>
                        <flux:heading class="font-medium text-zinc-800 dark:text-zinc-200">
                            {{ Number::currency($ledger->balance, 'IDR') }}
                        </flux:heading>
                    </div>
                </div>
            </flux:card>
        </div>

        <!-- BAGIAN KANAN: Detail Referensi (Sale / Withdrawal) -->
        <div class="space-y-4 md:col-span-2">
            <flux:card class="space-y-4">
                <div>
                    <flux:heading size="md" class="font-bold">
                        Rincian Sumber Transaksi
                    </flux:heading>
                    <flux:separator class="mt-3" />
                </div>

                <div>
                    @if ($ledger->reference)

                        {{-- 1. RINCIAN PENJUALAN (SALE) --}}
                        @if ($ledger->reference instanceof \App\Models\Sale)
                            <div class="space-y-6">
                                <!-- Ringkasan Header Penjualan -->
                                <div
                                    class="grid grid-cols-2 gap-4 rounded-lg border border-zinc-200/60 bg-zinc-50 p-4 sm:grid-cols-4 dark:border-zinc-800 dark:bg-zinc-800/40">
                                    <div>
                                        <flux:text class="text-xs text-zinc-500">No. Penjualan</flux:text>
                                        <flux:heading class="font-mono !font-bold">
                                            {{ $ledger->reference->sale_no }}
                                        </flux:heading>
                                    </div>
                                    <div>
                                        <flux:text class="text-xs text-zinc-500">Tanggal Transaksi</flux:text>
                                        <flux:heading>
                                            {{ $ledger->reference->sale_date?->format('d M Y') ?? '-' }}
                                        </flux:heading>
                                    </div>
                                    <div>
                                        <flux:text class="text-xs text-zinc-500">Status</flux:text>
                                        <flux:badge size="sm"
                                            :color="$ledger->reference->isPosted() ? 'emerald' : 'amber'">
                                            {{ method_exists($ledger->reference->status, 'label') ? $ledger->reference->status->label() : $ledger->reference->status?->value ?? $ledger->reference->status }}
                                        </flux:badge>
                                    </div>
                                    <div>
                                        <flux:text class="text-xs text-zinc-500">Catatan</flux:text>
                                        <flux:text class="truncate font-medium text-zinc-900 dark:text-white">
                                            {{ $ledger->reference->notes ?? '-' }}
                                        </flux:text>
                                    </div>
                                </div>

                                <!-- Detail Item Penjualan (SaleItems) -->
                                <div class="space-y-3">
                                    <flux:heading size="sm" class="font-semibold text-zinc-700 dark:text-zinc-300">
                                        Item Sampah Diterima
                                    </flux:heading>

                                    <!-- Tampilan Mobile: Cards -->
                                    <div class="grid gap-2.5 md:hidden">
                                        @forelse ($ledger->reference->items as $item)
                                            <div
                                                class="space-y-2.5 rounded-xl border border-zinc-200/80 bg-zinc-50/70 p-3.5 dark:border-zinc-800 dark:bg-zinc-800/40">
                                                <div class="flex items-start justify-between gap-2">
                                                    <div>
                                                        <p class="text-sm font-semibold text-zinc-900 dark:text-white">
                                                            {{ $item->wasteType?->name ?? 'Sampah #' . $item->waste_type_id }}
                                                        </p>
                                                        @if ($item->notes)
                                                            <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">
                                                                {{ $item->notes }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <span
                                                        class="whitespace-nowrap font-mono text-sm font-bold text-zinc-900 dark:text-white">
                                                        {{ Number::currency($item->subtotal, 'IDR') }}
                                                    </span>
                                                </div>

                                                <flux:separator />

                                                <div
                                                    class="flex items-center justify-between text-xs text-zinc-500 dark:text-zinc-400">
                                                    <span>Kuantitas: <strong
                                                            class="font-mono text-zinc-700 dark:text-zinc-200">{{ number_format($item->quantity, 2) }}</strong></span>
                                                    <span>Harga Satuan: <strong
                                                            class="font-mono text-zinc-700 dark:text-zinc-200">{{ Number::currency($item->unit_price, 'IDR') }}</strong></span>
                                                </div>
                                            </div>
                                        @empty
                                            <div
                                                class="rounded-xl border border-dashed border-zinc-200 py-6 text-center dark:border-zinc-800">
                                                <flux:text class="text-xs text-zinc-400">Tidak ada item rincian.
                                                </flux:text>
                                            </div>
                                        @endforelse
                                    </div>

                                    <!-- Tampilan Desktop: Flux Table -->
                                    <flux:card class="hidden px-4 py-2 md:block">
                                        <flux:table>
                                            <flux:table.columns>
                                                <flux:table.column>Jenis Sampah</flux:table.column>
                                                <flux:table.column align="end">Berat / Qty</flux:table.column>
                                                <flux:table.column align="end">Harga Satuan</flux:table.column>
                                                <flux:table.column align="end">Subtotal</flux:table.column>
                                            </flux:table.columns>

                                            <flux:table.rows>
                                                @forelse ($ledger->reference->items as $item)
                                                    <flux:table.row>
                                                        <flux:table.cell
                                                            class="font-medium text-zinc-900 dark:text-white">
                                                            {{ $item->wasteType?->name ?? 'Sampah #' . $item->waste_type_id }}
                                                            @if ($item->notes)
                                                                <span
                                                                    class="block text-xs font-normal text-zinc-400">{{ $item->notes }}</span>
                                                            @endif
                                                        </flux:table.cell>

                                                        <flux:table.cell align="end" class="text-xs">
                                                            {{ number_format($item->quantity, 2) }}
                                                        </flux:table.cell>

                                                        <flux:table.cell align="end" class="text-xs">
                                                            {{ Number::currency($item->unit_price, 'IDR') }}
                                                        </flux:table.cell>

                                                        <flux:table.cell align="end"
                                                            class="font-semibold text-zinc-900 dark:text-white">
                                                            {{ Number::currency($item->subtotal, 'IDR') }}
                                                        </flux:table.cell>
                                                    </flux:table.row>
                                                @empty
                                                    <flux:table.row>
                                                        <flux:table.cell colspan="4"
                                                            class="py-4 text-center text-zinc-400">
                                                            Tidak ada item rincian.
                                                        </flux:table.cell>
                                                    </flux:table.row>
                                                @endforelse
                                            </flux:table.rows>
                                        </flux:table>
                                    </flux:card>
                                </div>

                                <!-- Kalkulasi Keuangan Penjualan -->
                                <div class="space-y-2">
                                    <flux:separator />

                                    <div class="flex items-center justify-between text-sm text-zinc-500">
                                        <flux:text>Total Bruto (Gross Amount)</flux:text>
                                        <flux:text class="font-medium text-zinc-800 dark:text-zinc-200">
                                            {{ Number::currency($ledger->reference->gross_amount, 'IDR') }}
                                        </flux:text>
                                    </div>

                                    @if ($ledger->reference->operational_amount > 0)
                                        <div class="flex items-center justify-between text-sm text-zinc-500">
                                            <flux:text>Biaya Operasional
                                                ({{ number_format($ledger->reference->operational_percent, 1) }}%)
                                            </flux:text>
                                            <flux:text class="font-medium text-rose-600 dark:text-rose-400">
                                                -{{ Number::currency($ledger->reference->operational_amount, 'IDR') }}
                                            </flux:text>
                                        </div>
                                    @endif

                                    <flux:separator />

                                    <div class="flex items-center justify-between">
                                        <flux:heading class="font-bold">Total Bersih (Net Amount)</flux:heading>
                                        <flux:text class="font-bold text-emerald-600 dark:text-emerald-400">
                                            {{ Number::currency($ledger->reference->net_amount, 'IDR') }}
                                            </flux:te>
                                    </div>
                                </div>
                            </div>

                            {{-- 2. RINCIAN PENARIKAN (WITHDRAWAL) --}}
                        @elseif ($ledger->reference instanceof \App\Models\Withdrawal)
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <flux:text class="text-xs text-zinc-500">No. Penarikan</flux:text>
                                    <flux:heading>
                                        {{ $ledger->reference->withdrawal_no ?? '-' }}
                                    </flux:heading>
                                </div>
                                <div>
                                    <flux:text class="text-xs text-zinc-500">Status</flux:text>
                                    <div class="mt-0.5">
                                        <flux:badge size="sm" color="zinc">
                                            {{ method_exists($ledger->reference->status, 'label') ? $ledger->reference->status->label() : $ledger->reference->status?->value ?? 'Selesai' }}
                                        </flux:badge>
                                    </div>
                                </div>
                            </div>

                            {{-- 3. TIPE REFERENSI LAIN --}}
                        @else
                            <flux:text class="text-zinc-600 dark:text-zinc-400">
                                Sumber data tercatat sebagai:
                                <strong>{{ class_basename($ledger->reference_type) }}</strong>
                            </flux:text>
                        @endif
                    @else
                        <!-- JIKA MANUAL ADJUSTMENT / TANPA REFERENCE -->
                        <div class="py-12 text-center">
                            <flux:text class="text-zinc-500 dark:text-zinc-400">
                                Transaksi ini merupakan mutasi langsung / penyesuaian saldo manual tanpa dokumen
                                pendukung.
                            </flux:text>
                        </div>
                    @endif
                </div>
            </flux:card>
        </div>

    </div>
</div>
