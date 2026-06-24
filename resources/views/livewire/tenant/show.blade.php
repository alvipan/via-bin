<div class="min-h-screen bg-zinc-50 py-10">
    <div class="mx-auto max-w-6xl space-y-6 px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-zinc-950 dark:text-white">{{ $tenant->name }}</h1>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Slug: {{ $tenant->slug }}</p>
                </div>
                <span class="rounded-full bg-emerald-100 px-3 py-1 text-sm font-semibold text-emerald-700 dark:bg-emerald-900 dark:text-emerald-200">Status: {{ $tenant->status }}</span>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-3">
                <div class="rounded-3xl border border-zinc-200 bg-zinc-50 p-4 dark:border-zinc-800 dark:bg-zinc-900">
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Member Profiles</p>
                    <p class="mt-3 text-3xl font-semibold text-zinc-950 dark:text-white">{{ number_format($memberCount) }}</p>
                </div>
                <div class="rounded-3xl border border-zinc-200 bg-zinc-50 p-4 dark:border-zinc-800 dark:bg-zinc-900">
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Deposits</p>
                    <p class="mt-3 text-3xl font-semibold text-zinc-950 dark:text-white">{{ number_format($depositCount) }}</p>
                </div>
                <div class="rounded-3xl border border-zinc-200 bg-zinc-50 p-4 dark:border-zinc-800 dark:bg-zinc-900">
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Lots</p>
                    <p class="mt-3 text-3xl font-semibold text-zinc-950 dark:text-white">{{ number_format($lotCount) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
