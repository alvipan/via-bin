<div class="min-h-screen bg-zinc-50 py-10">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-950 dark:text-white">Sales</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Riwayat penjualan lot.</p>
            </div>
            <a href="{{ route('sales.create') }}" class="inline-flex items-center rounded-full bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-500">Buat Penjualan</a>
        </div>

        <div class="space-y-4">
            @foreach($sales as $sale)
                <a href="{{ route('sales.show', $sale) }}" class="block rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm transition hover:border-emerald-500 dark:border-zinc-800 dark:bg-zinc-950">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-semibold text-zinc-950 dark:text-white">{{ $sale->reference_number }}</h2>
                            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ $sale->buyer_name }} · {{ $sale->sold_at->format('d M Y') }}</p>
                        </div>
                        <p class="text-xl font-semibold text-emerald-600">Rp {{ number_format($sale->gross_amount, 0, ',', '.') }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
