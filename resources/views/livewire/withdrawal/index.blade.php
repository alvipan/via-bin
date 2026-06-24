<div class="min-h-screen bg-zinc-50 py-10">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-950 dark:text-white">Withdrawals</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Permintaan penarikan saldo member.</p>
            </div>
        </div>

        <div class="space-y-4">
            @foreach($withdrawals as $withdrawal)
                <a href="{{ route('withdrawals.show', $withdrawal) }}" class="block rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm transition hover:border-emerald-500 dark:border-zinc-800 dark:bg-zinc-950">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-semibold text-zinc-950 dark:text-white">{{ $withdrawal->reference_number }}</h2>
                            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ $withdrawal->memberProfile->member_number ?? 'Member' }} · {{ ucfirst($withdrawal->status) }}</p>
                        </div>
                        <p class="text-xl font-semibold text-rose-600">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>