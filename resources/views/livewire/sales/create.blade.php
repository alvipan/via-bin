<div class="min-h-screen bg-zinc-50 py-10">
    <div class="mx-auto max-w-4xl rounded-3xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
        <div class="mb-6 flex items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-950 dark:text-white">Buat Penjualan</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Pilih lot dan tentukan jumlah untuk dijual.</p>
            </div>
            <a href="{{ route('sales.index') }}" class="inline-flex items-center rounded-full border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-200">Kembali</a>
        </div>

        <form wire:submit.prevent="submit" class="space-y-6">
            <div class="grid gap-4 sm:grid-cols-2">
                <label class="block">
                    <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Nama Pembeli</span>
                    <input wire:model.defer="buyer_name" class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-4 py-3 text-zinc-950 shadow-sm focus:border-emerald-500 focus:outline-none" />
                    @error('buyer_name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
                <label class="block">
                    <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Harga per Unit</span>
                    <input wire:model.defer="unit_price" type="number" step="0.01" class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-4 py-3 text-zinc-950 shadow-sm focus:border-emerald-500 focus:outline-none" />
                    @error('unit_price') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
            </div>

            <div class="rounded-3xl border border-zinc-200 bg-zinc-50 p-4 dark:border-zinc-800 dark:bg-zinc-900">
                <h2 class="text-base font-semibold text-zinc-950 dark:text-white">Lot Tersedia</h2>
                <div class="mt-4 space-y-4">
                    @foreach($lots as $lot)
                        <div class="grid gap-3 rounded-3xl border border-zinc-200 bg-white p-4 sm:grid-cols-4 dark:border-zinc-800 dark:bg-zinc-950">
                            <div>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">Lot</p>
                                <p class="font-semibold text-zinc-950 dark:text-white">{{ $lot->lot_number }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">Sisa</p>
                                <p class="font-semibold text-zinc-950 dark:text-white">{{ number_format($lot->remaining_quantity, 3) }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Jumlah</label>
                                <input wire:model.defer="allocations.{{ $lot->id }}.quantity" type="number" step="0.001" min="0" class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-4 py-3 text-zinc-950 shadow-sm focus:border-emerald-500 focus:outline-none" />
                            </div>
                            <div class="flex items-end justify-end">
                                <button type="button" wire:click="addAllocation({{ $lot->id }})" class="rounded-full bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-500">Pilih</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="rounded-full bg-emerald-600 px-6 py-3 text-sm font-semibold text-white hover:bg-emerald-500">Simpan Penjualan</button>
            </div>
        </form>
    </div>
</div>
