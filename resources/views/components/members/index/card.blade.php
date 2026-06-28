<div class="space-y-3">

    @forelse($members as $member)
        <flux:card>

            {{-- HEADER --}}
            <div class="flex items-start justify-between gap-3">

                <div>
                    <div class="text-base font-semibold">
                        {{ $member->name }}
                    </div>

                    <div class="text-xs text-zinc-500">
                        {{ $member->member_code }}
                    </div>
                </div>

                {{-- ACTION --}}
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

            {{-- INFO GRID --}}
            <div class="mt-4 grid grid-cols-2 gap-3 text-sm">

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

            {{-- STATUS --}}
            <div class="mt-4 flex items-center justify-between">

                @if ($member->is_active)
                    <flux:badge color="green" size="sm">
                        Active
                    </flux:badge>
                @else
                    <flux:badge color="zinc" size="sm">
                        Inactive
                    </flux:badge>
                @endif

                <div class="text-xs text-zinc-400">
                    ID: {{ $member->id }}
                </div>

            </div>

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
