<div class="space-y-6">

    <div>
        <flux:heading size="xl">
            Tenant Settings
        </flux:heading>

        <flux:text class="mt-2">
            Configure tenant operational settings.
        </flux:text>
    </div>

    <flux:card class="max-w-xl">

        <div class="space-y-6">

            <flux:input wire:model="operationalFeePercent" type="number" step="0.01" min="0" max="100"
                label="Operational Fee (%)" />

            <div class="flex justify-end">
                <flux:button variant="primary" wire:click="save">
                    Save
                </flux:button>
            </div>

        </div>

    </flux:card>

</div>
