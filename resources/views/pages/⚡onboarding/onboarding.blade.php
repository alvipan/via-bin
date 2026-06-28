<flux:card class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold">
            Buat Bank Sampah
        </h1>

        <p class="mt-1 text-sm text-zinc-500">
            Buat bank sampah pertama anda untuk mulai menggunakan ViaBin.
        </p>
    </div>

    <form wire:submit="createTenant" class="space-y-6">
        <div>
            <flux:input wire:model="name" label="Nama" placeholder="Contoh: Bank Sampah Maju Bersama" />

            @error('name')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="flex justify-end">
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                <span wire:loading.remove>
                    Buat
                </span>

                <span wire:loading>
                    Membuat...
                </span>
            </flux:button>
        </div>
    </form>
</flux:card>
