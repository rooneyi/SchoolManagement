<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Manager | Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-zinc-50 dark:bg-zinc-900">
    <div class="flex min-h-screen">
        @include('components.sidebar')
        <main class="flex-1 flex flex-col p-8">
            <div class="mb-8 flex items-end justify-between">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">Tableau de bord</h1>
                    <p class="text-zinc-500">Statistiques globales de l'école</p>
                </div>
            </div>
            <!-- Ici, ajoute tes widgets, stats ou graphiques du dashboard uniquement -->
        </main>
    </div>
</body>
