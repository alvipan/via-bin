<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Judul Dinamis dengan Default Fallback -->
        <title>{{ $title ?? config('app.name', 'ViaBin') . ' - Platform Digital Bank Sampah' }}</title>

        <!-- Stack untuk Meta Tags SEO Dinamis -->
        @stack('meta')

        <link rel="icon" type="image/png" href="/favicon.png" />

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>

    <body class="bg-zinc-50 text-zinc-900">

        <header
            class="sticky top-0 z-50 border-b border-zinc-200/70 bg-white/80 backdrop-blur dark:border-zinc-800 dark:bg-zinc-950/80">

            <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-6">

                <flux:brand logo="/icon.svg" :name="config('app.name', 'ViaBin')" />

                <nav class="hidden items-center gap-8 text-sm md:flex">

                    <a href="#features" class="transition hover:text-teal-600">
                        Fitur
                    </a>

                    <a href="#workflow" class="transition hover:text-teal-600">
                        Cara Kerja
                    </a>

                    <a href="#pricing" class="transition hover:text-teal-600">
                        Paket
                    </a>

                </nav>

                <div class="flex items-center gap-3">

                    @auth

                        <flux:button href="{{ route('dashboard') }}" variant="primary">

                            Dashboard

                        </flux:button>
                    @else
                        <flux:button href="{{ route('login') }}" variant="ghost">

                            Masuk

                        </flux:button>

                        <flux:button href="{{ route('register') }}" variant="primary">

                            Mulai Gratis

                        </flux:button>

                    @endauth

                </div>

            </div>

        </header>

        <section class="relative overflow-x-hidden">

            {{-- Background --}}
            <div class="pointer-events-none absolute inset-0 overflow-hidden">

                <div
                    class="absolute -left-40 -top-40 h-80 w-80 rounded-full bg-teal-500/10 blur-3xl sm:h-[32rem] sm:w-[32rem]">
                </div>

                <div
                    class="absolute -bottom-40 -right-40 h-72 w-72 rounded-full bg-lime-400/10 blur-3xl sm:h-[30rem] sm:w-[30rem]">
                </div>

            </div>

            <div class="relative mx-auto max-w-7xl px-5 py-14 sm:px-6 sm:py-20 lg:py-32">

                <div class="grid items-center gap-14 lg:grid-cols-2 lg:gap-20">

                    {{-- ================================================= --}}
                    {{-- LEFT --}}
                    {{-- ================================================= --}}

                    <div class="max-w-xl">

                        <div
                            class="inline-flex items-center gap-2 rounded-full border border-teal-200 bg-teal-50 px-4 py-2 text-sm font-medium text-teal-700 dark:border-teal-500/20 dark:bg-teal-500/10 dark:text-teal-300">

                            <flux:icon.sparkles class="size-4" />

                            Solusi Modern untuk Bank Sampah

                        </div>

                        <h1 class="mt-6 text-4xl font-black leading-tight tracking-tight sm:text-5xl lg:mt-8 lg:text-7xl">

                            Ubah Sampah

                            <span class="text-teal-600">

                                Menjadi Nilai.

                            </span>

                        </h1>

                        <p class="mt-6 text-base leading-7 text-zinc-600 sm:text-lg sm:leading-8 dark:text-zinc-400">

                            ViaBin membantu Bank Sampah mengelola anggota,
                            transaksi setoran, tabungan, investasi,
                            hingga pembagian keuntungan dalam satu platform
                            yang mudah digunakan.

                        </p>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row">

                            @guest

                                <flux:button
                                    class="w-full sm:w-auto"
                                    href="{{ route('register') }}"
                                    variant="primary">

                                    Mulai Sekarang

                                </flux:button>

                            @else

                                <flux:button
                                    class="w-full sm:w-auto"
                                    href="{{ route('dashboard') }}"
                                    variant="primary">

                                    Buka Dashboard

                                </flux:button>

                            @endguest

                            <flux:button
                                class="w-full sm:w-auto"
                                href="#features"
                                variant="ghost">

                                Pelajari Lebih Lanjut

                            </flux:button>

                        </div>

                        <div class="mt-10 grid grid-cols-3 gap-6 text-center sm:text-left">

                            <div>

                                <div class="text-2xl font-bold sm:text-3xl">

                                    100%

                                </div>

                                <div class="mt-1 text-sm text-zinc-500">

                                    Digital

                                </div>

                            </div>

                            <div>

                                <div class="text-2xl font-bold sm:text-3xl">

                                    6+

                                </div>

                                <div class="mt-1 text-sm text-zinc-500">

                                    Modul

                                </div>

                            </div>

                            <div>

                                <div class="text-2xl font-bold sm:text-3xl">

                                    Real-time

                                </div>

                                <div class="mt-1 text-sm text-zinc-500">

                                    Laporan

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- ================================================= --}}
                    {{-- RIGHT --}}
                    {{-- ================================================= --}}

                    <div class="relative mx-auto w-full max-w-md lg:max-w-xl">

                        {{-- Floating Card --}}
                        <div
                            class="absolute -left-8 top-10 hidden rounded-2xl border border-teal-200 bg-white px-5 py-4 shadow-xl lg:block dark:border-zinc-800 dark:bg-zinc-900">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-teal-100 text-teal-600">

                                    <flux:icon.arrow-down-tray class="size-5"/>

                                </div>

                                <div>

                                    <div class="text-sm font-semibold">

                                        Setoran Berhasil

                                    </div>

                                    <div class="text-xs text-zinc-500">

                                        +18 Kg Plastik

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div
                            class="absolute -right-8 bottom-16 hidden rounded-2xl border border-teal-200 bg-white px-5 py-4 shadow-xl lg:block dark:border-zinc-800 dark:bg-zinc-900">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-teal-100 text-teal-600">

                                    <flux:icon.banknotes class="size-5"/>

                                </div>

                                <div>

                                    <div class="text-sm font-semibold">

                                        Saldo Bertambah

                                    </div>

                                    <div class="text-xs text-zinc-500">

                                        +Rp45.000

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- Dashboard --}}
                        <div
                            class="overflow-hidden rounded-[28px] border border-zinc-200 bg-white shadow-2xl dark:border-zinc-800 dark:bg-zinc-900">

                            <div class="border-b border-zinc-200 px-5 py-5 sm:px-8 sm:py-6 dark:border-zinc-800">

                                <div class="flex items-center justify-between">

                                    <div>

                                        <div class="font-bold">

                                            Dashboard ViaBin

                                        </div>

                                        <div class="text-sm text-zinc-500">

                                            Ringkasan Hari Ini

                                        </div>

                                    </div>

                                    <div
                                        class="rounded-full bg-teal-100 px-3 py-1 text-xs font-medium text-teal-700 dark:bg-teal-500/10 dark:text-teal-300">

                                        Aktif

                                    </div>

                                </div>

                            </div>

                            <div class="space-y-5 p-5 sm:space-y-6 sm:p-8">

                                <div class="rounded-2xl bg-teal-600 p-5 text-white sm:p-6">

                                    <div class="text-sm opacity-80">

                                        Total Saldo Bank Sampah

                                    </div>

                                    <div class="mt-3 break-words text-3xl font-black sm:text-4xl">

                                        Rp28.450.000

                                    </div>

                                </div>

                                <div class="grid grid-cols-2 gap-3 sm:gap-4">

                                    <div class="rounded-2xl border border-zinc-200 p-4 sm:p-5 dark:border-zinc-800">

                                        <flux:icon.scale class="mb-3 size-6 text-teal-600"/>

                                        <div class="text-xl font-bold sm:text-2xl">

                                            128 Kg

                                        </div>

                                        <div class="text-sm text-zinc-500">

                                            Sampah Hari Ini

                                        </div>

                                    </div>

                                    <div class="rounded-2xl border border-zinc-200 p-4 sm:p-5 dark:border-zinc-800">

                                        <flux:icon.users class="mb-3 size-6 text-teal-600"/>

                                        <div class="text-xl font-bold sm:text-2xl">

                                            37

                                        </div>

                                        <div class="text-sm text-zinc-500">

                                            Transaksi

                                        </div>

                                    </div>

                                </div>

                                <div
                                    class="rounded-2xl border border-dashed border-teal-300 bg-teal-50 p-4 sm:p-5 dark:border-teal-500/20 dark:bg-teal-500/10">

                                    <div class="flex items-start gap-3">

                                        <flux:icon.check-circle class="mt-0.5 size-6 shrink-0 text-teal-600"/>

                                        <div>

                                            <div class="font-semibold">

                                                Semua transaksi telah tersimpan.

                                            </div>

                                            <div class="mt-1 text-sm text-zinc-500">

                                                Data diperbarui secara otomatis.

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        {{-- ========================================================= --}}
        {{-- Mengapa Memilih ViaBin --}}
        {{-- ========================================================= --}}

        <section id="features" class="py-16 sm:py-20 lg:py-28">

            <div class="mx-auto max-w-7xl px-5 sm:px-6">

                <div class="mx-auto max-w-2xl text-center">

                    <span
                        class="inline-flex rounded-full bg-teal-100 px-4 py-2 text-sm font-medium text-teal-700 dark:bg-teal-500/10 dark:text-teal-300">

                        Mengapa ViaBin?

                    </span>

                    <h2 class="mt-5 text-3xl font-black leading-tight tracking-tight sm:text-4xl lg:text-5xl">

                        Semua Operasional Bank Sampah
                        Dalam Satu Platform.

                    </h2>

                    <p class="mt-5 text-base leading-7 text-zinc-600 sm:text-lg sm:leading-8 dark:text-zinc-400">

                        Tidak perlu lagi berpindah aplikasi atau melakukan pencatatan manual.
                        ViaBin membantu seluruh operasional menjadi lebih cepat, rapi, dan transparan.

                    </p>

                </div>

                <div class="mt-12 grid gap-5 sm:gap-6 md:grid-cols-2 xl:grid-cols-3">

                    <div
                        class="group rounded-3xl border border-zinc-200 bg-white p-8 transition duration-300 hover:-translate-y-2 hover:border-teal-500 hover:shadow-2xl dark:border-zinc-800 dark:bg-zinc-900">

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-teal-100 text-teal-600">

                            <flux:icon.users class="size-6" />

                        </div>

                        <h3 class="mt-8 text-xl font-bold">

                            Kelola Anggota

                        </h3>

                        <p class="mt-4 leading-7 text-zinc-600 dark:text-zinc-400">

                            Simpan data anggota dengan rapi, cari lebih cepat,
                            dan pantau aktivitas setiap anggota kapan saja.

                        </p>

                    </div>

                    <div
                        class="group rounded-3xl border border-zinc-200 bg-white p-8 transition duration-300 hover:-translate-y-2 hover:border-teal-500 hover:shadow-2xl dark:border-zinc-800 dark:bg-zinc-900">

                            <div
                                class="flex h-14 w-14 items-center justify-center rounded-2xl bg-teal-100 text-teal-600">

                            <flux:icon.scale class="size-6" />

                        </div>

                        <h3 class="mt-8 text-xl font-bold">

                            Setoran Lebih Cepat

                        </h3>

                        <p class="mt-4 leading-7 text-zinc-600 dark:text-zinc-400">

                            Hitung berat, harga, dan saldo anggota secara
                            otomatis tanpa perhitungan manual.

                        </p>

                    </div>

                    <div
                        class="group rounded-3xl border border-zinc-200 bg-white p-8 transition duration-300 hover:-translate-y-2 hover:border-teal-500 hover:shadow-2xl dark:border-zinc-800 dark:bg-zinc-900">

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-teal-100 text-teal-600">

                            <flux:icon.wallet class="size-6" />

                        </div>

                        <h3 class="mt-8 text-xl font-bold">

                            Tabungan Digital

                        </h3>

                        <p class="mt-4 leading-7 text-zinc-600 dark:text-zinc-400">

                            Saldo anggota selalu diperbarui secara real-time
                            setelah setiap transaksi.

                        </p>

                    </div>

                    <div
                        class="group rounded-3xl border border-zinc-200 bg-white p-8 transition duration-300 hover:-translate-y-2 hover:border-teal-500 hover:shadow-2xl dark:border-zinc-800 dark:bg-zinc-900">

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-teal-100 text-teal-600">

                            <flux:icon.chart-bar class="size-6" />

                        </div>

                        <h3 class="mt-8 text-xl font-bold">

                            Laporan Lengkap

                        </h3>

                        <p class="mt-4 leading-7 text-zinc-600 dark:text-zinc-400">

                            Pantau transaksi, saldo, keuntungan,
                            dan perkembangan bank sampah melalui dashboard.

                        </p>

                    </div>

                    <div
                        class="group rounded-3xl border border-zinc-200 bg-white p-8 transition duration-300 hover:-translate-y-2 hover:border-teal-500 hover:shadow-2xl dark:border-zinc-800 dark:bg-zinc-900">

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-teal-100 text-teal-600">

                            <flux:icon.banknotes class="size-6" />

                        </div>

                        <h3 class="mt-8 text-xl font-bold">

                            Investasi

                        </h3>

                        <p class="mt-4 leading-7 text-zinc-600 dark:text-zinc-400">

                            Kelola investasi anggota secara transparan
                            dengan pencatatan yang rapi.

                        </p>

                    </div>

                    <div
                        class="group rounded-3xl border border-zinc-200 bg-white p-8 transition duration-300 hover:-translate-y-2 hover:border-teal-500 hover:shadow-2xl dark:border-zinc-800 dark:bg-zinc-900">

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-teal-100 text-teal-600">

                            <flux:icon.arrow-trending-up class="size-7" />

                        </div>

                        <h3 class="mt-8 text-xl font-bold">

                            Profit Sharing

                        </h3>

                        <p class="mt-4 leading-7 text-zinc-600 dark:text-zinc-400">

                            Pembagian keuntungan menjadi lebih mudah,
                            akurat, dan transparan.

                        </p>

                    </div>

                </div>

            </div>

        </section>

        {{-- ========================================================= --}}
        {{-- Cara Kerja --}}
        {{-- ========================================================= --}}

        <section id="workflow" class="bg-zinc-50 py-8 sm:py-16 lg:py-20 dark:bg-zinc-900/40">

            <div class="mx-auto max-w-7xl px-5 sm:px-6">

                <div class="mx-auto max-w-2xl text-center mb-6 lg:mb-12">

                    <span
                        class="inline-flex rounded-full bg-teal-100 px-4 py-2 text-sm font-medium text-teal-700 dark:bg-teal-500/10 dark:text-teal-300">

                        Cara Kerja

                    </span>

                    <h2 class="mt-5 text-3xl font-black leading-tight tracking-tight sm:text-4xl lg:text-5xl">

                        Empat Langkah Mudah

                    </h2>

                    <p class="mt-5 text-base leading-7 text-zinc-600 sm:text-lg sm:leading-8 dark:text-zinc-400">

                        Dari pendaftaran anggota hingga laporan transaksi,
                        seluruh proses dapat dilakukan dengan cepat, mudah,
                        dan terdokumentasi secara otomatis.

                    </p>

                </div>

                <div class="mt-14 grid gap-5 md:grid-cols-2 lg:grid-cols-4">

                    {{-- Step 1 --}}
                    <div
                        class="relative rounded-2xl border border-zinc-200 bg-white p-6 transition-all duration-300 hover:-translate-y-1 hover:border-teal-500 hover:shadow-xl dark:border-zinc-800 dark:bg-zinc-900">

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-teal-600 text-white">

                            <flux:icon.user-plus class="size-6" />

                        </div>

                        <h3 class="mt-5 text-lg font-semibold">

                            Tambah Anggota

                        </h3>

                        <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">

                            Daftarkan anggota baru beserta data identitasnya
                            hanya dalam beberapa detik.

                        </p>

                    </div>

                    {{-- Step 2 --}}
                    <div
                        class="relative rounded-2xl border border-zinc-200 bg-white p-6 transition-all duration-300 hover:-translate-y-1 hover:border-teal-500 hover:shadow-xl dark:border-zinc-800 dark:bg-zinc-900">

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-teal-600 text-white">

                            <flux:icon.scale class="size-6" />

                        </div>

                        <h3 class="mt-5 text-lg font-semibold">

                            Timbang Sampah

                        </h3>

                        <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">

                            Berat, kategori, harga, dan nilai transaksi
                            dihitung secara otomatis.

                        </p>

                    </div>

                    {{-- Step 3 --}}
                    <div
                        class="relative rounded-2xl border border-zinc-200 bg-white p-6 transition-all duration-300 hover:-translate-y-1 hover:border-teal-500 hover:shadow-xl dark:border-zinc-800 dark:bg-zinc-900">

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-teal-600 text-white">

                            <flux:icon.wallet class="size-6" />

                        </div>

                        <h3 class="mt-5 text-lg font-semibold">

                            Saldo Bertambah

                        </h3>

                        <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">

                            Saldo tabungan anggota langsung diperbarui setelah
                            transaksi berhasil disimpan.

                        </p>

                    </div>

                    {{-- Step 4 --}}
                    <div
                        class="relative rounded-2xl border border-zinc-200 bg-white p-6 transition-all duration-300 hover:-translate-y-1 hover:border-teal-500 hover:shadow-xl dark:border-zinc-800 dark:bg-zinc-900">

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-teal-600 text-white">

                            <flux:icon.chart-pie class="size-6" />

                        </div>

                        <h3 class="mt-5 text-lg font-semibold">

                            Pantau Laporan

                        </h3>

                        <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">

                            Seluruh transaksi, saldo, dan perkembangan bank
                            sampah tersedia secara real-time.

                        </p>

                    </div>

                </div>

            </div>

        </section>

        {{-- ========================================================= --}}
        {{-- Preview Dashboard --}}
        {{-- ========================================================= --}}

        <section class="py-28">

            <div class="mx-auto max-w-7xl px-6">

                <div class="grid items-center gap-16 lg:grid-cols-2">

                    <div>

                        <span
                            class="rounded-full bg-teal-100 px-4 py-2 text-sm font-medium text-teal-700 dark:bg-teal-500/10 dark:text-teal-300">

                            Dashboard Modern

                        </span>

                        <h2 class="mt-6 text-4xl font-black lg:text-5xl">

                            Semua Informasi
                            dalam Satu Tampilan.

                        </h2>

                        <p class="mt-8 text-lg leading-8 text-zinc-600 dark:text-zinc-400">

                            Lihat ringkasan transaksi,
                            perkembangan saldo,
                            anggota aktif,
                            hingga laporan keuangan
                            melalui dashboard yang sederhana
                            dan mudah dipahami.

                        </p>

                    </div>

                    <div
                        class="rounded-[2rem] border border-zinc-200 bg-white p-8 shadow-2xl dark:border-zinc-800 dark:bg-zinc-900">

                        <div class="grid grid-cols-2 gap-4">

                            <div class="rounded-2xl bg-teal-600 p-5 text-white">
                                <div class="text-sm opacity-80">
                                    Saldo
                                </div>

                                <div class="mt-3 text-3xl font-bold">
                                    Rp28,4 Jt
                                </div>
                            </div>

                            <div class="rounded-2xl border p-5 dark:border-zinc-800">
                                <div class="text-sm text-zinc-500">
                                    Anggota
                                </div>

                                <div class="mt-3 text-3xl font-bold">
                                    824
                                </div>
                            </div>

                            <div class="rounded-2xl border p-5 dark:border-zinc-800">
                                <div class="text-sm text-zinc-500">
                                    Setoran Hari Ini
                                </div>

                                <div class="mt-3 text-3xl font-bold">
                                    37
                                </div>
                            </div>

                            <div class="rounded-2xl border p-5 dark:border-zinc-800">
                                <div class="text-sm text-zinc-500">
                                    Profit
                                </div>

                                <div class="mt-3 text-3xl font-bold">
                                    Rp2,4 Jt
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        {{-- ========================================================= --}}
        {{-- Investasi & Profit Sharing --}}
        {{-- ========================================================= --}}

        <section class="bg-zinc-50 py-16 sm:py-20 lg:py-28 dark:bg-zinc-900/40">

            <div class="mx-auto max-w-7xl px-5 sm:px-6">

                <div class="grid items-center gap-14 lg:grid-cols-2 lg:gap-20">

                    {{-- ================================================= --}}
                    {{-- LEFT --}}
                    {{-- ================================================= --}}

                    <div class="max-w-xl">

                        <span
                            class="inline-flex rounded-full bg-teal-100 px-4 py-2 text-sm font-medium text-teal-700 dark:bg-teal-500/10 dark:text-teal-300">

                            Lebih dari Sekadar Bank Sampah

                        </span>

                        <h2 class="mt-6 text-3xl font-black leading-tight tracking-tight sm:text-4xl lg:text-5xl">

                            Kelola Investasi dan Profit Sharing
                            dengan Lebih Mudah.

                        </h2>

                        <p class="mt-6 text-base leading-7 text-zinc-600 sm:text-lg sm:leading-8 dark:text-zinc-400">

                            ViaBin membantu pengelolaan investasi anggota,
                            pembagian keuntungan, hingga pencatatan seluruh
                            transaksi secara transparan sehingga mudah dipantau
                            kapan saja.

                        </p>

                        <div class="mt-10 space-y-6">

                            <div class="flex items-start gap-4">

                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-teal-100 text-teal-600">

                                    <flux:icon.banknotes class="size-6"/>

                                </div>

                                <div>

                                    <h3 class="font-semibold">

                                        Investasi Anggota

                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-zinc-500">

                                        Catat seluruh investasi anggota beserta riwayat transaksi secara lengkap.

                                    </p>

                                </div>

                            </div>

                            <div class="flex items-start gap-4">

                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-teal-100 text-teal-600">

                                    <flux:icon.arrow-trending-up class="size-6"/>

                                </div>

                                <div>

                                    <h3 class="font-semibold">

                                        Profit Sharing

                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-zinc-500">

                                        Perhitungan keuntungan dilakukan lebih mudah, akurat, dan transparan.

                                    </p>

                                </div>

                            </div>

                            <div class="flex items-start gap-4">

                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-teal-100 text-teal-600">

                                    <flux:icon.document-chart-bar class="size-6"/>

                                </div>

                                <div>

                                    <h3 class="font-semibold">

                                        Laporan Lengkap

                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-zinc-500">

                                        Seluruh data tersedia untuk audit, evaluasi, maupun pelaporan.

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- ================================================= --}}
                    {{-- RIGHT --}}
                    {{-- ================================================= --}}

                    <div class="mx-auto w-full max-w-sm lg:max-w-lg">

                        <div
                            class="rounded-3xl border border-zinc-200 bg-white p-4 shadow-xl sm:p-6 lg:p-8 dark:border-zinc-800 dark:bg-zinc-900">

                            <div class="flex items-center justify-between gap-3">

                                <div class="min-w-0">

                                    <p class="text-xs font-medium uppercase tracking-wide text-zinc-500">

                                        Total Investasi

                                    </p>

                                    <h3 class="mt-1 text-2xl font-black leading-none sm:text-3xl lg:text-4xl">

                                        Rp125.800.000

                                    </h3>

                                </div>

                                <span
                                    class="rounded-full bg-teal-100 px-2.5 py-1 text-xs font-semibold text-teal-700 dark:bg-teal-500/10 dark:text-teal-300">

                                    Aktif

                                </span>

                            </div>

                            <div class="mt-6 space-y-2">

                                <div
                                    class="flex items-center justify-between rounded-xl bg-zinc-50 px-4 py-3 dark:bg-zinc-800">

                                    <span class="text-sm text-zinc-500">

                                        Investor Aktif

                                    </span>

                                    <span class="font-semibold">

                                        248 Orang

                                    </span>

                                </div>

                                <div
                                    class="flex items-center justify-between rounded-xl bg-zinc-50 px-4 py-3 dark:bg-zinc-800">

                                    <span class="text-sm text-zinc-500">

                                        Profit Bulan Ini

                                    </span>

                                    <span class="font-semibold">

                                        Rp8.540.000

                                    </span>

                                </div>

                                <div
                                    class="flex items-center justify-between rounded-xl bg-zinc-50 px-4 py-3 dark:bg-zinc-800">

                                    <span class="text-sm text-zinc-500">

                                        Profit Dibagikan

                                    </span>

                                    <span class="font-semibold">

                                        Rp54.200.000

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        {{-- ========================================================= --}}
        {{-- CTA --}}
        {{-- ========================================================= --}}

        <section class="pb-28">

            <div class="mx-auto max-w-7xl px-6">

                <div
                    class="overflow-hidden rounded-[2rem] bg-gradient-to-r from-teal-600 to-green-700 px-10 py-16 text-center text-white shadow-2xl">

                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-white/10">

                        <flux:icon.rocket-launch class="size-10" />

                    </div>

                    <h2 class="mt-8 text-4xl font-black lg:text-5xl">

                        Siap Membawa
                        Bank Sampah Anda
                        Naik Kelas?

                    </h2>

                    <p class="mx-auto mt-6 max-w-3xl text-lg leading-8 text-teal-100">

                        Tinggalkan pencatatan manual.
                        Kelola anggota, transaksi, tabungan,
                        investasi, hingga laporan dalam satu
                        platform yang modern dan mudah digunakan.

                    </p>

                    <div class="mt-10 flex flex-wrap justify-center gap-4">

                        @guest

                            <flux:button href="{{ route('register') }}" variant="primary">

                                Mulai Gratis

                            </flux:button>

                            <flux:button href="{{ route('login') }}" variant="ghost">

                                Masuk

                            </flux:button>
                        @else
                            <flux:button href="{{ route('dashboard') }}" variant="primary">

                                Buka Dashboard

                            </flux:button>

                        @endguest

                    </div>

                </div>

            </div>

        </section>

        {{-- ========================================================= --}}
        {{-- Footer --}}
        {{-- ========================================================= --}}

        <footer class="border-t border-zinc-200 py-12 dark:border-zinc-800">

            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-8 px-6 lg:flex-row">

                <div class="flex items-center gap-4">

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-teal-600 text-white">

                        <flux:icon.arrow-path class="size-6" />

                    </div>

                    <div>

                        <div class="font-bold">

                            ViaBin

                        </div>

                        <div class="text-sm text-zinc-500">

                            Platform Digital untuk Bank Sampah Indonesia

                        </div>

                    </div>

                </div>

                <div class="flex flex-wrap items-center justify-center gap-8 text-sm text-zinc-500">

                    <a href="#features" class="hover:text-teal-600">
                        Fitur
                    </a>

                    <a href="#workflow" class="hover:text-teal-600">
                        Cara Kerja
                    </a>

                    <a href="#pricing" class="hover:text-teal-600">
                        Paket
                    </a>

                    <a href="#">
                        Dokumentasi
                    </a>

                </div>

                <div class="text-sm text-zinc-500">

                    © {{ date('Y') }} ViaBin.
                    Seluruh hak cipta dilindungi.

                </div>

            </div>

        </footer>

        @fluxScripts

    </body>

</html>
