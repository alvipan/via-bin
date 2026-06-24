<div class="min-h-screen bg-zinc-50 py-10">
    <div class="mx-auto max-w-3xl rounded-3xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
        <h1 class="text-2xl font-semibold text-zinc-950 dark:text-white">Approve Withdrawal</h1>
        <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">Konfirmasi penarikan dana untuk member.</p>

        <div class="mt-8 rounded-3xl border border-zinc-200 bg-zinc-50 p-6 dark:border-zinc-800 dark:bg-zinc-900">
            <p class="text-sm text-zinc-500 dark:text-zinc-400">Reference</p>
            <p class="mt-2 text-lg font-semibold text-zinc-950 dark:text-white">{{ $withdrawal->reference_number }}</p>

            <p class="mt-4 text-sm text-zinc-500 dark:text-zinc-400">Amount</p>
            <p class="mt-2 text-lg font-semibold text-rose-600">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</p>
        </div>

        <div class="mt-6 flex justify-end">
            <button wire:click="approve" class="inline-flex items-center rounded-full bg-emerald-600 px-6 py-3 text-sm font-semibold text-white hover:bg-emerald-500">Approve</button>
        </div>
    </div>
</div>