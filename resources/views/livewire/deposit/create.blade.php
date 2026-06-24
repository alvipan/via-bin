<div class="min-h-screen bg-zinc-50 py-10">
    <div class="mx-auto max-w-3xl rounded-3xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
        <div class="mb-6 flex items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-950 dark:text-white">Buat Deposit</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Form setoran sampah anggota.</p>
            </div>
            <a href="{{ route('deposits.index') }}" class="inline-flex items-center rounded-full border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-200">Kembali</a>
        </div>

        <form wire:submit.prevent="submit" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Member</label>
                <select wire:model.defer="member_profile_id" class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-4 py-3 text-zinc-950 shadow-sm focus:border-emerald-500 focus:outline-none">
                    <option value="">Pilih member</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}">{{ $member->member_number }} - {{ $member->address }}</option>
                    @endforeach
                </select>
                @error('member_profile_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Kategori Sampah</label>
                <select wire:model.defer="waste_category_id" class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-4 py-3 text-zinc-950 shadow-sm focus:border-emerald-500 focus:outline-none">
                    <option value="">Pilih kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }} (Rp {{ number_format($cat->default_price,0,',','.') }})</option>
                    @endforeach
                </select>
                @error('waste_category_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <label class="block">
                    <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Jumlah (kg)</span>
                    <input wire:model.defer="quantity" type="number" step="0.001" class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-4 py-3 text-zinc-950 shadow-sm focus:border-emerald-500 focus:outline-none" />
                    @error('quantity') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
                <label class="block">
                    <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Harga per Unit</span>
                    <input wire:model.defer="unit_price" type="number" step="0.01" class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-4 py-3 text-zinc-950 shadow-sm focus:border-emerald-500 focus:outline-none" />
                    @error('unit_price') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="rounded-full bg-emerald-600 px-6 py-3 text-sm font-semibold text-white hover:bg-emerald-500">Simpan Deposit</button>
            </div>
        </form>
    </div>
</div>