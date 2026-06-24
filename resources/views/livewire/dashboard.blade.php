<div class="min-h-screen">
    <header class="border-b border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-950">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('dashboard') }}" wire:navigate class="text-lg font-semibold tracking-normal">
                ViaBin
            </a>

            <nav class="flex items-center gap-2">
                <flux:button href="{{ route('dashboard') }}" wire:navigate variant="ghost" size="sm">
                    Dashboard
                </flux:button>
                <flux:button variant="primary" size="sm">
                    New Deposit
                </flux:button>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-2">
            <p class="text-sm font-medium text-emerald-700 dark:text-emerald-400">Bank sampah multi-tenant</p>
            <h1 class="text-3xl font-semibold tracking-normal text-zinc-950 dark:text-white">ViaBin Dashboard</h1>
        </div>

        <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Members</p>
                <p class="mt-3 text-3xl font-semibold">{{ number_format($memberCount) }}</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Open Lots</p>
                <p class="mt-3 text-3xl font-semibold">{{ number_format($openLotCount) }}</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Deposits</p>
                <p class="mt-3 text-3xl font-semibold">{{ number_format($depositCount) }}</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Sales</p>
                <p class="mt-3 text-3xl font-semibold">{{ number_format($saleCount) }}</p>
            </div>
        </section>
    </main>
</div>
