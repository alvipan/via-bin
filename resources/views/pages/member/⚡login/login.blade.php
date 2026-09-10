<div
    class="relative flex min-h-screen items-center justify-center overflow-hidden bg-zinc-50 px-4 py-8 dark:bg-zinc-950">
    <!-- Background Glow & Pattern Dekoratif -->
    <div class="absolute -right-40 -top-40 size-96 rounded-full bg-emerald-400/20 blur-3xl dark:bg-emerald-600/15"></div>
    <div class="absolute -bottom-40 -left-40 size-96 rounded-full bg-teal-400/20 blur-3xl dark:bg-teal-600/15"></div>

    <div class="relative w-full max-w-md">
        <!-- Header / Logo Kecil di Atas Card -->
        <div class="mb-6 text-center">
            <div
                class="inline-flex size-16 items-center justify-center rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-400 text-white shadow-lg shadow-emerald-500/30 ring-4 ring-emerald-500/20">
                <flux:icon.user class="size-7" />
            </div>
        </div>

        <!-- Main Card Form -->
        <flux:card
            class="border border-zinc-200/80 p-8 shadow-xl shadow-zinc-950/5 dark:border-zinc-800 dark:bg-zinc-900/90 dark:shadow-black/40">
            <div class="mb-6 text-center">
                <flux:heading size="xl" class="font-bold tracking-tight text-zinc-900 dark:text-white">
                    Masuk Member
                </flux:heading>
                <flux:text class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                    Masukkan kode bank sampah dan kode member Anda
                </flux:text>
            </div>

            <form wire:submit="login" class="space-y-5">
                <flux:input wire:model="tenantCode" label="Kode Bank Sampah" placeholder="Contoh: BS001"
                    icon="building-office" />

                <flux:input wire:model="memberCode" label="Kode Member" placeholder="Contoh: MB001"
                    icon="identification" />

                <div class="pt-2">
                    <flux:button type="submit" variant="primary"
                        class="w-full py-3 font-medium transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/25">
                        Masuk ke Akun
                    </flux:button>
                </div>
            </form>
        </flux:card>

        <!-- Tombol Kembali atau Bantuan Kecil di Bawah -->
        <div class="mt-6 text-center">
            <a href="/login"
                class="inline-flex items-center gap-2 text-xs font-medium text-zinc-500 transition-colors hover:text-emerald-600 dark:text-zinc-400 dark:hover:text-emerald-400">
                <flux:icon.arrow-left class="size-4" />
                Kembali ke halaman sebelumnya
            </a>
        </div>
    </div>
</div>
