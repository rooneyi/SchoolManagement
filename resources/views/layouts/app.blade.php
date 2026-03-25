<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800 flex">
        @include('components.sidebar')
        <main class="flex-1 min-h-screen">
            {{ $slot }}
        </main>
        @livewireScripts
        @fluxScripts
    </body>
</html>
