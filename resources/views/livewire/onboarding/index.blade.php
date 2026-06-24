<div class="min-h-screen bg-zinc-50 py-12">
    <div class="mx-auto max-w-2xl rounded-3xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
        <h1 class="text-2xl font-semibold text-zinc-950 dark:text-white">Welcome to ViaBin</h1>
        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">Buat tenant pertama untuk mulai mengelola bank sampah.</p>

        <form wire:submit.prevent="createTenant" class="mt-8 space-y-6">
            <div>
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Nama Tenant</label>
                <input wire:model.defer="name" type="text" class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-4 py-3 text-zinc-950 shadow-sm focus:border-emerald-500 focus:outline-none" />
                @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Slug Tenant</label>
                <input wire:model.defer="slug" type="text" class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-4 py-3 text-zinc-950 shadow-sm focus:border-emerald-500 focus:outline-none" />
                @error('slug') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center rounded-full bg-emerald-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-emerald-500">Buat Tenant</button>
            </div>
        </form>
    </div>
</div>
