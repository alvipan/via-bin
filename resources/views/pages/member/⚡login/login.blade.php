<div class="flex min-h-screen items-center justify-center">

    <flux:card class="w-sm space-y-6">

        <flux:heading size="xl">
            Masuk Member
        </flux:heading>

        <form wire:submit="login" class="space-y-4">

            <flux:input wire:model="tenantCode" label="Kode Bank Sampah" placeholder="BS0001" />

            <flux:input wire:model="memberCode" label="Kode Member" placeholder="MB000001" />

            <flux:button type="submit" variant="primary" class="w-full">
                Masuk
            </flux:button>

        </form>

    </flux:card>

</div>
