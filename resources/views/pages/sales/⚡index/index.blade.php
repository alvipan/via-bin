<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>
            <flux:heading size="xl">
                Penjualan
            </flux:heading>

            <flux:text>
                Kelola penjualan sampah.
            </flux:text>
        </div>

        <flux:button icon="plus" variant="primary" wire:click="create">
            Tambah
        </flux:button>

    </div>

    <div class="hidden lg:block">
        @include('components.admin.sales.index.table')
    </div>

    <div class="lg:hidden">
        @include('components.admin.sales.index.card')
    </div>

</div>
