<div
    class="relative flex min-h-screen items-center justify-center overflow-hidden bg-zinc-50 px-4 py-8 dark:bg-zinc-950">
    <!-- Background Glow & Pattern Dekoratif -->
    <div class="absolute -right-40 -top-40 size-96 rounded-full bg-emerald-400/20 blur-3xl dark:bg-emerald-600/10"></div>
    <div class="absolute -bottom-40 -left-40 size-96 rounded-full bg-teal-400/20 blur-3xl dark:bg-teal-600/10"></div>

    <div class="relative w-full max-w-md">
        <!-- Bagian Header Logo & Judul -->
        <div class="mb-8 text-center">
            <div class="mb-4 flex justify-center">
                <div
                    class="relative flex size-16 items-center justify-center rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-400 text-white shadow-lg shadow-emerald-500/30 ring-4 ring-emerald-500/20 transition-transform duration-300 hover:scale-105">
                    <flux:icon.sparkles class="size-8" />
                </div>
            </div>

            <flux:heading size="xl" class="font-bold tracking-tight text-zinc-900 dark:text-white">
                Selamat datang di ViaBin
            </flux:heading>

            <flux:text class="mt-2 text-zinc-500 dark:text-zinc-400">
                Pilih jenis akun untuk melanjutkan aktivitasmu
            </flux:text>
        </div>

        <!-- Kartu Pilihan Login -->
        <div class="space-y-4">
            <!-- Pilihan 1: Pengelola -->
            <flux:card
                class="group relative overflow-hidden border border-zinc-200/80 p-0 transition-all duration-300 hover:-translate-y-1 hover:border-emerald-500/50 hover:shadow-xl hover:shadow-emerald-500/10 dark:border-zinc-800 dark:bg-zinc-900/80 dark:hover:border-emerald-500/50">
                <a href="{{ route('auth.redirect') }}" class="flex items-center gap-4 p-5">
                    <div
                        class="flex size-12 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600 transition-colors duration-300 group-hover:bg-emerald-500 group-hover:text-white dark:bg-emerald-950/60 dark:text-emerald-400 dark:group-hover:bg-emerald-500 dark:group-hover:text-white">
                        <flux:icon.building-office-2 class="size-6" />
                    </div>

                    <div class="min-w-0 flex-1">
                        <flux:heading size="sm"
                            class="font-semibold text-zinc-900 group-hover:text-emerald-600 dark:text-white dark:group-hover:text-emerald-400">
                            Login sebagai Pengelola
                        </flux:heading>

                        <flux:text size="sm" class="mt-0.5 text-zinc-500 dark:text-zinc-400">
                            Kelola bank sampah dan data anggota
                        </flux:text>
                    </div>

                    <div
                        class="flex size-8 shrink-0 items-center justify-center rounded-full bg-zinc-100 text-zinc-400 transition-all duration-300 group-hover:translate-x-1 group-hover:bg-emerald-50 group-hover:text-emerald-600 dark:bg-zinc-800 dark:text-zinc-500 dark:group-hover:bg-emerald-950/50 dark:group-hover:text-emerald-400">
                        <flux:icon.chevron-right class="size-4" />
                    </div>
                </a>
            </flux:card>

            <!-- Pilihan 2: Anggota -->
            <flux:card
                class="group relative overflow-hidden border border-zinc-200/80 p-0 transition-all duration-300 hover:-translate-y-1 hover:border-emerald-500/50 hover:shadow-xl hover:shadow-emerald-500/10 dark:border-zinc-800 dark:bg-zinc-900/80 dark:hover:border-emerald-500/50">
                <a href="{{ route('member.login') }}" class="flex items-center gap-4 p-5">
                    <div
                        class="flex size-12 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600 transition-colors duration-300 group-hover:bg-emerald-500 group-hover:text-white dark:bg-emerald-950/60 dark:text-emerald-400 dark:group-hover:bg-emerald-500 dark:group-hover:text-white">
                        <flux:icon.user class="size-6" />
                    </div>

                    <div class="min-w-0 flex-1">
                        <flux:heading size="sm"
                            class="font-semibold text-zinc-900 group-hover:text-emerald-600 dark:text-white dark:group-hover:text-emerald-400">
                            Login sebagai Anggota
                        </flux:heading>

                        <flux:text size="sm" class="mt-0.5 text-zinc-500 dark:text-zinc-400">
                            Lihat saldo dan riwayat tabungan sampah
                        </flux:text>
                    </div>

                    <div
                        class="flex size-8 shrink-0 items-center justify-center rounded-full bg-zinc-100 text-zinc-400 transition-all duration-300 group-hover:translate-x-1 group-hover:bg-emerald-50 group-hover:text-emerald-600 dark:bg-zinc-800 dark:text-zinc-500 dark:group-hover:bg-emerald-950/50 dark:group-hover:text-emerald-400">
                        <flux:icon.chevron-right class="size-4" />
                    </div>
                </a>
            </flux:card>
        </div>

        <!-- Footer Copyright -->
        <flux:text size="xs" class="mt-8 text-center text-zinc-400 dark:text-zinc-600">
            &copy; {{ date('Y') }} ViaBin. All rights reserved.
        </flux:text>
    </div>
</div>
