<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Judul Dinamis dengan Default Fallback -->
        <title>{{ $title ?? config('app.name', 'ViaBin') }}</title>

        <!-- Stack untuk Meta Tags SEO Dinamis -->
        @stack('meta')

        <link rel="icon" type="image/png" href="/favicon.png" />

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>

    <body class="min-h-screen bg-zinc-100 dark:bg-zinc-900">

        {{ $slot }}

        @livewireScripts
        @fluxScripts
    </body>

</html>
