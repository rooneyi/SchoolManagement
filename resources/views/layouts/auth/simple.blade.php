<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    @include('partials.head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-zinc-50 antialiased dark:bg-zinc-950 text-zinc-950 dark:text-zinc-50">

<div class="flex min-h-svh flex-col items-center justify-center p-6 md:p-10">
    <div class="w-full max-w-sm">
        <div class="flex flex-col gap-6">
            <div class="flex flex-col items-center gap-2">
                <a href="{{ route('dashboard') }}" class="flex h-12 w-12 items-center justify-center rounded-xl bg-zinc-900 dark:bg-zinc-50 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white dark:text-black"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                </a>
            </div>

            <div class="rounded-2xl border border-zinc-200 bg-white p-8 shadow-xl dark:border-zinc-800 dark:bg-zinc-900">
                {{ $slot }}
            </div>

            <p class="px-8 text-center text-xs text-zinc-500 leading-relaxed dark:text-zinc-400">
                &copy; {{ date('Y') }} {{ config('app.name', 'Academia CRM') }}. Tous droits réservés.
            </p>
        </div>
    </div>
</div>

@fluxScripts
</body>
</html>
