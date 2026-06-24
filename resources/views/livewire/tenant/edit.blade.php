<div class="min-h-screen bg-zinc-50 py-10">
    <div class="mx-auto max-w-3xl rounded-3xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
        <h1 class="text-2xl font-semibold text-zinc-950 dark:text-white">Edit Tenant</h1>
        <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">Perbarui nama dan status tenant.</p>

        <form wire:submit.prevent="submit" class="mt-8 space-y-6">
            <div>
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Nama Tenant</label>
                <input wire:model.defer="name" type="text" class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-4 py-3 text-zinc-950 shadow-sm focus:border-emerald-500 focus:outline-none" />
                @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Status</label>
                <select wire:model.defer="status" class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-4 py-3 text-zinc-950 shadow-sm focus:border-emerald-500 focus:outline-none">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                @error('status') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('tenants.index') }}" class="inline-flex items-center rounded-full border border-zinc-200 px-6 py-3 text-sm font-semibold text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-200">Kembali</a>
                <button type="submit" class="inline-flex items-center rounded-full bg-emerald-600 px-6 py-3 text-sm font-semibold text-white hover:bg-emerald-500">Simpan</button>
            </div>
        </form>
    </div>
</div>
