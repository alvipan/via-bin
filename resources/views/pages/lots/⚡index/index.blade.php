<div class="space-y-6">

    <div class="flex flex-col gap-4 lg:flex-row lg:items-center">

        <div class="flex-1">
            <flux:heading size="xl">
                Lot
            </flux:heading>

            <flux:text>
                Monitor lot hasil setoran yang telah diterbitkan.
            </flux:text>
        </div>

        <div class="flex items-center gap-2">
            <flux:input wire:model.live.debounce.300ms="search" placeholder="Pencarian..." />

            <flux:select wire:model.live="status">

                <option value="">
                    Semua Status
                </option>

                @foreach ($this->statuses as $status)
                    <option value="{{ $status->value }}">
                        {{ $status->label() }}
                    </option>
                @endforeach

            </flux:select>
        </div>

    </div>

    <div class="hidden lg:block">
        @include('components.admin.lots.index.table')
    </div>

    <div class="lg:hidden">
        @include('components.admin.lots.index.card')
    </div>

</div>
