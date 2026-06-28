<flux:dropdown>

    <button class="flex w-full items-center justify-between rounded-lg border border-zinc-200 px-3 py-2">
        <div class="text-left">
            <flux:heading>
                {{ tenant()->name }}
            </flux:heading>

            <flux:text>
                {{ membership()->role->label() }}
            </flux:text>
        </div>
        <flux:icon.chevron-down />
    </button>

    <flux:menu>

        @foreach ($memberships as $membership)
            <flux:menu.item wire:click="switch({{ $membership->id }})"
                :icon="$membership->tenant_id === tenant_id() ? 'check' : null">
                <div class="flex flex-col">
                    <span>{{ $membership->tenant->name }}</span>

                    <span class="text-xs text-zinc-500">
                        {{ $membership->role->label() }}
                    </span>
                </div>
            </flux:menu.item>
        @endforeach

    </flux:menu>

</flux:dropdown>
