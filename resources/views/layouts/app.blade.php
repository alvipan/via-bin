@php
    use App\Enums\TenantModule;
@endphp

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

    <body class="min-h-screen bg-zinc-100 antialiased dark:bg-zinc-800">

        <flux:sidebar sticky collapsible="mobile"
            class="border-r border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.header>
                <flux:sidebar.brand href="/" logo="/icon.svg" name="{{ config('app.name') }}" />

                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            @if (tenant())
                <livewire:tenant-switcher />
            @endif

            <flux:sidebar.nav class="space-y-6">

                @foreach (app('nav')->visibleItems() as $group)
                    <div class="space-y-1">

                        <div class="px-3 text-xs font-semibold uppercase tracking-wider text-zinc-500">
                            {{ $group['group'] }}
                        </div>

                        @foreach ($group['items'] as $item)
                            <flux:sidebar.item icon="{{ $item['icon'] }}" href="{{ route($item['route']) }}"
                                :current="request()->routeIs($item['active'])" wire:navigate>
                                {{ $item['label'] }}
                            </flux:sidebar.item>
                        @endforeach

                    </div>
                @endforeach

            </flux:sidebar.nav>

            <flux:sidebar.spacer />

            <flux:dropdown position="top" align="start" class="max-lg:hidden">
                <flux:sidebar.profile size="sm" circle name="{{ auth()->user()->name }}" />
                <flux:menu>
                    <flux:menu.radio.group>
                        <flux:menu.radio checked>{{ auth()->user()->name }}</flux:menu.radio>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle">
                            Keluar
                        </flux:menu.item>
                    </form>

                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <flux:header id="pageHeader"
            class="sticky top-0 border-b border-transparent bg-zinc-100 transition-shadow duration-200 ease-out lg:hidden dark:bg-zinc-800">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="start">
                <flux:profile circle icon="user" />

                <flux:menu>
                    <flux:menu.radio.group>
                        <flux:menu.radio checked>{{ auth()->user()->name }}</flux:menu.radio>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle">
                            Keluar
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        <flux:main>
            {{ $slot }}
        </flux:main>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const header = document.getElementById('pageHeader');
                if (!header) return;

                const onScroll = () => {
                    const scrolled = window.scrollY > 10;
                    header.classList.toggle('shadow-lg', scrolled);
                    header.classList.toggle('border-zinc-100', scrolled);
                    header.classList.toggle('dark:border-zinc-700', scrolled);
                    header.classList.toggle('border-transparent', !scrolled);
                };

                onScroll();
                window.addEventListener('scroll', onScroll);
            });
        </script>

        @livewireScripts
        @fluxScripts
    </body>

</html>
