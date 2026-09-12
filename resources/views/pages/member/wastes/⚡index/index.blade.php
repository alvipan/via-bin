<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <flux:heading size="xl" class="font-extrabold tracking-tight">
                Daftar Harga Sampah
            </flux:heading>
            <flux:text class="mt-0.5 text-zinc-500 dark:text-zinc-400">
                Referensi estimasi harga jual sampah di Bank Sampah.
            </flux:text>
        </div>
    </div>

    <!-- Informasi/Pesan Penjelasan Harga -->
    <flux:callout variant="subtle" color="cyan" icon="information-circle">
        <flux:callout.heading>Informasi Harga & Estimasi</flux:callout.heading>
        <flux:callout.text>
            Harga yang tertera di bawah ini adalah <strong>nilai estimasi awal</strong> saat penyetoran.
            <strong>Harga aktual</strong> yang masuk ke saldo Anda akan disesuaikan kembali berdasarkan harga riil
            saat sampah tersebut berhasil diproses dan <strong>terjual</strong> ke pengepul.
        </flux:callout.text>
    </flux:callout>

    <!-- Tabel Daftar Harga -->
    <flux:card class="overflow-hidden p-0">
        <flux:table>
            <flux:table.columns>
                <flux:table.column sortable class="!pl-6">Jenis Sampah</flux:table.column>
                <flux:table.column sortable>Satuan</flux:table.column>
                <flux:table.column sortable align="end" class="!pr-6">Estimasi Harga</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @forelse ($wasteTypes as $waste)
                    <flux:table.row class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/30">
                        <flux:table.cell class="!pl-6 font-medium text-zinc-900 dark:text-white">
                            {{ $waste->name }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $waste->unit->label() ?? $waste->unit }}
                        </flux:table.cell>

                        <flux:table.cell align="end"
                            class="!pr-6 font-bold !text-emerald-600 dark:!text-emerald-400">
                            {{ Number::currency($waste->estimated_price, 'IDR') }}
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="3" class="py-12 text-center">
                            <flux:text class="text-zinc-500 dark:text-zinc-400">
                                Belum ada daftar harga sampah yang tersedia saat ini.
                            </flux:text>
                        </flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>
    </flux:card>

</div>
