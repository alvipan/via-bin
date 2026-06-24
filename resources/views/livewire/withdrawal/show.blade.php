<div class="min-h-screen bg-zinc-50 py-10">
    <div class="mx-auto max-w-4xl rounded-3xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
        <div class="mb-6 flex items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-950 dark:text-white">Withdrawal {{ $withdrawal->reference_number }}</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Status: {{ ucfirst($withdrawal->status) }}</p>
            </div>
            <a href="{{ route('withdrawals.index') }}" class="inline-flex items-center rounded-full border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-200">Kembali</a>
        </div>

        <div class="grid gap-4 rounded-3xl border border-zinc-200 bg-zinc-50 p-6 dark:border-zinc-800 dark:bg-zinc-900">
            <div>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Member</p>
                <p class="mt-2 text-lg font-semibold text-zinc-950 dark:text-white">{{ $withdrawal->memberProfile->member_number ?? 'Member' }}</p>
            </div>
            <div>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Amount</p>
                <p class="mt-2 text-lg font-semibold text-rose-600">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Approved By</p>
                <p class="mt-2 text-lg font-semibold text-zinc-950 dark:text-white">{{ $withdrawal->approver?->name ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Note</p>
                <p class="mt-2 text-zinc-700 dark:text-zinc-300">{{ $withdrawal->status === 'pending' ? 'Menunggu persetujuan' : 'Diproses' }}</p>
            </div>
        </div>

        @if($withdrawal->status === 'pending')
            <form method="POST" action="{{ route('withdrawals.approve', $withdrawal) }}" class="mt-6">
                @csrf
                <button type="submit" class="inline-flex items-center rounded-full bg-emerald-600 px-6 py-3 text-sm font-semibold text-white hover:bg-emerald-500">Approve Withdrawal</button>
            </form>
        @endif
    </div>
</div>