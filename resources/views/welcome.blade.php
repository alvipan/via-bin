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

                <a href="/" class="flex items-center gap-3">

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-600 text-white shadow-lg shadow-emerald-600/20">

                        <flux:icon.arrow-path class="size-6" />

                    </div>

                    <div>

                        <h1 class="font-bold tracking-tight">
                            ViaBin
                        </h1>

                        <p class="text-xs text-zinc-500 dark:text-zinc-400">
                            Platform Digital Bank Sampah
                        </p>

                    </div>

                </a>

                <nav class="hidden items-center gap-8 text-sm md:flex">

                    <a href="#features" class="transition hover:text-emerald-600">
                        Fitur
                    </a>

                    <a href="#workflow" class="transition hover:text-emerald-600">
                        Cara Kerja
                    </a>

                    <a href="#pricing" class="transition hover:text-emerald-600">
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

        <section class="relative overflow-hidden">

            <div class="absolute left-0 top-0 h-[32rem] w-[32rem] rounded-full bg-emerald-500/10 blur-3xl">
            </div>

            <div class="absolute bottom-0 right-0 h-[30rem] w-[30rem] rounded-full bg-lime-400/10 blur-3xl">
            </div>

            <div class="relative mx-auto max-w-7xl px-6 py-24 lg:py-36">

                <div class="grid items-center gap-20 lg:grid-cols-2">

                    {{-- ================================================= --}}
                    {{-- Left --}}
                    {{-- ================================================= --}}

                    <div>

                        <div
                            class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-sm font-medium text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-300">

                            <flux:icon.sparkles class="size-4" />

                            Solusi Modern untuk Bank Sampah

                        </div>

                        <h1 class="mt-8 max-w-2xl text-5xl font-black tracking-tight lg:text-7xl">

                            Ubah Sampah

                            <span class="text-emerald-600">

                                Menjadi Nilai.

                            </span>

                        </h1>

                        <p class="mt-8 max-w-2xl text-lg leading-8 text-zinc-600 dark:text-zinc-400">

                            ViaBin membantu Bank Sampah mengelola
                            anggota, transaksi setoran, tabungan,
                            investasi, hingga pembagian keuntungan
                            dalam satu platform yang mudah digunakan.

                        </p>

                        <div class="mt-10 flex flex-wrap gap-4">

                            @guest

                                <flux:button href="{{ route('register') }}" variant="primary">

                                    Mulai Sekarang

                                </flux:button>
                            @else
                                <flux:button href="{{ route('dashboard') }}" variant="primary">

                                    Buka Dashboard

                                </flux:button>

                            @endguest

                            <flux:button href="#features" variant="ghost">

                                Pelajari Lebih Lanjut

                            </flux:button>

                        </div>

                        <div class="mt-14 grid grid-cols-3 gap-8">

                            <div>

                                <div class="text-3xl font-bold">

                                    100%

                                </div>

                                <div class="mt-2 text-sm text-zinc-500">

                                    Digital

                                </div>

                            </div>

                            <div>

                                <div class="text-3xl font-bold">

                                    6+

                                </div>

                                <div class="mt-2 text-sm text-zinc-500">

                                    Modul Utama

                                </div>

                            </div>

                            <div>

                                <div class="text-3xl font-bold">

                                    Real-time

                                </div>

                                <div class="mt-2 text-sm text-zinc-500">

                                    Laporan

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- ================================================= --}}
                    {{-- Right --}}
                    {{-- ================================================= --}}

                    <div class="relative">

                        {{-- Floating Card --}}
                        <div
                            class="absolute -left-10 top-10 hidden rounded-2xl border border-emerald-200 bg-white px-5 py-4 shadow-xl lg:block dark:border-zinc-800 dark:bg-zinc-900">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">

                                    <flux:icon.arrow-down-tray class="size-5" />

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
                            class="absolute -right-8 bottom-16 hidden rounded-2xl border border-emerald-200 bg-white px-5 py-4 shadow-xl lg:block dark:border-zinc-800 dark:bg-zinc-900">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">

                                    <flux:icon.banknotes class="size-5" />

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

                        {{-- Dashboard Preview --}}
                        <div
                            class="overflow-hidden rounded-[2rem] border border-zinc-200 bg-white shadow-2xl dark:border-zinc-800 dark:bg-zinc-900">

                            <div class="border-b border-zinc-200 px-8 py-6 dark:border-zinc-800">

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
                                        class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">

                                        Aktif

                                    </div>

                                </div>

                            </div>

                            <div class="space-y-6 p-8">

                                <div class="rounded-2xl bg-emerald-600 p-6 text-white">

                                    <div class="text-sm opacity-80">

                                        Total Saldo Bank Sampah

                                    </div>

                                    <div class="mt-3 text-4xl font-black">

                                        Rp28.450.000

                                    </div>

                                </div>

                                <div class="grid grid-cols-2 gap-4">

                                    <div class="rounded-2xl border border-zinc-200 p-5 dark:border-zinc-800">

                                        <flux:icon.scale class="mb-3 size-6 text-emerald-600" />

                                        <div class="text-2xl font-bold">

                                            128 Kg

                                        </div>

                                        <div class="text-sm text-zinc-500">

                                            Sampah Hari Ini

                                        </div>

                                    </div>

                                    <div class="rounded-2xl border border-zinc-200 p-5 dark:border-zinc-800">

                                        <flux:icon.users class="mb-3 size-6 text-emerald-600" />

                                        <div class="text-2xl font-bold">

                                            37

                                        </div>

                                        <div class="text-sm text-zinc-500">

                                            Transaksi

                                        </div>

                                    </div>

                                </div>

                                <div
                                    class="rounded-2xl border border-dashed border-emerald-300 bg-emerald-50 p-5 dark:border-emerald-500/20 dark:bg-emerald-500/10">

                                    <div class="flex items-center gap-3">

                                        <flux:icon.check-circle class="size-6 text-emerald-600" />

                                        <div>

                                            <div class="font-semibold">

                                                Semua transaksi telah tersimpan.

                                            </div>

                                            <div class="text-sm text-zinc-500">

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

        <section id="features" class="py-28">

            <div class="mx-auto max-w-7xl px-6">

                <div class="mx-auto max-w-3xl text-center">

                    <span
                        class="rounded-full bg-emerald-100 px-4 py-2 text-sm font-medium text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">

                        Mengapa ViaBin?

                    </span>

                    <h2 class="mt-6 text-4xl font-black tracking-tight lg:text-5xl">

                        Semua Operasional
                        Bank Sampah
                        Dalam Satu Platform.

                    </h2>

                    <p class="mt-6 text-lg leading-8 text-zinc-600 dark:text-zinc-400">

                        Tidak perlu lagi berpindah aplikasi atau melakukan
                        pencatatan manual. ViaBin membantu seluruh proses
                        operasional menjadi lebih cepat, rapi, dan transparan.

                    </p>

                </div>

                <div class="mt-20 grid gap-8 md:grid-cols-2 xl:grid-cols-3">

                    <div
                        class="group rounded-3xl border border-zinc-200 bg-white p-8 transition duration-300 hover:-translate-y-2 hover:border-emerald-500 hover:shadow-2xl dark:border-zinc-800 dark:bg-zinc-900">

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">

                            <flux:icon.users class="size-7" />

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
                        class="group rounded-3xl border border-zinc-200 bg-white p-8 transition duration-300 hover:-translate-y-2 hover:border-emerald-500 hover:shadow-2xl dark:border-zinc-800 dark:bg-zinc-900">

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">

                            <flux:icon.scale class="size-7" />

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
                        class="group rounded-3xl border border-zinc-200 bg-white p-8 transition duration-300 hover:-translate-y-2 hover:border-emerald-500 hover:shadow-2xl dark:border-zinc-800 dark:bg-zinc-900">

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">

                            <flux:icon.wallet class="size-7" />

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
                        class="group rounded-3xl border border-zinc-200 bg-white p-8 transition duration-300 hover:-translate-y-2 hover:border-emerald-500 hover:shadow-2xl dark:border-zinc-800 dark:bg-zinc-900">

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">

                            <flux:icon.chart-bar class="size-7" />

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
                        class="group rounded-3xl border border-zinc-200 bg-white p-8 transition duration-300 hover:-translate-y-2 hover:border-emerald-500 hover:shadow-2xl dark:border-zinc-800 dark:bg-zinc-900">

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">

                            <flux:icon.banknotes class="size-7" />

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
                        class="group rounded-3xl border border-zinc-200 bg-white p-8 transition duration-300 hover:-translate-y-2 hover:border-emerald-500 hover:shadow-2xl dark:border-zinc-800 dark:bg-zinc-900">

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">

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

        <section id="workflow" class="bg-zinc-50 py-28 dark:bg-zinc-900/40">

            <div class="mx-auto max-w-7xl px-6">

                <div class="mx-auto max-w-3xl text-center">

                    <span
                        class="rounded-full bg-emerald-100 px-4 py-2 text-sm font-medium text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">

                        Cara Kerja

                    </span>

                    <h2 class="mt-6 text-4xl font-black">

                        Empat Langkah
                        yang Sangat Mudah.

                    </h2>

                </div>

                <div class="mt-20 grid gap-10 lg:grid-cols-4">

                    <div class="relative text-center">

                        <div
                            class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-600 text-white shadow-lg shadow-emerald-600/30">

                            <flux:icon.user-plus class="size-9" />

                        </div>

                        <div class="mt-8 text-xl font-semibold">

                            Tambah Anggota

                        </div>

                        <p class="mt-3 text-zinc-500">

                            Daftarkan anggota
                            bank sampah.

                        </p>

                    </div>

                    <div class="relative text-center">

                        <div
                            class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-600 text-white shadow-lg shadow-emerald-600/30">

                            <flux:icon.scale class="size-9" />

                        </div>

                        <div class="mt-8 text-xl font-semibold">

                            Timbang Sampah

                        </div>

                        <p class="mt-3 text-zinc-500">

                            Berat dan harga
                            dihitung otomatis.

                        </p>

                    </div>

                    <div class="relative text-center">

                        <div
                            class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-600 text-white shadow-lg shadow-emerald-600/30">

                            <flux:icon.wallet class="size-9" />

                        </div>

                        <div class="mt-8 text-xl font-semibold">

                            Saldo Bertambah

                        </div>

                        <p class="mt-3 text-zinc-500">

                            Tabungan anggota
                            langsung diperbarui.

                        </p>

                    </div>

                    <div class="relative text-center">

                        <div
                            class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-600 text-white shadow-lg shadow-emerald-600/30">

                            <flux:icon.chart-pie class="size-9" />

                        </div>

                        <div class="mt-8 text-xl font-semibold">

                            Pantau Laporan

                        </div>

                        <p class="mt-3 text-zinc-500">

                            Semua data tersedia
                            secara real-time.

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
                            class="rounded-full bg-emerald-100 px-4 py-2 text-sm font-medium text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">

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

                            <div class="rounded-2xl bg-emerald-600 p-5 text-white">
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

        <section class="bg-zinc-50 py-28 dark:bg-zinc-900/40">

            <div class="mx-auto max-w-7xl px-6">

                <div class="grid items-center gap-20 lg:grid-cols-2">

                    <div>

                        <span
                            class="rounded-full bg-emerald-100 px-4 py-2 text-sm font-medium text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">

                            Lebih dari Sekadar Bank Sampah

                        </span>

                        <h2 class="mt-6 text-4xl font-black tracking-tight lg:text-5xl">

                            Kelola Investasi
                            dan Profit Sharing
                            Dengan Lebih Mudah.

                        </h2>

                        <p class="mt-8 text-lg leading-8 text-zinc-600 dark:text-zinc-400">

                            ViaBin membantu pengelolaan investasi anggota
                            hingga pembagian keuntungan secara transparan.
                            Semua transaksi tercatat rapi sehingga mudah
                            dipantau kapan saja.

                        </p>

                        <div class="mt-10 space-y-5">

                            <div class="flex gap-4">

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">

                                    <flux:icon.banknotes class="size-6" />

                                </div>

                                <div>

                                    <h3 class="font-semibold">

                                        Investasi Anggota

                                    </h3>

                                    <p class="mt-1 text-zinc-500">

                                        Catat seluruh investasi dengan riwayat yang lengkap.

                                    </p>

                                </div>

                            </div>

                            <div class="flex gap-4">

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">

                                    <flux:icon.arrow-trending-up class="size-6" />

                                </div>

                                <div>

                                    <h3 class="font-semibold">

                                        Profit Sharing

                                    </h3>

                                    <p class="mt-1 text-zinc-500">

                                        Perhitungan keuntungan lebih mudah dan transparan.

                                    </p>

                                </div>

                            </div>

                            <div class="flex gap-4">

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">

                                    <flux:icon.document-chart-bar class="size-6" />

                                </div>

                                <div>

                                    <h3 class="font-semibold">

                                        Laporan Lengkap

                                    </h3>

                                    <p class="mt-1 text-zinc-500">

                                        Semua data tersedia untuk audit maupun evaluasi.

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div>

                        <div
                            class="rounded-[2rem] border border-zinc-200 bg-white p-8 shadow-2xl dark:border-zinc-800 dark:bg-zinc-900">

                            <div class="flex items-center justify-between">

                                <div>

                                    <div class="text-sm text-zinc-500">

                                        Total Investasi

                                    </div>

                                    <div class="mt-2 text-4xl font-black">

                                        Rp125.800.000

                                    </div>

                                </div>

                                <div
                                    class="rounded-full bg-emerald-100 px-3 py-1 text-sm font-medium text-emerald-700">

                                    Aktif

                                </div>

                            </div>

                            <div class="mt-10 space-y-4">

                                <div
                                    class="flex items-center justify-between rounded-xl bg-zinc-50 p-4 dark:bg-zinc-800">

                                    <span>Investor Aktif</span>

                                    <strong>248 Orang</strong>

                                </div>

                                <div
                                    class="flex items-center justify-between rounded-xl bg-zinc-50 p-4 dark:bg-zinc-800">

                                    <span>Profit Bulan Ini</span>

                                    <strong>Rp8.540.000</strong>

                                </div>

                                <div
                                    class="flex items-center justify-between rounded-xl bg-zinc-50 p-4 dark:bg-zinc-800">

                                    <span>Total Pembagian Profit</span>

                                    <strong>Rp54.200.000</strong>

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
                    class="overflow-hidden rounded-[2rem] bg-gradient-to-r from-emerald-600 to-green-700 px-10 py-16 text-center text-white shadow-2xl">

                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-white/10">

                        <flux:icon.rocket-launch class="size-10" />

                    </div>

                    <h2 class="mt-8 text-4xl font-black lg:text-5xl">

                        Siap Membawa
                        Bank Sampah Anda
                        Naik Kelas?

                    </h2>

                    <p class="mx-auto mt-6 max-w-3xl text-lg leading-8 text-emerald-100">

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

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-600 text-white">

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

                    <a href="#features" class="hover:text-emerald-600">
                        Fitur
                    </a>

                    <a href="#workflow" class="hover:text-emerald-600">
                        Cara Kerja
                    </a>

                    <a href="#pricing" class="hover:text-emerald-600">
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
