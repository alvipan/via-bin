<div class="flex min-h-screen items-center justify-center">

    <flux:card class="w-full max-w-md space-y-6">

        <flux:heading size="xl">
            Member Login
        </flux:heading>

        <form wire:submit="login" class="space-y-4">

            <flux:input wire:model="tenantCode" label="Tenant Code" placeholder="BS0001" />

            <flux:input wire:model="memberCode" label="Member Code" placeholder="MB000001" />

            <flux:button type="submit" variant="primary" class="w-full">

                Masuk

            </flux:button>

        </form>

    </flux:card>

</div>
