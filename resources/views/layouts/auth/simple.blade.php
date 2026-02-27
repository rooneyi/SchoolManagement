<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    @include('partials.head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-white antialiased dark:bg-zinc-950 text-zinc-950 dark:text-zinc-50">

<div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
    <div class="flex w-full max-w-sm flex-col gap-6">

        <a href="{{ route('dashboard') }}" class="flex flex-col items-center gap-2" wire:navigate>
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-zinc-900 dark:bg-zinc-50 shadow-sm">
                <x-app-logo-icon class="size-6 fill-current text-white dark:text-black" />
            </div>
            <div class="flex flex-col items-center gap-1">
                <h1 class="text-xl font-semibold tracking-tight leading-none">
                    {{ config('app.name', 'Academia') }}
                </h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">
                    Gestion Scolaire
                </p>
            </div>
        </a>

        <div class="rounded-xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-950">
            <div class="flex flex-col gap-6">
                {{ $slot }}
            </div>
        </div>

        <p class="px-8 text-center text-xs text-zinc-500 leading-relaxed dark:text-zinc-400">
            En continuant, vous acceptez nos
            <a href="#" class="underline underline-offset-4 hover:text-zinc-900 dark:hover:text-zinc-50">Conditions d'utilisation</a>.
        </p>
    </div>
</div>

@fluxScripts
</body>
</html>
