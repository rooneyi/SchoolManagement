<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Academia CRM | Gestion Scolaire</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-zinc-50 antialiased dark:bg-zinc-950 text-zinc-950 dark:text-zinc-50">
    <div class="flex min-h-screen">
        @include('components.sidebar')
        <main class="flex-1 flex flex-col h-screen overflow-hidden bg-white dark:bg-zinc-950">
            {{-- Header/Top bar --}}
            <header class="flex h-16 items-center justify-between border-b border-zinc-200 bg-white px-8 dark:border-zinc-800 dark:bg-zinc-950">
                <div class="flex items-center gap-4">
                    <h2 class="text-sm font-semibold text-zinc-500 uppercase tracking-wider">Administration</h2>
                </div>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-3">
                        <div class="flex flex-col items-end">
                            <span class="text-sm font-bold text-blue-950 dark:text-blue-400">{{ Auth::user()->name }}</span>
                            <span class="text-[10px] font-medium text-zinc-400">{{ Auth::user()->email }}</span>
                        </div>
                        <div class="h-10 w-10 rounded-full border-2 border-blue-100 bg-blue-50 flex items-center justify-center text-blue-900 font-bold dark:bg-blue-900/20 dark:border-blue-900/30 dark:text-blue-400">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8 bg-zinc-50/30 dark:bg-zinc-900/10">
                @yield('content')
            </div>
        </main>
    </div>
    @fluxScripts
</body>
</html>
