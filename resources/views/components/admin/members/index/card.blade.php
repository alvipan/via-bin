<div class="space-y-3">

    @forelse($members as $member)
        <flux:card wiew:key="member-{{ $member->id }}" class="space-y-4">

            {{-- HEADER --}}
            <div class="flex items-start justify-between gap-3">
                <div>
                    <flux:heading class="text-base font-semibold">
                        {{ $member->name }}
                    </flux:heading>

                    <flux:text class="text-xs">
                        Code: {{ $member->member_code }}
                    </flux:text>
                </div>

                {{-- ACTION --}}
                <div class="flex items-center justify-end gap-2">
                    @if ($member->is_active)
                        <flux:badge color="green" size="sm">
                            Active
                        </flux:badge>
                    @else
                        <flux:badge color="zinc" size="sm">
                            Inactive
                        </flux:badge>
                    @endif

                    <flux:dropdown>

                        <flux:button variant="ghost" size="sm" icon="ellipsis-vertical" />

                        <flux:menu>

                            <flux:menu.item wire:click="$dispatch('member-edit', { id: {{ $member->id }} })">
                                Edit
                            </flux:menu.item>

                            <flux:menu.item variant="danger"
                                wire:click="$dispatch('member-delete', { id: {{ $member->id }} })">
                                Delete
                            </flux:menu.item>

                        </flux:menu>

                    </flux:dropdown>
                </div>

            </div>

            {{-- INFO GRID --}}
            <flux:callout>
                <div class="grid grid-cols-2 gap-3 text-sm">

                    <div>
                        <div class="text-xs text-zinc-500">
                            Lot Aktif
                        </div>

                        <div class="font-medium">
                            {{ $member->lots_count ?? 0 }}
                        </div>
                    </div>

                    <div>
                        <div class="text-xs text-zinc-500">
                            Saldo
                        </div>

                        <div class="font-medium">
                            Rp {{ number_format($member->balance(), 0, ',', '.') }}
                        </div>
                    </div>

                </div>
            </flux:callout>

        </flux:card>

    @empty

        <flux:card>
            <div class="py-10 text-center text-sm text-zinc-500">
                Tidak ada anggota ditemukan.
            </div>
        </flux:card>
    @endforelse

</div>

{{-- PAGINATION --}}
<div class="mt-4">
    {{ $members->links() }}
</div>
