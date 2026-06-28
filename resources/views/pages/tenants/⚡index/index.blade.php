<div class="space-y-6">
    <flux:card>
        <flux:heading size="xl">
            Pilih Tenant
        </flux:heading>

        <flux:text class="mt-2">
            Pilih tenant yang ingin Anda kelola.
        </flux:text>

        <div class="mt-6 space-y-4">

            @foreach ($memberships as $membership)
                <flux:card>

                    <div class="flex items-center justify-between">

                        <div>
                            <flux:heading>
                                {{ $membership->tenant->name }}
                            </flux:heading>

                            <flux:text>
                                {{ $membership->role->label() }}
                            </flux:text>
                        </div>

                        <flux:button wire:click="select({{ $membership->id }})" variant="primary">

                            Masuk

                        </flux:button>

                    </div>

                </flux:card>
            @endforeach

        </div>
    </flux:card>
</div>
