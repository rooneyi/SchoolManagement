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
<body class="min-h-screen bg-white antialiased dark:bg-zinc-950 text-zinc-950 dark:text-zinc-50">

<div class="grid min-h-screen lg:grid-cols-2">
    {{-- Section Gauche: Branding & Description --}}
    <div class="relative hidden flex-col justify-center bg-blue-950 p-12 text-white lg:flex">
        {{-- Motif de fond subtil --}}
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/40 via-transparent to-black/20"></div>

        <div class="absolute top-12 left-12 z-20 flex items-center gap-3">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-blue-900 shadow-2xl shadow-blue-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
            </div>
            <span class="text-3xl font-extrabold tracking-tighter">Academia <span class="text-blue-400">CRM</span></span>
        </div>

        <div class="relative z-20">
            <div class="max-w-md space-y-6">
                <div class="space-y-2">
                    <span class="inline-block rounded-full bg-blue-500/20 px-3 py-1 text-xs font-bold uppercase tracking-widest text-blue-300">Nouveauté v2.0</span>
                    <h2 class="text-4xl font-bold leading-tight">
                        Pilotez votre établissement avec une <span class="text-blue-400 underline decoration-blue-500/30 underline-offset-8">précision</span> inégalée.
                    </h2>
                </div>

                <p class="text-lg text-blue-100/80 leading-relaxed">
                    Une interface intuitive conçue pour les administrateurs exigeants. Centralisez vos données, optimisez vos ressources et libérez du temps pour l'essentiel : l'éducation.
                </p>

                <div class="flex items-center gap-4 pt-4">
                    <div class="flex -space-x-3">
                        <div class="h-10 w-10 rounded-full border-2 border-blue-900 bg-zinc-800 flex items-center justify-center text-xs font-bold">JD</div>
                        <div class="h-10 w-10 rounded-full border-2 border-blue-900 bg-blue-600 flex items-center justify-center text-xs font-bold">RK</div>
                        <div class="h-10 w-10 rounded-full border-2 border-blue-900 bg-zinc-500 flex items-center justify-center text-xs font-bold">+12</div>
                    </div>
                    <p class="text-sm font-medium text-blue-200/70">Rejoignez plus de 15 établissements déjà conquis.</p>
                </div>
            </div>
        </div>

        <div class="absolute bottom-10 left-12 right-12 z-20 flex items-center justify-between border-t border-white/10 pt-8 text-xs font-medium text-blue-200/50">
            <div class="flex gap-6">
                <a href="#" class="hover:text-white transition-colors">Support</a>
                <a href="#" class="hover:text-white transition-colors">Confidentialité</a>
            </div>
            <p>Version 2.0.4</p>
        </div>
    </div>

    {{-- Section Droite: Formulaire --}}
    <div class="flex flex-col items-center justify-center p-6 md:p-10">
        <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[450px]">
            <div class="flex flex-col items-center gap-2 lg:hidden">
                <a href="{{ route('dashboard') }}" class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-900 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                </a>
                <h1 class="text-2xl font-bold tracking-tight">Academia CRM</h1>
            </div>

            <div class="p-4 sm:p-8">
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
