<div class="space-y-6">

    <div>
        <flux:heading size="xl">
            Pengaturan Bank Sampah
        </flux:heading>

        <flux:text class="mt-2">
            Pengaturan bank sampah dan operasional.
        </flux:text>
    </div>

    <flux:card class="max-w-xl">

        <div class="space-y-6">

            <flux:input wire:model="operationalFeePercent" type="number" step="0.01" min="0" max="100"
                label="Biaya Operasional (%)" />

            <div class="flex justify-end">
                <flux:button variant="primary" wire:click="save">
                    Simpan
                </flux:button>
            </div>

        </div>

    </flux:card>

</div>
