<div class="min-h-screen bg-zinc-50 py-10">
    <div class="mx-auto max-w-4xl rounded-3xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
        <div class="mb-6 flex items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-950 dark:text-white">Deposit {{ $deposit->reference_number }}</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Member: {{ $deposit->memberProfile->member_number ?? 'Member' }}</p>
            </div>
            <a href="{{ route('deposits.index') }}" class="inline-flex items-center rounded-full border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-200">Kembali</a>
        </div>

        <div class="grid gap-4 rounded-3xl border border-zinc-200 bg-zinc-50 p-6 dark:border-zinc-800 dark:bg-zinc-900">
            <div>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Tanggal</p>
                <p class="mt-2 text-lg font-semibold text-zinc-950 dark:text-white">{{ $deposit->deposited_at->format('d M Y H:i') }}</p>
            </div>
            <div>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Kategori</p>
                <p class="mt-2 text-lg font-semibold text-zinc-950 dark:text-white">{{ $deposit->wasteCategory->name }}</p>
            </div>
            <div>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Quantity</p>
                <p class="mt-2 text-lg font-semibold text-zinc-950 dark:text-white">{{ number_format($deposit->quantity, 3) }}</p>
            </div>
            <div>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Subtotal</p>
                <p class="mt-2 text-lg font-semibold text-emerald-600">Rp {{ number_format($deposit->subtotal, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Lot</p>
                <p class="mt-2 text-lg font-semibold text-zinc-950 dark:text-white">{{ $deposit->lot->lot_number ?? '-' }} (sisa {{ number_format($deposit->lot->remaining_quantity ?? 0,3) }})</p>
            </div>
        </div>
    </div>
</div>