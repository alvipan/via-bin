<div class="space-y-3">

    @for ($i = 0; $i < 5; $i++)
        <flux:card>

            {{-- HEADER SKELETON --}}
            <div class="flex items-start justify-between gap-3">

                <div class="space-y-2">
                    <div class="h-4 w-32 animate-pulse rounded bg-zinc-200 dark:bg-zinc-700"></div>
                    <div class="h-3 w-20 animate-pulse rounded bg-zinc-200 dark:bg-zinc-700"></div>
                </div>

                <div class="h-8 w-8 animate-pulse rounded bg-zinc-200 dark:bg-zinc-700"></div>

            </div>

            {{-- GRID SKELETON --}}
            <div class="mt-4 grid grid-cols-2 gap-3">

                <div class="space-y-2">
                    <div class="h-3 w-16 animate-pulse rounded bg-zinc-200 dark:bg-zinc-700"></div>
                    <div class="h-4 w-10 animate-pulse rounded bg-zinc-200 dark:bg-zinc-700"></div>
                </div>

                <div class="space-y-2">
                    <div class="h-3 w-16 animate-pulse rounded bg-zinc-200 dark:bg-zinc-700"></div>
                    <div class="h-4 w-16 animate-pulse rounded rounded bg-zinc-200 dark:bg-zinc-700"></div>
                </div>

            </div>

            {{-- STATUS SKELETON --}}
            <div class="mt-4 flex items-center justify-between">

                <div class="h-5 w-16 animate-pulse rounded-full bg-zinc-200 dark:bg-zinc-700"></div>

                <div class="h-3 w-10 animate-pulse rounded bg-zinc-200 dark:bg-zinc-700"></div>

            </div>

        </flux:card>
    @endfor

</div>
