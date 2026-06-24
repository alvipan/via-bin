<div class="min-h-screen bg-zinc-50 py-10">
    <div class="mx-auto max-w-6xl space-y-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between gap-4 rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-950 dark:text-white">Tenant Saya</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Kelola bank sampah dan berpindah tenant.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('tenants.create') }}" class="inline-flex items-center rounded-full bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-500">Buat Tenant</a>
            </div>
        </div>

        <div class="grid gap-4">
            @foreach($tenants as $tenant)
                <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Tenant</p>
                            <h2 class="mt-1 text-xl font-semibold text-zinc-950 dark:text-white">{{ $tenant->name }}</h2>
                        </div>
                        <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold text-zinc-700 dark:border-zinc-700 dark:text-zinc-300">{{ $tenant->pivot->role }}</span>
                    </div>

                    <div class="mt-4 flex flex-wrap items-center gap-3 text-sm text-zinc-500 dark:text-zinc-400">
                        <span>Status: {{ $tenant->status }}</span>
                        <span>Slug: {{ $tenant->slug }}</span>
                        <span class="rounded-full bg-zinc-100 px-2 py-1 dark:bg-zinc-800">{{ $activeTenantId === $tenant->id ? 'Active' : 'Inactive' }}</span>
                    </div>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <form method="POST" action="{{ route('tenants.switch', $tenant) }}">
                            @csrf
                            <button type="submit" class="rounded-full bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-500">Switch Tenant</button>
                        </form>
                        <a href="{{ route('tenants.edit', $tenant) }}" class="rounded-full border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-200">Edit Tenant</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
