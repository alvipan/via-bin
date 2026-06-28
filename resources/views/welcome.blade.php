<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ViaBin - Platform Digital Bank Sampah</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-slate-50 text-slate-800">

        <!-- Header -->
        <header class="sticky top-0 z-50 border-b bg-white/90 backdrop-blur">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

                <div>
                    <h1 class="text-2xl font-bold text-emerald-600">
                        ViaBin
                    </h1>
                </div>

                <a href="{{ route('login') }}"
                    class="rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-emerald-700">
                    Login
                </a>

            </div>
        </header>

        <!-- Hero -->
        <section class="py-24">
            <div class="mx-auto max-w-5xl px-6 text-center">

                <span class="rounded-full bg-emerald-100 px-4 py-2 text-sm font-medium text-emerald-700">
                    🌱 Platform Digital Bank Sampah
                </span>

                <h2 class="mt-8 text-5xl font-bold leading-tight">
                    Kelola
                    <span class="text-emerald-600">
                        Bank Sampah
                    </span>
                    dengan lebih mudah,
                    transparan, dan modern.
                </h2>

                <p class="mx-auto mt-6 max-w-3xl text-lg leading-8 text-slate-600">
                    ViaBin membantu pengelola Bank Sampah dalam mengelola member,
                    pencatatan setoran sampah, tabungan, serta program investasi
                    dan pembagian profit dalam satu sistem yang terintegrasi.
                </p>

                <div class="mt-10">
                    <a href="{{ route('login') }}"
                        class="rounded-xl bg-emerald-600 px-8 py-4 font-semibold text-white transition hover:bg-emerald-700">
                        Login Member
                    </a>
                </div>

            </div>
        </section>

        <!-- Tentang -->
        <section class="bg-white py-20">
            <div class="mx-auto max-w-5xl px-6">

                <div class="text-center">

                    <h3 class="text-3xl font-bold">
                        Apa itu ViaBin?
                    </h3>

                    <p class="mx-auto mt-6 max-w-4xl text-lg leading-8 text-slate-600">
                        ViaBin adalah platform digital yang dirancang untuk membantu
                        operasional Bank Sampah menjadi lebih efisien dan transparan.
                        Seluruh aktivitas mulai dari data member, setoran sampah,
                        tabungan, hingga investasi dapat dikelola dalam satu dashboard
                        yang mudah digunakan.
                    </p>

                </div>

            </div>
        </section>

        <!-- Cara Kerja -->
        <section class="py-20">
            <div class="mx-auto max-w-6xl px-6">

                <div class="text-center">

                    <h3 class="text-3xl font-bold">
                        Cara Kerja
                    </h3>

                    <p class="mt-3 text-slate-600">
                        Alur sederhana dalam pengelolaan Bank Sampah.
                    </p>

                </div>

                <div class="mt-14 grid gap-6 md:grid-cols-5">

                    <div class="rounded-2xl bg-white p-6 shadow-sm">

                        <div class="text-4xl">♻️</div>

                        <h4 class="mt-4 font-semibold">
                            Setor Sampah
                        </h4>

                        <p class="mt-2 text-sm text-slate-600">
                            Member menyetorkan sampah yang telah dipilah.
                        </p>

                    </div>

                    <div class="rounded-2xl bg-white p-6 shadow-sm">

                        <div class="text-4xl">⚖️</div>

                        <h4 class="mt-4 font-semibold">
                            Penimbangan
                        </h4>

                        <p class="mt-2 text-sm text-slate-600">
                            Sampah ditimbang dan dicatat ke sistem.
                        </p>

                    </div>

                    <div class="rounded-2xl bg-white p-6 shadow-sm">

                        <div class="text-4xl">💰</div>

                        <h4 class="mt-4 font-semibold">
                            Tabungan
                        </h4>

                        <p class="mt-2 text-sm text-slate-600">
                            Nilai sampah menjadi saldo tabungan member.
                        </p>

                    </div>

                    <div class="rounded-2xl bg-white p-6 shadow-sm">

                        <div class="text-4xl">📦</div>

                        <h4 class="mt-4 font-semibold">
                            Investasi
                        </h4>

                        <p class="mt-2 text-sm text-slate-600">
                            Saldo dapat digunakan mengikuti program investasi.
                        </p>

                    </div>

                    <div class="rounded-2xl bg-white p-6 shadow-sm">

                        <div class="text-4xl">📈</div>

                        <h4 class="mt-4 font-semibold">
                            Profit
                        </h4>

                        <p class="mt-2 text-sm text-slate-600">
                            Profit dan saldo dapat dipantau secara transparan.
                        </p>

                    </div>

                </div>

            </div>
        </section>

        <!-- Fitur -->
        <section class="bg-white py-20">

            <div class="mx-auto max-w-6xl px-6">

                <div class="text-center">

                    <h3 class="text-3xl font-bold">
                        Fitur Utama
                    </h3>

                    <p class="mt-3 text-slate-600">
                        Semua kebutuhan operasional Bank Sampah dalam satu platform.
                    </p>

                </div>

                <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">

                    <div class="rounded-xl border bg-white p-6">
                        <h4 class="font-semibold">👥 Manajemen Member</h4>
                        <p class="mt-3 text-sm text-slate-600">
                            Kelola data seluruh member dengan mudah.
                        </p>
                    </div>

                    <div class="rounded-xl border bg-white p-6">
                        <h4 class="font-semibold">♻️ Setoran Sampah</h4>
                        <p class="mt-3 text-sm text-slate-600">
                            Pencatatan transaksi setoran yang cepat dan akurat.
                        </p>
                    </div>

                    <div class="rounded-xl border bg-white p-6">
                        <h4 class="font-semibold">💰 Tabungan Member</h4>
                        <p class="mt-3 text-sm text-slate-600">
                            Saldo tabungan tercatat otomatis.
                        </p>
                    </div>

                    <div class="rounded-xl border bg-white p-6">
                        <h4 class="font-semibold">📦 Investasi</h4>
                        <p class="mt-3 text-sm text-slate-600">
                            Program investasi berbasis saldo tabungan.
                        </p>
                    </div>

                    <div class="rounded-xl border bg-white p-6">
                        <h4 class="font-semibold">📈 Profit Sharing</h4>
                        <p class="mt-3 text-sm text-slate-600">
                            Pembagian keuntungan yang transparan.
                        </p>
                    </div>

                    <div class="rounded-xl border bg-white p-6">
                        <h4 class="font-semibold">📊 Dashboard</h4>
                        <p class="mt-3 text-sm text-slate-600">
                            Pantau seluruh aktivitas secara real-time.
                        </p>
                    </div>

                </div>

            </div>

        </section>

        <!-- CTA -->
        <section class="py-24">

            <div class="mx-auto max-w-4xl px-6 text-center">

                <h3 class="text-4xl font-bold">
                    Digitalisasi Bank Sampah Dimulai dari Sini
                </h3>

                <p class="mt-6 text-lg text-slate-600">
                    ViaBin hadir untuk membantu pengelolaan Bank Sampah menjadi
                    lebih modern, efisien, dan transparan bagi pengelola maupun member.
                </p>

                <div class="mt-10">

                    <a href="{{ route('login') }}"
                        class="rounded-xl bg-emerald-600 px-8 py-4 font-semibold text-white transition hover:bg-emerald-700">
                        Login Member
                    </a>

                </div>

            </div>

        </section>

        <!-- Footer -->
        <footer class="border-t bg-white">

            <div class="mx-auto max-w-7xl px-6 py-8 text-center text-sm text-slate-500">

                © {{ date('Y') }} ViaBin · Platform Digital Bank Sampah

            </div>

        </footer>

    </body>

</html>
