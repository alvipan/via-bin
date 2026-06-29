<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>ViaBin - Platform Digital Bank Sampah</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-zinc-50 text-zinc-900">

        {{-- Header --}}
        <header class="sticky top-0 z-50 border-b border-zinc-200 bg-white/90 backdrop-blur">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

                <div class="flex items-center gap-3">
                    <div class="rounded-xl bg-emerald-100 p-2">
                        <flux:icon.arrow-path class="size-6 text-emerald-600" />
                    </div>

                    <div>
                        <h1 class="text-xl font-bold">
                            ViaBin
                        </h1>

                        <p class="text-sm text-zinc-500">
                            Platform Digital Bank Sampah
                        </p>
                    </div>
                </div>

                @auth
                    <flux:button :href="route('dashboard')" variant="primary">
                        Dashboard
                    </flux:button>
                @else
                    <flux:button :href="route('login')" variant="primary">
                        Masuk
                    </flux:button>
                @endauth

            </div>
        </header>

        {{-- Hero --}}
        <section class="py-28">
            <div class="mx-auto max-w-5xl px-6 text-center">

                <div
                    class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2">

                    <flux:icon.arrow-path class="size-4 text-emerald-600" />

                    <span class="text-sm font-medium text-emerald-700">
                        Platform Digital Bank Sampah
                    </span>

                </div>

                <h2 class="mt-8 text-5xl font-bold leading-tight">
                    Kelola
                    <span class="text-emerald-600">
                        Bank Sampah
                    </span>
                    dengan lebih mudah,
                    transparan,
                    dan modern.
                </h2>

                <p class="mx-auto mt-6 max-w-3xl text-lg leading-8 text-zinc-600">
                    ViaBin membantu pengelola Bank Sampah mengelola member,
                    transaksi setoran, tabungan,
                    hingga pembagian profit dalam satu sistem yang terintegrasi.
                </p>

                <div class="mt-10">
                    <flux:button :href="route('login')" variant="primary">
                        Mulai Sekarang
                    </flux:button>
                </div>

            </div>
        </section>

        {{-- Tentang --}}
        <section class="border-y border-zinc-200 bg-white py-20">

            <div class="mx-auto max-w-5xl px-6 text-center">

                <h3 class="text-3xl font-bold">
                    Apa itu ViaBin?
                </h3>

                <p class="mx-auto mt-6 max-w-4xl text-lg leading-8 text-zinc-600">
                    ViaBin merupakan platform digital yang dirancang untuk
                    membantu operasional Bank Sampah menjadi lebih efisien,
                    transparan, dan mudah digunakan.
                    Seluruh aktivitas mulai dari data member,
                    transaksi setoran,
                    tabungan,
                    hingga profit dapat dikelola dalam satu dashboard.
                </p>

            </div>

        </section>

        {{-- Cara Kerja --}}
        <section class="py-20">

            <div class="mx-auto max-w-6xl px-6">

                <div class="text-center">

                    <h3 class="text-3xl font-bold">
                        Cara Kerja
                    </h3>

                    <p class="mt-3 text-zinc-600">
                        Alur sederhana pengelolaan Bank Sampah.
                    </p>

                </div>

                <div class="mt-14 grid gap-6 md:grid-cols-4">

                    <flux:card>
                        <flux:icon.archive-box class="size-10 text-emerald-600" />

                        <h4 class="mt-5 font-semibold">
                            Setor Sampah
                        </h4>

                        <p class="mt-2 text-sm text-zinc-600">
                            Member menyetorkan sampah yang telah dipilah.
                        </p>
                    </flux:card>

                    <flux:card>
                        <flux:icon.scale class="size-10 text-emerald-600" />

                        <h4 class="mt-5 font-semibold">
                            Penimbangan
                        </h4>

                        <p class="mt-2 text-sm text-zinc-600">
                            Sampah ditimbang dan dicatat ke sistem.
                        </p>
                    </flux:card>

                    <flux:card>
                        <flux:icon.wallet class="size-10 text-emerald-600" />

                        <h4 class="mt-5 font-semibold">
                            Tabungan
                        </h4>

                        <p class="mt-2 text-sm text-zinc-600">
                            Nilai transaksi otomatis menjadi saldo tabungan.
                        </p>
                    </flux:card>

                    <flux:card>
                        <flux:icon.presentation-chart-line class="size-10 text-emerald-600" />

                        <h4 class="mt-5 font-semibold">
                            Profit
                        </h4>

                        <p class="mt-2 text-sm text-zinc-600">
                            Profit dan saldo dapat dipantau secara transparan.
                        </p>
                    </flux:card>

                </div>

            </div>

        </section>

        {{-- Fitur --}}
        <section class="border-y border-zinc-200 bg-white py-20">

            <div class="mx-auto max-w-6xl px-6">

                <div class="text-center">

                    <h3 class="text-3xl font-bold">
                        Fitur Utama
                    </h3>

                    <p class="mt-3 text-zinc-600">
                        Semua kebutuhan operasional Bank Sampah dalam satu platform.
                    </p>

                </div>

                <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">

                    <flux:card>
                        <flux:icon.users class="size-8 text-emerald-600" />

                        <h4 class="mt-4 font-semibold">
                            Manajemen Member
                        </h4>

                        <p class="mt-2 text-sm text-zinc-600">
                            Kelola data seluruh member dengan mudah.
                        </p>
                    </flux:card>

                    <flux:card>
                        <flux:icon.archive-box class="size-8 text-emerald-600" />

                        <h4 class="mt-4 font-semibold">
                            Setoran Sampah
                        </h4>

                        <p class="mt-2 text-sm text-zinc-600">
                            Pencatatan transaksi setoran yang cepat dan akurat.
                        </p>
                    </flux:card>

                    <flux:card>
                        <flux:icon.wallet class="size-8 text-emerald-600" />

                        <h4 class="mt-4 font-semibold">
                            Tabungan Member
                        </h4>

                        <p class="mt-2 text-sm text-zinc-600">
                            Saldo tabungan tercatat secara otomatis.
                        </p>
                    </flux:card>

                    <flux:card>
                        <flux:icon.cube class="size-8 text-emerald-600" />

                        <h4 class="mt-4 font-semibold">
                            Investasi
                        </h4>

                        <p class="mt-2 text-sm text-zinc-600">
                            Program investasi berbasis saldo tabungan.
                        </p>
                    </flux:card>

                    <flux:card>
                        <flux:icon.presentation-chart-line class="size-8 text-emerald-600" />

                        <h4 class="mt-4 font-semibold">
                            Profit Sharing
                        </h4>

                        <p class="mt-2 text-sm text-zinc-600">
                            Pembagian keuntungan yang transparan.
                        </p>
                    </flux:card>

                    <flux:card>
                        <flux:icon.squares-2x2 class="size-8 text-emerald-600" />

                        <h4 class="mt-4 font-semibold">
                            Dashboard
                        </h4>

                        <p class="mt-2 text-sm text-zinc-600">
                            Pantau seluruh aktivitas secara real-time.
                        </p>
                    </flux:card>

                </div>

            </div>

        </section>

        {{-- CTA --}}
        <section class="py-24">

            <div class="mx-auto max-w-4xl px-6 text-center">

                <h3 class="text-4xl font-bold">
                    Digitalisasi Bank Sampah Dimulai dari Sini
                </h3>

                <p class="mt-6 text-lg text-zinc-600">
                    ViaBin membantu operasional Bank Sampah menjadi lebih modern,
                    efisien, dan transparan bagi pengelola maupun member.
                </p>

                <div class="mt-10">

                    <flux:button :href="route('login')" variant="primary">
                        Mulai Sekarang
                    </flux:button>

                </div>

            </div>

        </section>

        {{-- Footer --}}
        <footer class="border-t border-zinc-200 bg-white">

            <div class="mx-auto max-w-7xl px-6 py-8 text-center text-sm text-zinc-500">

                © {{ date('Y') }} ViaBin · Platform Digital Bank Sampah

            </div>

        </footer>

    </body>

</html>
