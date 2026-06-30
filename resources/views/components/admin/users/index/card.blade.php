<div>
    <!-- Grid Wrapper: 1 kolom di mobile, 2 di tablet, 3 di desktop -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($users as $member)
            <flux:card wire:key="user-{{ $member->id }}" class="flex flex-col justify-between space-y-4">

                <!-- Header Card: Info Utama & Dropdown Menu -->
                <div class="flex items-center justify-between">
                    <div class="min-w-0 flex-1">
                        <!-- Nama Pengguna -->
                        <flux:heading>
                            {{ $member->user->name }}
                        </flux:heading>

                        <flux:text size="sm">
                            {{ $member->user->email }}
                        </flux:text>
                    </div>

                    <!-- Dropdown Menu Aksi -->
                    <div class="flex justify-end gap-2">
                        <flux:badge size="sm" :color="$member->role->color()">
                            {{ $member->role->label() }}
                        </flux:badge>

                        <flux:badge size="sm" :color="$member->status->color()">
                            {{ $member->status->label() }}
                        </flux:badge>

                        <flux:dropdown>
                            <flux:button variant="ghost" size="sm" icon="ellipsis-vertical" />
                            <flux:menu>
                                <flux:menu.item wire:click="edit({{ $member->id }})">
                                    Edit
                                </flux:menu.item>
                                <flux:menu.item variant="danger" wire:click="confirmDelete({{ $member->id }})">
                                    Hapus
                                </flux:menu.item>
                            </flux:menu>
                        </flux:dropdown>
                    </div>
                </div>

            </flux:card>
        @empty
            <!-- State ketika data kosong -->
            <div class="col-span-full">
                <flux:card class="py-12 text-center">
                    <span class="font-medium text-zinc-500 dark:text-zinc-400">
                        Tidak ada anggota ditemukan.
                    </span>
                </flux:card>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
